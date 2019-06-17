<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 16:40
 */

namespace Models;


use Core\Model;
use Entite\EquipeEntite;
use Entite\JoueurEntite;
use Helpers\Database;
use Helpers\hUser;

class EquipeModel extends Model
{

    const F_ID_EQUIPE   = "id_equipe";
    const F_NOM_EQUIPE  = "nom_equipe";
    const F_ID_JOUEUR   = "id_user_equipe";

    private $f_id_equipe    = self::F_ID_EQUIPE;
    private $f_nom_equipe   = self::F_NOM_EQUIPE;
    private $f_id_joueur    = self::F_ID_JOUEUR;

    private $table = Database::EQP;
    private $vue = Database::VNJ ;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return EquipeEntite|null
     */
    public function getUserTeam()
    {
        $ps = [":id" => hUser::getId()];
        $sql = "SELECT * FROM $this->table WHERE $this->f_id_joueur = :id";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS , EquipeEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];

        return ;
    }

    public function deleteCurrentUserTeam()
    {
        $where = [
            self::F_ID_JOUEUR => hUser::getId(),
        ];

        return $this->db->delete($this->table , $where);
    }


    public function insertJoueurForCurrentTeam($idTeam)
    {
        $team = $this->getTeamByIdTeam($idTeam);

        $data = [
            self::F_ID_JOUEUR => hUser::getId(),
            self::F_ID_EQUIPE => $team->getIdEquipe(),
            self::F_NOM_EQUIPE => $team->getNomEquipe(),
        ];

        $this->db->insert($this->table , $data);
        return true;

    }

    public function insertJoueurForTeam($idTeam)
    {
        $team = $this->getTeamByIdTeam($idTeam);

        if (empty($team)){
            return false;
        }

        $data = [
            self::F_ID_JOUEUR => hUser::getId(),
            self::F_ID_EQUIPE => $team->getIdEquipe(),
            self::F_NOM_EQUIPE => $team->getNomEquipe(),
        ];

        $this->db->insert($this->table , $data);
        return true;

    }

    public function createTeam($libTeam)
    {
        $data = [
            self::F_ID_EQUIPE => $this->getUniqId(),
            self::F_ID_JOUEUR => hUser::getId(),
            self::F_NOM_EQUIPE => $libTeam,
        ];

        return $this->db->insert($this->table , $data);
    }

    /**
     * @param $idEquipe
     * @return array|EquipeEntite
     */
    public function getJoueursByEquipe($idEquipe)
    {
        $ps = [ ":id" => $idEquipe ];
        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_id_equipe = :id";

        return $this->db->select($sql,$ps,\PDO::FETCH_CLASS, EquipeEntite::class);
    }

    /**
     * @param $id
     * @return EquipeEntite
     */
    public function getTeamByIdTeam($id)
    {
        $ps = [":id" => $id];
        $sql = "SELECT * FROM $this->table WHERE $this->f_id_equipe = :id";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS , EquipeEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];

        return ;
    }

    public function getAllTeams()
    {
        $sql = "SELECT * FROM $this->vue";
        return $this->db->select($sql);
    }

    private function getUniqId()
    {
        $uniqid = uniqid(true);
        $ps = [
            ":ui" => $uniqid,
        ];

        $sql = "SELECT * FROM $this->table WHERE $this->f_id_equipe = :ui";

        $rows = $this->db->select($sql , $ps);
        if(!empty($rows)){
            $this->getUniqId();
        }

        return $uniqid;
    }
}