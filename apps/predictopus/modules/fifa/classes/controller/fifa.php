<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Fifa;

class Controller_Fifa extends \Controller_ModuleBase {

    public function action_news() {
        
        $data = array(
            "moduleId" => 'fifa-news',
            "moduleClasses" => '',
            "content" => \View::forge('news.html'),
            "js" => array(''),
            "css" => array('modules/fifa/fifa-modal.css'),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
    
    public function action_standings() {
        
        $data = array(
            "moduleId" => 'fifa-news',
            "moduleClasses" => '',
            "content" => \View::forge('standings.html'),
            "js" => array(''),
            "css" => array('modules/fifa/fifa-modal.css'),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
    
    public function action_teams() {
        $gameId = $this->getParam('gameid', 817);
        $model = \Model_OpenFootballModel::getInstance(8);
        $game = $model->getGameDetails($gameId);
        $data = array(
            "moduleId" => 'fifa-news',
            "moduleClasses" => '',
            "content" => \View::forge('team.mustache', $game),
            "js" => array(''),
            "css" => array('modules/fifa/fifa-modal.css'),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
    
    public function action_twitter(){
        $hash = $this->getParam('hashTag');
        $data = array(
            "moduleId" => 'fifa-news',
            "moduleClasses" => '',
            "content" => \View::forge('twitter.mustache', array('hash' => $hash)),
            "js" => array(''),
            "css" => array('modules/fifa/fifa-modal.css'),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
    
    public function action_livescore(){
        $data = array(
            "moduleId" => 'fifa-news',
            "moduleClasses" => '',
            "content" => \View::forge('livescore.html'),
            "js" => array(''),
            "css" => array('modules/fifa/fifa-modal.css'),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
}