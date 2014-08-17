<?php

namespace Util;
/**
 * Description of utils
 *
 * @author asao
 */
class LoginUtils {
    
    /**
     * Return FB userid of logged in user
     * @return type
     */
    public static function getFBUID(){
        //put it in cookie if possible
        $fbid = \Auth\Auth::get('uid');
        
        return $fbid;
    }
}
