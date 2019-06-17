<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-12
 * Time: 21:34
 */

namespace Helpers;


class hUrl
{
    public static function redirectFromError($url ,$error)
    {
        hError::setMessage($error);
        Url::redirect($url);
        exit;
    }

    public static function redirectFromSuccess($url ,$success)
    {
        hMessage::setMessage($success);
        Url::redirect($url);
        exit;
    }

}