<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Header;

class Controller_Header extends \Controller_ModuleBase {

    public function action_index() {

        $isLoggedIn = \GenUtility::isLoggedIn();
        $name = false;
        $email = false;
        $profilePic = false;
        if ($isLoggedIn) {
            $name = \Auth\Auth::get_profile_fields('nickname');
            $email = \Auth\Auth::get('email');
            $profilePic = \Auth\Auth::get('profilepic');
        }
        $uri = \Fuel\Core\Uri::main();

        $userStats = \Model_UserDataModel::getUserStats();
        $leagues = \Model_UserDataModel::getLeagueStats();
        foreach ($leagues as &$league) {
            try {
                $league['metadata'] = json_decode($league['metadata'], 1);
            } catch (Exception $ex) {
                $league['metadata'] = array("total" => "-");
            }
        }
        $modData = array(
            "loggedIn" => $isLoggedIn,
            'name' => $name,
            'email' => $email,
            'profilePic' => $profilePic,
            'userStat' => $userStats,
            'leagues' => $leagues
        );
        if (strstr($uri, 'world-cup')) {
            $modData['isWC'] = true;
        } else if (strstr($uri, 'rule')) {
            $modData['isRules'] = true;
        } else if (strstr($uri, 'how-to')) {
            $modData['isHowTo'] = true;
        } else {
            $modData['isHome'] = true;
        }
        $data = array(
            "moduleId" => 'header',
            "moduleClasses" => '',
            "content" => \View::forge('header.mustache', $modData),
            "js" => array('modules/login/login.js'),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }

}
