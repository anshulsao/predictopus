<?php

namespace Ads;

class Controller_Ads extends \Controller_ModuleBase {

    public function action_index() {
        $data = array(
            "moduleId" => 'banner',
            "moduleClasses" => '',
            "content" => \View::forge('notify.mustache', array()),
            "js" => array('modules/ads/ads.js'),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
    public function action_lrec() {
        $data = array(
            "moduleId" => 'lrec',
            "moduleClasses" => '',
            "content" => \View::forge('lrec.mustache', array()),
            "js" => array(),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }
}
