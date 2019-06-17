<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-02-12
 * Time: 10:06
 */

namespace Helpers;
use Helpers\Session;


class hMessage
{
    const NO_ERROR = 200;
    const INSERT_OK = 201;

    const DEMANDE_TOKEN = 300;
    const PASSWORD_RESET = 301;

    const SUCCESS_CREATE = 302;


    private static $errors = [
        // Machine Errors
        self::NO_ERROR => "Tout c'est bien passé !",
        self::INSERT_OK => "Insertion Ok !",
        // IHM
        self::DEMANDE_TOKEN => "Demande de changement de mot de passe effectuée , verifiez vos mails !",
        self::PASSWORD_RESET => "Votre mot de passe à bien été initialisé !",
        self::SUCCESS_CREATE => "Vous voilà maintenant Membres !",
    ];

    public static function getMessage($error)
    {
        return self::$errors[$error];
    }

    public static function setMessage($error)
    {
        Session::set("success" , self::getMessage($error));
    }

}
