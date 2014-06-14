<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of leaderboard
 *
 * @author asao
 */
namespace LeaderBoard;

class Controller_LeaderBoard extends \Controller_ModuleBase {
    
    function action_index(){
        $limit = $this->getParam('showleaders');
        $lead = Model_LeaderBoard::getLeaderBoard();
        $modData = array('leader' => $lead);
        logger(400, print_r($modData,1), __METHOD__);
        $data = array(
            "moduleId" => 'leaderboard',
            "moduleClasses" => '',
            "content" => \View::forge('leaderboard.mustache', $modData),
            "js" => array(),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
}
