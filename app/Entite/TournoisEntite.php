<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-04-08
 * Time: 17:05
 */

namespace Entite;



use Models\TournoisModel;

class TournoisEntite
{
    public function getIdTournois()
    {
        return $this->{TournoisModel::F_ID_TOURNOIS};
    }

    public function getIdUser()
    {
        return $this->{TournoisModel::F_ID_USER};
    }

    public function getLibTournois()
    {
        return $this->{TournoisModel::F_LIB_TOURNOIS};
    }

    public function getPhaseMax()
    {
        return $this->{TournoisModel::F_PHASE_MAX};
    }


}