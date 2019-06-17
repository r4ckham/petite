<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 16:32
 */

namespace Entite;


use Models\EquipeModel;

class EquipeEntite
{
    public function getIdEquipe()
    {
        return $this->{EquipeModel::F_ID_EQUIPE};
    }

    public function getNomEquipe()
    {
        return $this->{EquipeModel::F_NOM_EQUIPE};
    }

    public function getIdJoueur()
    {
        return $this->{EquipeModel::F_ID_JOUEUR};
    }
}