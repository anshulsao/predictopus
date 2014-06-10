<?php

namespace StaticPages;

class Controller_StaticPages extends \Controller_ModuleBase {

    public function action_howtoplay() {
        $data = array(
            "moduleId" => 'st-howtoplay',
            "moduleClasses" => '',
            "content" => \View::forge('howtoplay.html'),
            "js" => array(''),
            "css" => array('modules/fifa/fifa-modal.css'),
            "inlineJs" => '',
            "head" => 'How to play?'
        );
        return $this->render($data);
    }

    public function action_rules() {
        $data = array(
            "moduleId" => 'st-howtoplay',
            "moduleClasses" => '',
            "content" => \View::forge('gamingrules.html'),
            "js" => array(''),
            "css" => array('modules/fifa/fifa-modal.css'),
            "inlineJs" => '',
            "head" => 'Gaming Rules'
        );
        return $this->render($data);
    }
}