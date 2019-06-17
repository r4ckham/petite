<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-04-08
 * Time: 17:14
 */

namespace Models;


use Core\Model;
use Entite\TournoisEntite;
use Helpers\Database;
use Helpers\hUser;

class TournoisModel extends Model
{
    const F_ID_TOURNOIS     = "id_tournois";
    const F_LIB_TOURNOIS    = "lib_tournois";
    const F_ID_USER         = "id_tournois_user";
    const F_PHASE_MAX       = "phase_max";

    private $f_id_tournois  = self::F_ID_TOURNOIS;
    private $f_lib_tournois = self::F_LIB_TOURNOIS;
    private $f_id_user      = self::F_ID_USER;

    private $table = Database::TRN ;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllTournois()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->db->select($sql , [], \PDO::FETCH_CLASS, TournoisEntite::Class);
    }

    /**
     * @param $id
     * @return TournoisEntite|null
     */
    public function getTournoisById($id)
    {
        $ps = [
            ":id" => $id,
        ];

        $sql = "SELECT * FROM $this->table where $this->f_id_tournois = :id ";

        $rows = $this->db->select($sql , $ps, \PDO::FETCH_CLASS, TournoisEntite::Class);
        if(empty($rows)){
            return null;
        }
        return $rows[0];
    }

    public function createTournois($libTournois, $phaseMax)
    {
        $data = [
            self::F_LIB_TOURNOIS => $libTournois,
            self::F_ID_USER => hUser::getId(),
            self::F_PHASE_MAX => $phaseMax,
        ];

        return $this->db->insert($this->table , $data);
    }
}