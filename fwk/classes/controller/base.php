<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller_Base extends Fuel\Core\Controller {

    const GET_PARAM = 0;
    const FUEL_PARAM = 1;
    const ALL = 2;

    /**
     * 
     * @param type $param
     * @param type $default
     * @param type $type
     * @return type
     */
    public function getParam($param, $default = '', $type = self::ALL) {
        //TODO: support type param
        //logger(\Fuel\Core\Fuel::L_DEBUG,
        //"ALL  " . print_r($this->request->named_params, 1));
        $value = null;
        if (array_key_exists($param, $_GET)) {
            $value = $_GET[$param];
        }
        if (array_key_exists($param, $_POST)) {
            $value = $_POST[$param];
        }
        $value_request = $this->request->param($param);
        if (!isset($value)) {
            if (!isset($value_request)) {
                $value = $default;
            } else {
                $value = $value_request;
            }
        }
        return $value;
    }

    protected function getValueSafely($object, $key, $default = '') {
        if (isset($object) && isset($object->{$key})) {
            return $object->{$key};
        }
        return $default;
    }

    protected function getValueSafelyArr($array, $keys, $default = '',
            $splitter = ',') {
        return GenUtility::getValueSafelyArr($array, $keys, $default, $splitter);
    }

}
