<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth;

class Auth_CustomOpauth extends Auth_Opauth {

    /**
     * fetch the callback response
     */
    protected function callback() {
        // fetch the response and decode it
        $this->response = \Input::get('opauth', false) and $this->response = unserialize(base64_decode($this->response));

        // did we receive a response at all?
        if (!$this->response) {
            throw new \OpauthException('no valid response received in the callback');
        }

        // did we receive one, but was it an error
        if (array_key_exists('error', $this->response)) {
            throw new \OpauthException('Authentication error: the callback returned an error auth response');
        }

        // validate the response
        if ($this->get('auth') === null or $this->get('timestamp') === null or
                $this->get('signature') === null or $this->get('auth.provider') === null
                or $this->get('auth.uid') === null) {
            throw new \OpauthException('Invalid auth response: Missing key auth response components');
        } elseif (!$this->opauth->validate(sha1(print_r($this->get('auth'), true)),
                        $this->get('timestamp'), $this->get('signature'),
                        $reason)) {
            throw new \OpauthException('Invalid auth response: ' . $reason);
        }      
        //logger(\Fuel\Core\Fuel::L_ERROR, $this->get('auth.provider'));
        if (strcasecmp($this->get('auth.provider'), 'twitter') === 0) {
            $this->response['auth']['info']['email'] = $this->get('auth.info.nickname') . "@twitterdummy.com";
            //logger(\Fuel\Core\Fuel::L_ERROR, print_r($this->response, 1), __METHOD__);
        }
        if (strcasecmp($this->get('auth.provider'), 'facebook') === 0) {
            $this->response['auth']['info']['nickname'] = $this->get('auth.info.first_name');
        }
    }

}
