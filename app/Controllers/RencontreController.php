<?php


namespace Controllers;


use Core\Controller;
use Core\View;
use Helpers\Assets;
use Helpers\hError;
use Helpers\hTournois;
use Helpers\hUrl;
use Helpers\Session;
use Helpers\Tools;
use Helpers\Url;
use Models\RencontreModel;

class RencontreController extends Controller
{
    const ID_RENCONTRE = "idRencontre";

    public function __construct()
    {
        parent::__construct();
    }

    public function index($idRencontre)
    {
        $data = [];

        $model = new RencontreModel();
        $rencontre = $model->getRecontreFromVue($idRencontre);

        Session::set(self::ID_RENCONTRE , $idRencontre);

        if(empty($rencontre)){
            hUrl::redirectFromError(Url::URL_DASHBOARD , hError::NOT_FOUND);
        }

        View::renderTemplate('header', $data);

        Assets::js([
            Url::templatePath() . "js/rencontre/rencontre.app.js",
        ]);

        View::render('rencontre/rencontreView', $data);
        View::renderTemplate('footer', $data);
        exit;
    }

    public function ajax()
    {
        $action = Tools::getPost('action');
        $dbg["action"] = $action;

        if($action == "get-rencontre"){
            $this->getRencontre();
        }

        if($action == "start-rencontre"){
            $this->startRencontre();
        }

        if($action == "end-rencontre"){
            $this->endRencontre();
        }

        if($action == "score-rencontre"){
            $this->updateRencontreScore();
        }


        $data = [
            "status" => hError::NOT_FOUND,
            "error" => hError::getMessage(hError::NOT_FOUND),
            "dbg" => $dbg
        ];
        echo json_encode($data);
        exit;
    }

    private function getRencontre()
    {
        $model = new RencontreModel();
        $rencontre = $model->getRecontreFromVue(Session::get(self::ID_RENCONTRE));

        $data = [
            "status" => hError::NO_ERROR,
            "error" => hError::getMessage(hError::NO_ERROR),
            "rencontre" => $rencontre,
            "test" => $model->checkRencontres(),
            "phase" => hTournois::getPhase(),
        ];

        echo json_encode($data);
        exit;
    }

    private function startRencontre()
    {
        $model = new RencontreModel();
        $model->startMatch(Session::get(self::ID_RENCONTRE));
        $rencontre =  $model->getRecontreFromVue(Session::get(self::ID_RENCONTRE));

        $data = [
            "status" => hError::NO_ERROR,
            "error" => hError::getMessage(hError::NO_ERROR),
            "rencontre" => $rencontre
        ];

        echo json_encode($data);
        exit;
        
    }

    private function endRencontre()
    {
        $model = new RencontreModel();
        $model->endMatch(Session::get(self::ID_RENCONTRE));

        // START NEW PHASE
        $this->createNewPhase();

        $data = [
            "status" => hError::NO_ERROR,
            "error" => hError::getMessage(hError::NO_ERROR),
        ];

        echo json_encode($data);
        exit;
    }

    private function createNewPhase()
    {
        $model = new RencontreModel();
        $ret = $model->checkRencontres();

        $temp = [];
        $i = 0;

        if(empty($ret) && hTournois::getPhase() != hTournois::getPhaseMax())
        {
            $rencontres = $model->getFinishedFromPreviousPhase();

            foreach ($rencontres as $index=>$rencontre){

                $idExt = $rencontre->getIdEquipeExt();
                $idDom = $rencontre->getIdEquipeDom();

                if($index % 2 == 0){

                    if($rencontre->getScoreEquipeExt() > $rencontre->getScoreEquipeDom() ){
                        $temp[$i][] = $idExt;
                    }else{
                        $temp[$i][] = $idDom;
                    }
                }else{

                    if($rencontre->getScoreEquipeExt() > $rencontre->getScoreEquipeDom() ){
                        $temp[$i][] = $idExt;
                    }else{
                        $temp[$i][] = $idDom;
                    }
                    $i++;
                }
            }

            $rencontres = $model->getMatchNotSeted();

            foreach ($rencontres as $index=>$rencontre){
                $model->updateIdTeams($rencontre->getIdRencontre() , $temp[$index][0] , $temp[$index][1]);
            }

            hTournois::setPhase(hTournois::getPhase() + 1);

        }
    }

    private function updateRencontreScore()
    {
        $scoreDom = Tools::getPost("scoreDom");
        $scoreExt = Tools::getPost("scoreExt");

        $dbg["score"] = $scoreDom . " - " . $scoreExt ;

        $model = new RencontreModel();
        $model->updateScore(Session::get(self::ID_RENCONTRE) , $scoreDom , $scoreExt);

        $data = [
            "status" => hError::NO_ERROR,
            "error" => hError::getMessage(hError::NO_ERROR),
            "dbg" => $dbg
        ];

        echo json_encode($data);
        exit;
    }
}