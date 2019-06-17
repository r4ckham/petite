<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 16:35
 */

namespace Entite;


use Models\EquipeModel;
use Models\RencontreModel;

class RencontreEntite
{
    public function getIdRencontre()
    {
        return $this->{RencontreModel::F_ID_RENCONTRE};
    }

    public function getDateRencontre()
    {
        return $this->{RencontreModel::F_DATE_RENCONTRE};
    }

    public function getIdTournois()
    {
        return $this->{RencontreModel::F_ID_TOURNOIS};
    }

    public function getIdEquipeExt()
    {
        return $this->{RencontreModel::F_ID_EQUIPE_EXT};
    }

    public function getIdEquipeDom()
    {
        return $this->{RencontreModel::F_ID_EQUIPE_DOM};
    }

    public function getScoreEquipeExt()
    {
        return (int)$this->{RencontreModel::F_SCORE_EQUIPE_EXT};
    }

    public function getScoreEquipeDom()
    {
        return (int)$this->{RencontreModel::F_SCORE_EQUIPE_DOM};
    }

    public function getEnCours()
    {
        return $this->{RencontreModel::F_EN_COURS};
    }

    public function getPhaseTournois()
    {
        return $this->{RencontreModel::F_PAHSE_TOURNOIS};
    }

    // vue
    public function getLibEquipeExt()
    {
        return $this->{RencontreModel::F_LIB_EQUIPE_EXT};
    }

    public function getLibEquipeDom()
    {
        return $this->{RencontreModel::F_LIB_EQUIPE_DOM};
    }

    public function getMailArbitre()
    {
        return $this->{RencontreModel::F_MAIL_ARBITRE};
    }
}