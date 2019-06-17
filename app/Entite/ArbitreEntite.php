<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 16:31
 */

namespace Entite;


use Models\ArbitreModel;

class ArbitreEntite
{
    public function getIdArbitre()
    {
        return $this->{ArbitreModel::F_ID_ARBITRE};
    }

    public function getDateLicenceDebut()
    {
        return $this->{ArbitreModel::F_DATE_LICENCE_DEB};
    }

    public function getDateLicenceFin()
    {
        return $this->{ArbitreModel::F_DATE_LICENCE_FIN};
    }

    public function getNom()
    {
        return $this->{ArbitreModel::F_NOM};
    }

    public function getPrenom()
    {
        return $this->{ArbitreModel::F_PRENOM};
    }

    public function getDateNaissance()
    {
        return $this->{ArbitreModel::F_PRENOM};
    }

    public function getAdresse()
    {
        return $this->{ArbitreModel::F_ADRESSE};
    }

    public function getCodePostal()
    {
        return $this->{ArbitreModel::F_CODE_POSTALE};
    }

    public function getVille()
    {
        return $this->{ArbitreModel::F_VILLE};
    }
}