<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GenUtility {

    public static function isLoggedIn() {
        $request = \Fuel\Core\Request::main();
        $isLoggedIn = $request->param('ISLOGGEDIN', -1);
        if ($isLoggedIn === -1) {
            $isLoggedIn = false;
            $loginHash = !empty(\Session::get('login_hash'));
            if ($loginHash) {
                $isLoggedIn = true;
            } else {
                try {
                    $isLoggedIn = \Auth\Auth::check();
                } catch (\Exception $e) {
                    $isLoggedIn = \Auth\Auth::check();
                }
            }
            $request->named_params['ISLOGGEDIN'] = $isLoggedIn;
        }
        return $isLoggedIn;
    }

    public static function getValueSafely($object, $key, $default = '') {
        if (isset($object) && isset($object->{$key})) {
            return $object->{$key};
        }
        return $default;
    }

    public static function getValueSafelyArr($array, $keys, $default = '',
            $splitter = ',') {

        if (!is_array($keys)) {
            $keys = array_values(explode($splitter, $keys));
        }
        $refArray = $array;
        foreach ($keys as $key) {
            if (isset($refArray) && isset($refArray[$key]))
                $refArray = $refArray[$key];
            else
                return $default;
        }


        if (empty($refArray))
            return $default;
        else {
            if (is_string($refArray) && strpos($refArray, 'http://') == 0 && in_array(substr($refArray,
                                    -3), array('jpg', 'jpeg', 'gif', 'png'))) {
                $refArray = preg_replace('/http[s]?:\/\//', '//', $refArray);
                $refArray = str_replace('&amp;', '&', $refArray);
            }
            return $refArray;
        }
    }

}
