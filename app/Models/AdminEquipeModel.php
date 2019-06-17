<?php


namespace Models;


use Core\Model;
use Entite\AdminEquipeEntite;
use Helpers\Database;
use Helpers\hUser;

class AdminEquipeModel extends Model
{

    const F_ID_REPONSABLE = "id_user_responsable";
    const F_ID_EQUIPE = "id_equipe";

    public function __construct()
    {
        parent::__construct();
    }

    private $table = Database::RSE ;

    // Variable du model
    private $f_id_responsable = self::F_ID_REPONSABLE;
    private $f_id_equipe = self::F_ID_EQUIPE;

    public function getTeamForUser($id)
    {
        $ps = [":id" => $id];
        $sql = "SELECT * FROM $this->table WHERE $this->f_id_responsable = :id";

        $this->db->select($sql , $ps , \PDO::FETCH_ASSOC , AdminEquipeEntite::class);
    }

    public function insertResponsableForTeam($idTeam)
    {
        $data = [
            self::F_ID_REPONSABLE => hUser::getId(),
            self::F_ID_EQUIPE => $idTeam,
        ];

        return $this->db->insert($this->table , $data);
    }

    /**
     * @param $idUser
     * @return AdminEquipeEntite|null
     */

    public function isAdminOfTeam()
    {
        $ps = [
            ":id" => hUser::getId(),
        ];
        
        $sql = "SELECT * FROM $this->table WHERE $this->f_id_responsable = :id";

        $rows =  $this->db->select($sql , $ps , \PDO::FETCH_CLASS , AdminEquipeEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }

}