<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Comments;

class Controller_Comments extends \Controller_ModuleBase {

    /**
     * Full Fixtures for given tournament id
     * @return type
     */
    public function action_fb() {

        $title = $this->getParam('title', '');
        $modData = array(
            'url' => \Fuel\Core\Uri::main(),
            'title' => $title
        );
        $data = array(
            "moduleId" => 'fb-comments',
            "moduleClasses" => '',
            "content" => \View::forge('fbcomments.mustache', $modData),
            "js" => array(''),
            "css" => array(''),
            "inlineJs" => '',
        );
        return $this->render($data);
    }

    public function action_disqus() {
        $disqusConf = \Fuel\Core\Config::get('disqus_params');
        $DISQUS_SECRET_KEY = $disqusConf['private_key'];
        $DISQUS_PUBLIC_KEY = $disqusConf['public_key'];
        $DISQUS_FORUM_NAME = $disqusConf['forum'];
        $url = $this->getParam('url');
        if (!isset($url) || empty($url)) {
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        } else {
            $url = "http://$_SERVER[HTTP_HOST]$url";
        }
       
        //$commentCount = $model->getCommentCount($url);        
        if (\GenUtility::isLoggedIn()) {
            $data = array(
                "id" => \Auth\Auth::get('id'),
                "username" => \Auth\Auth::get_profile_fields('nickname'),
                "email" => \Auth\Auth::get('email'),
                "avatar" => \Auth\Auth::get('profilepic')
            );
        } else {
            $data = array();
        }
        $message = base64_encode(json_encode($data));
        $timestamp = time();
        $hmac = hash_hmac('sha1', $message . ' ' . $timestamp,
                $DISQUS_SECRET_KEY);

        $js = <<<JS
                
        window.disqus_config = function () {                        
            // The generated payload which authenticates users with Disqus
            this.page.remote_auth_s3 = "$message $hmac $timestamp";
            this.page.api_key = "$DISQUS_PUBLIC_KEY";
        };        
        /* * * CONFIGURATION VARIABLES: THIS CODE IS ONLY AN EXAMPLE * * */
        var disqus_shortname = "$DISQUS_FORUM_NAME"; // Required - Replace example with your forum shortname        
        window.disqus_url = "$url";                                
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
        
       
JS;

        $data = array(
            "moduleId" => 'pd-comments',
            "moduleClasses" => '',
            "content" => \View::forge('comments.mustache'),
            "head" => '',
            "js" => array(),
            "css" => array('modules/comments/comments-modal.css'),
            "inlineJs" => $js
        );
        return $this->render($data);
    }

}
