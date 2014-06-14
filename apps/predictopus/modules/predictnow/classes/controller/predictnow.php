<?php

namespace Predictnow;

class Controller_Predictnow extends \Controller_ModuleBase {

    public static $gameids = array(
            803, 804, 809, 810, 815, 816, 821, 822, 827, 828, 833, 834, 839, 840,
            805, 845, 846, 806, 811, 812, 817, 818, 823, 824, 829, 830, 835, 836,
            841, 842, 847, 848
        );
    public function action_index() {        
        $gameId = $this->getParam('gameid', 817);
//logger(400, print_r($gameId, 1));
        $model = \Model_OpenFootballModel::getInstance(8);
        $game = $model->getGameDetails($gameId);
        $prediction = \Model_UserDataModel::getPrediction($gameId);
        $game['p'] = $prediction;
        $time = strtotime($game['time']) + 3 * 60 * 60;
        $disabled = false;
        $resultDeclared = false;
        if ($time < strtotime("now")) {
            $disabled = true;
        }
        if ($prediction && $prediction['processed'] == 1) {
            $resultDeclared = true;
        }
        $url = \Fuel\Core\Uri::main();

        $currentId = array_search($gameId, self::$gameids);
        $nextGame = false;
        if ($currentId) {
            $nextGameId = $currentId + 1;
            if (count(self::$gameids) > $nextGameId) {
                $nextGame = self::$gameids[$nextGameId];
            }
        }
//logger(\Fuel\Core\Fuel::L_DEBUG, "--- " .strtotime("now"), __METHOD__);
// check if time has passed if yes set disabled=true;
        $modData = array(
            'game' => $game,
            'timeover' => $disabled,
            'resultDec' => $resultDeclared,
            'url' => $url,
            'nextGame' => $nextGame
        );
//logger(400, print_r($modData, 1));
        $data = array(
            'moduleId' => 'predictnow-mod',
            'moduleClasses' => '',
            'content' => \View::forge('predictnow.mustache', $modData),
            'head' => \View::forge('predictnowhead.mustache', $modData),
            'js' => array('modules/predictnow/predictnow.js'),
            'css' => array('')
        );
        return $this->render($data);
    }

    public function action_xhr_save() {

// Grab all the params
        $hScore1 = $this->getParam('hScore1', "");
        $hScore2 = $this->getParam('hScore2', "");
        $fScore1 = $this->getParam('fScore1', "");
        $fScore2 = $this->getParam('fScore2', "");
        $result = $this->getParam('result');
        $gameid = $this->getParam('gameid');

        $predictions = array(
            'hScore1' => $hScore1,
            'hScore2' => $hScore2,
            'fScore1' => $fScore1,
            'fScore2' => $fScore2,
        );

        if (\Model_UserDataModel::insertPrediction($gameid, $result,
                        $predictions)) {
            return $this->jsonSuccessMsg('Prediction Saved');
        }
        return $this->jsonErrorMsg('There was a error saving the prediction. Please try again later');
    }

}
