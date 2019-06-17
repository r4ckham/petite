<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-04-03
 * Time: 13:28
 */

namespace Entite;


use Models\CartonRencontreModel;

class CartonRencontreEntite
{

    public function getIdCartonRencontre()
    {
        return $this->{CartonRencontreModel::F_ID_CARTON_RENCONTRE};
    }


    public function getIdCarton()
    {
        return $this->{CartonRencontreModel::F_ID_CARTON};
    }


    public function getIdjoueur()
    {
        return $this->{CartonRencontreModel::F_ID_JOUEUR};
    }


    public function getIdArbitre()
    {
        return $this->{CartonRencontreModel::F_ID_ARBITRE};
    }

    public function getIdRencontre()
    {
        return $this->{CartonRencontreModel::F_ID_RENCONTRE};
    }


    public function getDateCarton()
    {
        return $this->{CartonRencontreModel::F_DATE_CARTON};
    }

}