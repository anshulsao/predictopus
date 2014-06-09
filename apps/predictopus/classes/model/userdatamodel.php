<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_UserDataModel extends \Model_Base {

    const DB_NAME = 'local';

    public static function getPredictions($gameids, $userid = '') {
        if (empty($gameids)) {
            return array();
        }
        if (empty($userid) && GenUtility::isLoggedIn()) {
            $user = \Auth::instance()->get_user_id();
            $userid = $user[1];
        }
        if (empty($userid)) {
            return array();
        }
        $gameidsStr = implode(',', $gameids);
        try {
            $query = Fuel\Core\DB::query("select * from C_users_predictions where user_id=$userid and game_id IN ($gameidsStr)");
            $predictions = $query->execute(self::DB_NAME)->as_array();
            for ($i = 0; $i < count($predictions); $i ++) {
                $predictions[$i]["prediction"] = json_decode($predictions[$i]["prediction"],
                        1);
                switch ($predictions[$i]["result"]) {
                    case 0: $predictions[$i]["draw"] = true;
                        break;
                    case 1: $predictions[$i]["team1W"] = true;
                        break;
                    case 2: $predictions[$i]["team2W"] = true;
                        break;
                }
            }
            return $predictions;
        } catch (Exception $e) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting prediction " . $e->getMessage(),
                    __METHOD__);
            return array();
        }
    }

    public static function getPrediction($gameid, $userid = '') {
        if (empty($userid)) {
            $userid = \Auth\Auth::get('id');
        }
        if (empty($userid)) {
            return false;
        }
        try {
            $query = Fuel\Core\DB::query("select * from C_users_predictions where user_id=$userid and game_id=$gameid");
            $prediction = $query->execute(self::DB_NAME)->as_array();
            if (count($prediction) > 0) {
                $prediction[0]["prediction"] = json_decode($prediction[0]["prediction"],
                        1);
                switch ($prediction[0]["result"]) {
                    case 0: $prediction[0]["draw"] = true;
                        break;
                    case 1: $prediction[0]["team1W"] = true;
                        break;
                    case 2: $prediction[0]["team2W"] = true;
                        break;
                }
                return $prediction[0];
            }
        } catch (Exception $ex) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting prediction " . $e->getMessage(),
                    __METHOD__);
            return false;
        }
    }

    public static function insertPrediction($gameid, $result, $predictions,
            $userid = '') {
        if (empty($userid)) {
            $userid = \Auth\Auth::get('id');
        }
        if (empty($userid)) {
            return false;
        }
        try {
            Fuel\Core\DB::start_transaction(self::DB_NAME);
            $query = Fuel\Core\DB::insert('C_users_predictions')->columns(array(
                        'user_id',
                        'game_id',
                        'result',
                        'prediction'
                    ))->values(array(
                $userid,
                $gameid,
                $result,
                json_encode($predictions)
            ));
            $query->execute(self::DB_NAME);
            Fuel\Core\DB::commit_transaction(self::DB_NAME);
            return true;
        } catch (Exception $e) {
            Fuel\Core\DB::rollback_transaction(self::DB_NAME);
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while saving Predictions " . $e->getMessage(),
                    __METHOD__);
            return false;
        }
    }

}
