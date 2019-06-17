<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-12
 * Time: 22:48
 */

namespace Controllers;


use Core\Controller;
use Core\View;
use Helpers\Assets;
use Helpers\hError;
use Helpers\Tools;
use Helpers\Url;
use Models\RencontreModel;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Define Index page title and load template files.
     */
    public function index()
    {
        $data = [];

        View::renderTemplate('header', $data);

        Assets::js([
            Url::templatePath() . "js/dashboard/dashboard.app.js",
        ]);

        View::render('dashboard/dashboard', $data);
        View::renderTemplate('footer', $data);
        exit;
    }

    public function ajax()
    {
        $action = Tools::getPost('action');

        if($action == "get-all-rencontre"){
            $this->getAllRencontre($dbg);
        }


        $data = [
            "status" => hError::NOT_FOUND,
            "error" => hError::getMessage(hError::NOT_FOUND)
        ];
        echo json_encode($data);
        exit;
    }

    private function getAllRencontre(&$dbg)
    {
        $model = new RencontreModel();

        $rencontres = $model->getAllRecontreFromVue();

        $data = [
            "status" => hError::NO_ERROR,
            "error" => hError::getMessage(hError::NO_ERROR),
            "rencontres" => $rencontres,
        ];
        echo json_encode($data);
        exit;
    }
}