<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-13
 * Time: 08:39
 */

namespace Helpers;


use Entite\UserEntite;

class hUser
{
    const USER_NAME = "userName";
    const USER_FIRST_NAME = "userFirstName";
    const USER_MAIL = "userMail";
    const USER_ID = "userId";

    public static function getNom()
    {
        return Session::get(self::USER_NAME);
    }

    public static function getPrenom()
    {
        return Session::get(self::USER_FIRST_NAME);
    }

    public static function displayFullName()
    {
        return Session::get(self::USER_NAME) . " " . Session::get(self::USER_FIRST_NAME) ;
    }

    public static function getMail()
    {
        return Session::get(self::USER_MAIL);
    }

    public static function isConnected()
    {
        if(!empty(Session::get(self::USER_ID))){
            return true;
        }else{
            return false;
        }
    }

    public static function setUser(UserEntite $user)
    {
        Session::set(self::USER_NAME , $user->getNom());
        Session::set(self::USER_FIRST_NAME, $user->getPrenom());
        Session::set(self::USER_MAIL , $user->getMail());
        Session::set(self::USER_ID, $user->getId());
    }

    public static function setRight($rights)
    {

    }
}