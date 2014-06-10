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

    public function action_home() {
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
