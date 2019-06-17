<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 16:39
 */

namespace Models;


use Core\Model;
use Entite\ArbitreEntite;
use Helpers\Database;
use Helpers\hUser;

class ArbitreModel extends Model
{
    const F_ID_ARBITRE          = "id_arbitre";
    const F_MAIL                = "mail_arbitre";

    private $f_id_arbitre       = self:: F_ID_ARBITRE;
    private $f_mail             = self::F_MAIL;

    private $table = Database::ARB;
    private $vue = Database::VUA;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return object
     */
    public function getArbitreForId($idArbitre)
    {
        $ps = [
            ":id" => $idArbitre,
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_id_arbitre = :id";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS, ArbitreEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }

    /**
     * @return object
     */
    public function getArbitreForMail($mailArbitre)
    {
        $ps = [
            ":mail" => $mailArbitre,
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_mail = :mail";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS, ArbitreEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }

    /**
     * @return object
     */
    public function isArbitre()
    {
        $ps = [
            ":mail" => hUser::getMail(),
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_mail = :mail";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS, ArbitreEntite::class);

        if(empty($rows)){
            return false;
        }

        return true;
    }

    public function getAllArbitre()
    {
        $ps = [
            ":mail" => hUser::getMail(),
        ];

        $sql = "SELECT * FROM $this->vue ";
        return $this->db->select($sql , $ps , \PDO::FETCH_CLASS, ArbitreEntite::class);
    }

    public function insertArbitre()
    {
        $data = [
            self::F_MAIL => hUser::getMail()
        ];

        return $this->db->insert($this->table , $data);
    }

    public function deleteArbitre()
    {
        $where = [
            self::F_MAIL => hUser::getMail(),
        ];

        return $this->db->delete($this->table , $where);
    }
}