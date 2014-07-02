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
        $modData = array(
            'referral' => 'http://veho.in/?referrer=playpredictopus',
            'adImage' => 'http://static.playpredictopus.com/assets/img/veho.jpg'
        );
        $random = rand(1, 10);
        if ($random <= 3) {
            $modData = array(
                'referral' => 'http://www.postergully.com/?referrer=playpredictopus',
                'adImage' => 'http://static.playpredictopus.com/assets/img/postergully.jpg'
            );
        }

        $data = array(
            "moduleId" => 'lrec',
            "moduleClasses" => '',
            "content" => \View::forge('lrec.mustache', $modData),
            "js" => array(),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }

}
