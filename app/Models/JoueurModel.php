<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 16:40
 */

namespace Models;

use Core\Model;
use Entite\ArbitreEntite;
use Helpers\Database;
use Helpers\hUser;
use Helpers\Tools;

class JoueurModel extends Model
{
    const F_ID_JOUEUR           = "id_joueur";
    const F_DATE_LICENCE_DEB    = "date_licence_debut";
    const F_DATE_LICENCE_FIN    = "date_licence_fin";
    const F_NOM                 = "nom";
    const F_PRENOM              = "prenom";
    const F_DATE_NAISSANCE      = "date_naissance";
    const F_MAIL_JOUEUR         = "mail";

    private $f_id_joueur        = self:: F_ID_JOUEUR;
    private $f_date_licence_deb = self::F_DATE_LICENCE_DEB ;
    private $f_date_licence_fin = self::F_DATE_LICENCE_FIN;
    private $f_nom              = self::F_NOM;
    private $f_prenom           = self::F_PRENOM;
    private $f_date_naissance   = self::F_DATE_NAISSANCE;
    private $f_mail_joueur      = self::F_MAIL_JOUEUR;

    private $table = Database::JOU;

    public function __construct()
    {
        parent::__construct();
    }

    public function createNewJoueur($dateDeb , $dateFin , $nom , $prenom , $dateNaissance , $mail)
    {
        $data = [
            self::F_DATE_LICENCE_DEB    => $dateDeb,
            self::F_DATE_LICENCE_FIN    => $dateFin,
            self::F_NOM                 => $nom,
            self::F_PRENOM              => $prenom,
            self::F_DATE_NAISSANCE      => $dateNaissance,
            self::F_MAIL_JOUEUR         => $mail
        ];

        $this->db->insert($this->table , $data);
    }

    /**
     * @return object
     */
    public function getJoueurForId($idJoueur)
    {
        $ps = [
            ":id" => $idJoueur,
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_id_joueur = :id";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS, ArbitreEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }

    /**
     * @return boolean
     */
    public function getCurrentUser()
    {
        $ps = [
            ":mail" => hUser::getMail(),
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_mail_joueur = :mail";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS, ArbitreEntite::class);

        if(empty($rows)){
            return false;
        }

        return true;
    }

    /**
     * @return object
     */
    public function getJoueurForMail($mail)
    {
        $ps = [
            ":mail" => $mail,
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_mail_joueur = :mail";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS, ArbitreEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }

    /**
     * @return object
     */
    public function getAllJoueursForTeam($mail)
    {
        $ps = [
            ":mail" => $mail,
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_mail_joueur = :mail";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS, ArbitreEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }

    public function updateLicence($dateDeb , $dateFin)
    {
        $data = [
            self::F_DATE_LICENCE_DEB => $dateDeb,
            self::F_DATE_LICENCE_FIN => $dateFin
        ];

        $where = [
            self::F_MAIL_JOUEUR => hUser::getMail(),
        ];

        $this->db->update($this->table , $data , $where);
    }
}