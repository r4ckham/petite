<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-12
 * Time: 21:45
 */

namespace Controllers;


use Core\Controller;
use Core\View;
use Helpers\hError;
use Helpers\hMessage;
use Helpers\hUrl;
use Helpers\Url;
use Models\UserModel;

class NewUserController extends Controller
{
    /**
     * Define Index page title and load template files.
     */
    public function index()
    {
        $data = [];

        View::renderTemplate('header', $data);
        View::render('login/register', $data);
        View::renderTemplate('footer', $data);
        exit;
    }

    public function insertNewUSer()
    {
        $nom    = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $log    = $_POST["mail"];
        $nwd    = $_POST["new_password"];
        $pwd    = $_POST["password"];

        if(empty($log) || empty($pwd) || empty($nwd) || empty($nom) || empty($prenom)){
            hUrl::redirectFromError(Url::URL_NEW_USER, hError::NOT_ENOUGH_DATA);
        }

        if($nwd != $pwd){
            hUrl::redirectFromError(Url::URL_NEW_USER, hError::PASSWORD_NOT_MATCH);
        }

        $model = new UserModel();
        $user = $model->getUserByMail($log);

        if(!empty($user)){
            hUrl::redirectFromError(Url::URL_NEW_USER, hError::USER_ALREADY_EXIST);
        }

        $model->insertNewUser($nom,$prenom,$log,$pwd);

        hUrl::redirectFromSuccess(Url::URL_DASHBOARD, hMessage::SUCCESS_CREATE);

    }
}