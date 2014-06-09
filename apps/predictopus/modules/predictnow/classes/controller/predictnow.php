<?php

namespace Predictnow;

class Controller_Predictnow extends \Controller_ModuleBase {

    public function action_index() { 
        $gameId = $this->getParam('gameid', 817);
        logger(400, print_r($gameId, 1));
        $model = \Model_OpenFootballModel::getInstance(8);
        $game = $model->getGameDetails($gameId);
        $prediction = \Model_UserDataModel::getPrediction($gameId);
        $game['p'] = $prediction;
        $modData = array(
            'game' => $game,            
        );
        logger(400, print_r($modData, 1));
        $data = array(
            'moduleId' => 'predictnow-mod',
            'moduleClasses' => '',
            'content' => \View::forge('predictnow.mustache', $modData),
            'head' => '',
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
