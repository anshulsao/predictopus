<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of searchmodel
 *
 * @author asao
 */
class Model_SearchModel extends \Model_Base {

    //put your code here
    const URL_SEARCH_MIXED = '/freezingbear/v1.0/search';

    public static function searchMixed($query, $fbid = '') {
        if (empty($fbid)) {
            $fbid = Util\LoginUtils::getFBUID();
        }
        $servers = self::getServers();
        $url = Util\Utils::getUrl($servers['Backend'], self::URL_SEARCH_MIXED);
        $params = array(
            'fb_id' => $fbid,
            'query' => $query
        );        
        $result = self::callWebservice($url, 'GET', array(), $params);
        return $result;
    }

}
