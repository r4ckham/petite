<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-11
 * Time: 10:26
 */

namespace Models;


use Core\Model;
use Helpers\Database;
use Entite\UserEntite;

class UserModel extends Model
{

    const F_ID      = "id";
    const F_MAIL    = "mail";
    const F_NOM     = "nom";
    const F_PRENOM  = "prenom";
    const F_PWD     = "password";

    private $f_id       = self::F_ID;
    private $f_mail     = self::F_MAIL;
    private $f_nom      = self::F_NOM;
    private $f_prenom   = self::F_PRENOM;
    private $f_pwd      = self::F_PWD;

    private $table = Database::USR;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param String $mail
     * @param String $pwd
     * @return UserEntite|null
     */
    public function getUserByMailAndPwd($mail , $pwd)
    {
        $pwd = md5($pwd);

        $ps = [
            ":mail"=> $mail ,
            ":pwd"=>$pwd
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_mail = :mail ";
        $sql.= "AND $this->f_pwd = :pwd";

        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS , UserEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }


    /**
     * @param String $pseudo
     * @return UserEntite|null
     */
    public function getUserByMail($mail)
    {
        $ps = [
            ":mail"=> $mail ,
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_mail = :mail ";

        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS , UserEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }

    /**
     * @param String $pseudo
     * @return UserEntite|array
     */
    public function getMutiplesUsersByIds($ids)
    {
        $in = "";
        foreach ($ids as $id){
            $in .= $id . ",";
        }
        // Remove last ","
        $in = substr($in, 0, -1);

        $ps = [
            ":in"=> $in ,
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_id IN (:in) ";

        return $this->db->select($sql , $ps , \PDO::FETCH_CLASS , UserEntite::class);
    }

    public function insertNewUser($nom , $prenom ,$login , $password)
    {
        $password = md5($password);
        $data =[
            self::F_NOM     => $nom,
            self::F_PRENOM  => $prenom,
            self::F_MAIL    => $login,
            self::F_PWD     => $password,
        ];

        $this->db->insert($this->table , $data);
    }
}