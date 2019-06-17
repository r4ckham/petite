<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 16:43
 */

namespace Models;


use Core\Model;
use Entite\RencontreEntite;
use Helpers\Database;
use Helpers\hTournois;
use Helpers\Session;

class RencontreModel extends Model
{
    const F_ID_RENCONTRE        = "id_rencontre";
    const F_DATE_RENCONTRE      = "date_rencontre";
    const F_SCORE_EQUIPE_DOM    = "score_equipe_dom";
    const F_SCORE_EQUIPE_EXT    = "score_equipe_ext";
    const F_ID_EQUIPE_DOM       = "id_equipe_dom";
    const F_ID_EQUIPE_EXT       = "id_equipe_ext";
    const F_EN_COURS            = "en_cours";
    const F_ID_TOURNOIS         = "id_tournois";
    const F_PAHSE_TOURNOIS      = "phase_tournois";
    const F_MAIL_ARBITRE        = "mail_arbitre";
    const F_HAS_BEEN_PLAYED     = "has_been_played";
    const F_DATE_FIN            = "date_fin";

    // VUE
    const F_LIB_EQUIPE_DOM      = "equipe_dom";
    const F_LIB_EQUIPE_EXT      = "equipe_ext";

    private $f_id_rencontre = self::F_ID_RENCONTRE;
    private $f_date_recontre = self::F_DATE_RENCONTRE;
    private $f_score_equipe_dom = self::F_ID_EQUIPE_DOM;
    private $f_score_equipe_ext = self::F_SCORE_EQUIPE_EXT;
    private $f_id_equipe_dom = self::F_ID_EQUIPE_DOM;
    private $f_id_equipe_ext = self::F_ID_EQUIPE_EXT;
    private $f_en_cours = self::F_EN_COURS;
    private $f_id_tournois = self::F_ID_TOURNOIS;
    private $f_has_been_played = self::F_HAS_BEEN_PLAYED;
    private $phase = self::F_PAHSE_TOURNOIS;
    private $f_date_fin = self::F_DATE_FIN;

    private $table = Database::REN;
    private $vue = Database::VRE;
    private $vueInner = Database::VWL;

    /**
     * vueInner = whitout left
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return RencontreEntite|array
     */
    public function getRencontresByTournois()
    {
        $ps = [
            ":id" => ID_TOURNOIS
        ];
        $sql = "SELECT * FROM $this->table ";
        $sql.= "where $this->f_id_tournois = :id";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);
    }

    /**
     * @return RencontreEntite|array
     */
    public function getRencontresByTournoisNotPlayed()
    {
        $ps = [
            ":id" => ID_TOURNOIS
        ];
        $sql = "SELECT * FROM $this->table ";
        $sql.= "where $this->f_id_tournois = :id AND $this->f_has_been_played = 0";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);
    }


    /**
     * @return RencontreEntite|array
     */
    public function getRencontresFromVueByIdTournois()
    {
        $ps = [
            ":id" => ID_TOURNOIS
        ];
        $sql = "SELECT * FROM $this->vue ";
        $sql.= "where $this->f_id_tournois = :id";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);
    }

    public function getRencontresEnCours()
    {
        $sql = "SELECT * FROM $this->table ";
        $sql.= "where $this->f_en_cours = 1";

        return $this->db->select($sql,[],\PDO::FETCH_CLASS,RencontreEntite::class);
    }

    public function getRencontreEnCoursFromVue()
    {
        $ps = [
            ":id" => ID_TOURNOIS,
        ];
        $sql = "SELECT * FROM $this->vueInner ";
        $sql.= "WHERE $this->f_en_cours = 1 AND $this->f_id_tournois = :id";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);
    }

    public function getAllRecontreFromVue()
    {
        $ps = [
            ":id" => ID_TOURNOIS,
        ];
        $sql = "SELECT * FROM $this->vueInner WHERE $this->f_id_tournois = :id ORDER BY $this->phase";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);
    }

    public function getRecontreFromVue($idRencontre)
    {
        $ps = [
            ":id" => ID_TOURNOIS,
            ":idR" => $idRencontre,
        ];
        $sql = "SELECT * FROM $this->vueInner WHERE $this->f_id_tournois = :id AND $this->f_id_rencontre = :idR";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class)[0];
    }

    public function getAllRecontreNotPlayed()
    {
        $ps = [
            ":id" => ID_TOURNOIS,
        ];
        $sql = "SELECT * FROM $this->vueInner WHERE $this->f_id_tournois = :id AND $this->f_has_been_played = 0";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);
    }

    public function getMatchAArbitrer()
    {
        $ps = [
            ":id" => ID_TOURNOIS
        ];
        $sql = "SELECT * FROM $this->vue ";
        $sql.= "where $this->f_id_tournois = :id";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);
    }

    public function startMatch($idRencontre)
    {
        $where = [
            self::F_ID_RENCONTRE => $idRencontre,
        ];

        $update = [
            self::F_DATE_RENCONTRE => date('Y-m-d H:i:s', time()),
            self::F_EN_COURS => 1,
            self::F_SCORE_EQUIPE_EXT => 0,
            self::F_SCORE_EQUIPE_DOM => 0,
        ];

        $this->db->update($this->table , $update , $where);
    }

    public function endMatch($idRencontre)
    {
        $where = [
            self::F_ID_RENCONTRE => $idRencontre,
        ];

        $update = [
            self::F_EN_COURS => 0,
            self::F_HAS_BEEN_PLAYED => 1,
            self::F_DATE_FIN => date('Y-m-d H:i:s', time()),
        ];

        $this->db->update($this->table , $update , $where);
    }

    public function updateScore($idRencontre , $scoreDom , $scoreExt)
    {
        $where = [
            self::F_ID_RENCONTRE => $idRencontre,
        ];

        $update = [
            self::F_SCORE_EQUIPE_DOM => $scoreDom,
            self::F_SCORE_EQUIPE_EXT => $scoreExt,
        ];

        $this->db->update($this->table , $update , $where);
    }

    public function checkRencontres()
    {
        $ps = [
            ":id" => ID_TOURNOIS,
            ":ph" => hTournois::getPhase(),
        ];
        $sql = "SELECT * FROM $this->vueInner ";
        $sql.= "where $this->f_id_tournois = :id AND $this->f_en_cours = 0 AND $this->f_has_been_played = 0 AND $this->phase = :ph";

        $rows = $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows;
    }

    public function getFinishedFromPreviousPhase()
    {
        $ps = [
            ":id" => ID_TOURNOIS,
            ":ph" => hTournois::getPhase(),
        ];
        $sql = "SELECT * FROM $this->vueInner ";
        $sql.= "where $this->f_id_tournois = :id AND $this->f_has_been_played = 1 AND $this->phase = :ph";

        $rows = $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows;
    }

    public function getMatchNotSeted()
    {
        $ps = [
            ":ph" => hTournois::getPhase() + 1,
        ];
        $sql = "SELECT * FROM $this->vue WHERE $this->f_id_equipe_dom IS NULL AND $this->f_id_equipe_ext IS NULL AND $this->phase = :ph";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS,RencontreEntite::class);
    }

    public function updateIdTeams($idRencontre , $idDom , $idExt)
    {
        $where = [
            self::F_ID_RENCONTRE => $idRencontre,
        ];

        $data = [
            self::F_ID_EQUIPE_DOM => $idDom,
            self::F_ID_EQUIPE_EXT => $idExt,
        ];

        $this->db->update($this->table , $data , $where);
    }
}