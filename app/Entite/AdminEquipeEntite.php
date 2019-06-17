<?php


namespace Entite;


use Models\AdminEquipeModel;

class AdminEquipeEntite
{
    public function getIdJoueur()
    {
        return $this->{AdminEquipeModel::F_ID_REPONSABLE};
    }

    public function getIdEquipe()
    {
        return $this->{AdminEquipeModel::F_ID_EQUIPE};
    }

}