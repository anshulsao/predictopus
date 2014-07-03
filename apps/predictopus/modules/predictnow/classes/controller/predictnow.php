<?php

namespace Predictnow;

class Controller_Predictnow extends \Controller_ModuleBase {

    public static $gameids = array(
        803, 804, 809, 810, 815, 816, 821, 822, 827, 828, 833, 834, 839, 840, 805,
        845, 846, 806, 811, 812, 817, 818, 823, 824, 829, 830, 835, 836, 841, 842,
        847, 848, 807, 808, 813, 814, 819, 820, 825, 826, 831, 832, 837, 838, 843,
        844, 849, 850, 851, 852, 853, 854, 855, 856, 857, 858, 859, 860, 861, 862
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
        $super16 = false;
        if($gameId > 850){
            $super16 = true;
        }
//logger(\Fuel\Core\Fuel::L_DEBUG, "--- " .strtotime("now"), __METHOD__);
// check if time has passed if yes set disabled=true;
        $modData = array(
            'game' => $game,
            'timeover' => $disabled,
            'resultDec' => $resultDeclared,
            'url' => $url,
            'nextGame' => $nextGame,
            'super16' => $super16
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
        $model = \Model_OpenFootballModel::getInstance(8);
        $hScore1 = $this->getParam('hScore1', "");
        $hScore2 = $this->getParam('hScore2', "");
        $fScore1 = $this->getParam('fScore1', "");
        $fScore2 = $this->getParam('fScore2', "");
        $result = $this->getParam('result');
        $gameid = $this->getParam('gameid');
        $game = $model->getGameDetails($gameid);
        $time = strtotime($game['time']) + 3 * 60 * 60;
        if ($time < strtotime("now")) {
            return $this->jsonErrorMsg("Don't be over smart! time is up");
        }

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
