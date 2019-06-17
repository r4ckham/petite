<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-04-03
 * Time: 13:16
 */

namespace Models;


use Core\Model;
use Entite\CartonRencontreEntite;

class CartonRencontreModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    const F_ID_CARTON_RENCONTRE     = "id_carton_rencontre";
    const F_ID_CARTON               = "id_carton";
    const F_ID_JOUEUR               = "id_joueur";
    const F_ID_ARBITRE              = "id_arbitre";
    const F_ID_RENCONTRE            = "id_rencontre";
    const F_DATE_CARTON             = "date_carton";



    private $f_id_carton_rencontre       = self:: F_ID_CARTON_RENCONTRE;
    private $f_id_carton                 = self:: F_ID_CARTON;
    private $f_id_joueur                 = self:: F_ID_JOUEUR;
    private $f_id_arbitre                = self:: F_ID_ARBITRE;
    private $f_id_rencontre              = self:: F_ID_RENCONTRE;
    private $f_date_carton               = self:: F_DATE_CARTON;

    private $table = Database::CRT;

    /**
     * Retourne les cartons par date
     * @param $date
     * @return null|CartonRencontreEntite
     */
    public function getCartonByDate($date)
    {
        $ps = [
            ":date"=> $date
        ];

        $sql = "SELECT * FROM $this->table ";
        $sql.= "WHERE $this->f_date_carton = :date ";
        $rows = $this->db->select($sql , $ps , \PDO::FETCH_CLASS , CartonRencontreEntite::class);

        if(empty($rows)){
            return null;
        }

        return $rows[0];
    }


}