<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 16:32
 */

namespace Entite;


use Models\JoueurModel;

class JoueurEntite
{
    public function getIdJoueur()
    {
        return $this->{JoueurModel::F_ID_ARBITRE};
    }

    public function getDateLicenceDebut()
    {
        return $this->{JoueurModel::F_DATE_LICENCE_DEB};
    }

    public function getDateLicenceFin()
    {
        return $this->{JoueurModel::F_DATE_LICENCE_FIN};
    }

    public function getNom()
    {
        return $this->{JoueurModel::F_NOM};
    }

    public function getPrenom()
    {
        return $this->{JoueurModel::F_PRENOM};
    }

    public function getDateNaissance()
    {
        return $this->{JoueurModel::F_PRENOM};
    }

    public function getAdresse()
    {
        return $this->{JoueurModel::F_ADRESSE};
    }

    public function getCodePostal()
    {
        return $this->{JoueurModel::F_CODE_POSTALE};
    }

    public function getVille()
    {
        return $this->{JoueurModel::F_VILLE};
    }
}