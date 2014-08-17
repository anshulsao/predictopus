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

        //$userStats = \Model_UserDataModel::getUserStats();        
        $modData = array(
            "loggedIn" => $isLoggedIn,
            'name' => $name,
            'email' => $email,
            'profilePic' => $profilePic,
                //'userStat' => $userStats,
        );
        $data = array(
            "moduleId" => 'header',
            "moduleClasses" => '',
            "content" => \View::forge('header.mustache', $modData),
            "js" => array('modules/login/login.js', 'modules/search/search.js'),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }

    public function action_xhrsearch() {
        $query = $this->getParam('q');
        $response = \Model_SearchModel::searchMixed($query);
        if ($response->getStatus() != '200') {
            return $this->jsonErrorMsg('Error in backend');
        }
        $searchResults = $response->getBodyObjectJSON();
        //logger(\Fuel\Core\Fuel::L_ERROR, print_r($streamData, 1), __METHOD__);
        $modData = array(
            'search' => $searchResults
        );
        return $this->jsonSuccess($modData);
    }

}
