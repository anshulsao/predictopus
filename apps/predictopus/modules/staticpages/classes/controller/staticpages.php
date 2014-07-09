<?php

namespace StaticPages;

class Controller_StaticPages extends \Controller_ModuleBase {

    public function action_howtoplay() {
        $data = array(
            "moduleId" => 'st-howtoplay',
            "moduleClasses" => '',
            "content" => \View::forge('howtoplay.html'),
            "js" => array(''),
            "css" => array('modules/staticpages/static-modal.css'),
            "inlineJs" => '',
            "head" => 'How to play?'
        );
        return $this->render($data);
    }
    
    public function action_privacy() {
        $data = array(
            "moduleId" => 'st-howtoplay',
            "moduleClasses" => '',
            "content" => \View::forge('privacy.html'),
            "js" => array(''),
            "css" => array('modules/staticpages/static-modal.css'),
            "inlineJs" => '',
            "head" => 'Privacy Policy'
        );
        return $this->render($data);
    }

    public function action_home() {
        if(\GenUtility::isLoggedIn()){
            \Response::redirect('http://'.$_SERVER['HTTP_HOST']."/dashboard", 'location');
        }
        $data = array(
            "moduleId" => 'st-home',
            "moduleClasses" => '',
            "content" => \View::forge('home.html'),
            "js" => array(''),
            "css" => array('modules/staticpages/static-modal.css'),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
    public function action_notfound() {
        $data = array(
            "moduleId" => 'st-home',
            "moduleClasses" => '',
            "content" => \View::forge('home.html'),
            "js" => array(''),
            "css" => array('modules/staticpages/static-modal.css'),
            "inlineJs" => '',
        );
        return '<img src="/assets/img/404.png" style="margin: auto;max-width: 400px;top: -66px;position: relative;">';
    }
    public function action_rules() {
        $data = array(
            "moduleId" => 'st-howtoplay',
            "moduleClasses" => '',
            "content" => \View::forge('gamingrules.html'),
            "js" => array(''),
            "css" => array('modules/staticpages/static-modal.css'),
            "inlineJs" => '',
            "head" => 'Gaming Rules'
        );
        return $this->render($data);
    }
}
