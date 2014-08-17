<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usermodel
 *
 * @author asao
 */
class Model_UserModel extends \Model_Base {

    const URL_GET_USER_HOME_FEED = '/freezingbear/v1.0/user/{user_id}/homefeed';
    const URL_GET_USER_STAMP_CLOUD = '/freezingbear/v1.0/user/{user_id}/stampcloud';

    //put your code here
    public static function getUserHomeFeed($offset, $limit, $fbid = '') {
        if (empty($fbid)) {
            $fbid = Util\LoginUtils::getFBUID();
        }
        $servers = self::getServers();
        $url = Util\Utils::getUrl($servers['Backend'],
                        self::URL_GET_USER_HOME_FEED, array('user_id' => $fbid));
        $params = array(
            'offset' => $offset,
            'limit' => $limit
        );
        $result = self::callWebservice($url, 'GET', array(), $params);
        return $result;
    }

    public static function getUserStampCloud($offset, $limit, $fetch_users,
            $fbid = '') {
        if (empty($fbid)) {
            $fbid = Util\LoginUtils::getFBUID();
        }
        $servers = self::getServers();
        $url = Util\Utils::getUrl($servers['Backend'],
                        self::URL_GET_USER_STAMP_CLOUD,
                        array('user_id' => $fbid));
        $params = array(
            'offset' => $offset,
            'limit' => $limit
        );
        $result = self::callWebservice($url, 'GET', array(), $params);
        return $result;
    }

}
