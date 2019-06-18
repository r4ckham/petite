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
        //var_dump($ret).die();

        $temp = [];
        $i = 0;

        $loosers = [];

        if(empty($ret) && hTournois::getPhase() != hTournois::getPhaseMax())
        {
            $rencontres = $model->getFinishedFromPreviousPhase();
            //var_dump(hTournois::getPhase());
            //var_dump($rencontres).die();

            foreach ($rencontres as $index=>$rencontre){

                $idExt = $rencontre->getIdEquipeExt();
                $idDom = $rencontre->getIdEquipeDom();

                $scoreExt = $rencontre->getScoreEquipeExt();
                $scoreDom = $rencontre->getScoreEquipeDom();

                if($scoreExt > $scoreDom ){
                    $temp[$i][] = $idExt;
                }else{
                    $temp[$i][] = $idDom;
                }

                if($index % 2 != 0){
                    $i++;
                }

                if(($rencontre->getPhaseTournois() + 1) == hTournois::getPhaseMax()){
                    if($scoreExt < $scoreDom){
                        array_push($loosers , $idExt);
                    }else{
                        array_push($loosers , $idDom);
                    }
                }
            }

            //var_dump($loosers).die();

            $rencontres = $model->getMatchNotSeted();
            $nbRencontre = count($rencontres);

            foreach ($rencontres as $index=>$rencontre){
                $model->updateIdTeams($rencontre->getIdRencontre() , $temp[$index][0] , $temp[$index][1]);

                if($rencontre->getPhaseTournois() == hTournois::getPhaseMax() && $index > 0){
                    $model->updateIdTeams($rencontre->getIdRencontre() , $loosers[0] , $loosers[1]);
                }
            }

            //var_dump($rencontres);
            //var_dump($temp).die();

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