<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-11
 * Time: 11:18
 */

namespace Entite;


use Models\UserModel;

class UserEntite
{
    public function getId()
    {
        return $this->{UserModel::F_ID};
    }

    public function getMail()
    {
        return $this->{UserModel::F_MAIL};
    }

    public function getNom()
    {
        return $this->{UserModel::F_NOM};
    }

    public function getPrenom()
    {
        return $this->{UserModel::F_PRENOM};
    }

    public function getPseudo()
    {
        return $this->{UserModel::F_PSEUDO};
    }
}