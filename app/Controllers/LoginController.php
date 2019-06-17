<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-11
 * Time: 10:21
 */

namespace Controllers;


use Core\Controller;
use Core\View;
use Helpers\hError;
use Helpers\hTournois;
use Helpers\hUrl;
use Helpers\hUser;
use Helpers\Session;
use Helpers\Url;
use Models\ArbitreModel;
use Models\RencontreModel;
use Models\TournoisModel;
use Models\UserModel;

class LoginController extends Controller
{
    /**
     * Call the parent construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function ajax()
    {
        $action = Tools::getPost("action");

    }

    public function index()
    {
        $data = [];

        $model = new TournoisModel();
        $tournois = $model->getTournoisById(ID_TOURNOIS);

        $model = new RencontreModel();
        $rencontre = $model->getRencontresFromVueByIdTournois()[0];

        hTournois::setArbitreMail($rencontre->getMailArbitre());
        hTournois::setPhaseMax($tournois->getPhaseMax());
        hTournois::setPhase($rencontre->getPhaseTournois());

        View::renderTemplate('header', $data);
        View::render('login/login', $data);
        View::renderTemplate('footer', $data);

        exit;
    }

    public function login()
    {
        $log = $_POST["mail"];
        $pwd = $_POST["password"];

        if(empty($log) || empty($pwd)){
            hUrl::redirectFromError(Url::URL_WELCOME, hError::NOT_ENOUGH_DATA);
        }

        $model = new UserModel();

        $user = $model->getUserByMail($log);
        if(empty($user)){
            hUrl::redirectFromError(Url::URL_WELCOME, hError::USER_NOT_EXIST);
        }

        $user = $model->getUserByMailAndPwd($log , $pwd);
        if(empty($user)){
            hUrl::redirectFromError(Url::URL_WELCOME, hError::BAD_PASSWORD);
        }

        //$modelArbitre = new ArbitreModel();
        //$ret = $modelArbitre->getArbitreForMail($log);

        if($log != hTournois::getArbitreMail()){
            hUrl::redirectFromError(Url::URL_WELCOME, hError::NOT_ARBITRE);
        }

        hUser::setUser($user);
        Url::redirect(Url::URL_DASHBOARD);

    }

    public function logout()
    {
        Session::destroy();
        Url::redirect("");

    }



}