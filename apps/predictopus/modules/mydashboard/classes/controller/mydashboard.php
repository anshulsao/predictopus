<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MyDashBoard;

class Controller_MyDashBoard extends \Controller_ModuleBase {

    public function action_index() {
        if(!\GenUtility::isLoggedIn()){
            \Response::redirect('http://'.$_SERVER['HTTP_HOST'], 'location');
        }
        $tournamentId = 8;
        $model = \Model_OpenFootballModel::getInstance($tournamentId);
        //$userStats = \Model_UserDataModel::getUserStats();
        $leagues = \Model_UserDataModel::getLeagueStats();
        foreach ($leagues as &$league) {
            try {
                $league['metadata'] = json_decode($league['metadata'], 1);
            } catch (Exception $ex) {
                $league['metadata'] = array("total" => "-");
            }
        }
        logger(\Fuel\Core\Fuel::L_DEBUG, print_r($leagues, 1), __METHOD__);
        $fixtures = $model->getFullFixtures($tournamentId);
        $prevGames = array();
        $nextGames = array();
        //TODO remove this
        $now = strtotime('now');
        $nextDate = '';
        foreach ($fixtures as $fixture) {
            foreach ($fixture['games'] as $key => $game) {
                $date = strtotime($game['time']) + 3 * 60 * 60;
                if ($date < $now) {
                    $prevGames[] = $game;
                } else if (count($nextGames) == 0) {
                    $nextGames = $fixture['games'];
                    $nextDate = $fixture['date'];
                }
            }
        }
        $prevGames = array_reverse($prevGames);

        $modData = array(
            'prev' => $prevGames,
            'next' => $nextGames,
            'nextDate' => $nextDate,
            'leagues' => $leagues,
            //'userStat' => $userStats,
            'showDate' => true
        );
        $data = array(
            "moduleId" => 'dashboard',
            "moduleClasses" => '',
            "content" => \View::forge('dashboard.mustache', $modData),
            "js" => array(''),
            "css" => array('modules/fixtures/fixtures-modal.css', 'flags.css'),
            "inlineJs" => '',
        );
        return $this->render($data);
    }

}
