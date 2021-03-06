<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_UserDataModel extends \Model_Base {

    const DB_NAME = 'local';

    public static function getLeagueStats($userid = '') {
        try {
            if (empty($userid) && GenUtility::isLoggedIn()) {
                $user = \Auth::instance()->get_user_id();
                $userid = $user[1];
            }
            if (empty($userid)) {
                return array();
            }
            $query = Fuel\Core\DB::query("select * from c_users_scores left join c_leagues on c_users_scores.league_id = c_leagues.league_id where user_id = $userid;");
            $leagues = $query->execute(self::DB_NAME)->as_array();
            return $leagues;
        } catch (Exception $e) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting user Scores " . $e->getMessage(),
                    __METHOD__);
            return array();
        }
    }

    public static function getUserStats($userid = '') {
        try {
            if (empty($userid) && GenUtility::isLoggedIn()) {
                $user = \Auth::instance()->get_user_id();
                $userid = $user[1];
            }
            if (empty($userid)) {
                return array();
            }
            $table = DBConstants::TABLE_USER_SCORES;
            $query = Fuel\Core\DB::query("select * from $table where user_id=$userid");
            $scores = $query->execute(self::DB_NAME)->as_array();
            if (count($scores) > 0) {
                if (!empty($scores[0]['metadata'])) {
                    $scores[0]['metadata'] = json_decode($scores[0]['metadata'],
                            1);
                    $metadata = $scores[0]['metadata'];
                    if (!empty($metadata['played']) && !empty($metadata['correct'])) {
                        $scores[0]['metadata']['accuracy'] = $metadata['correct']
                                / $metadata['played'] * 100.0;
                    }
                }
                return $scores[0];
            }
            return $scores;
        } catch (Exception $ex) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting user Scores " . $e->getMessage(),
                    __METHOD__);
            return array();
        }
    }

    public static function getPredictionsGame($gameid) {
        try {
            $table = DBConstants::TABLE_PREDICTIONS;
            $query = Fuel\Core\DB::query("select * from $table where game_id=$gameid");
            $predictions = $query->execute(self::DB_NAME)->as_array();
            return $predictions;
        } catch (Exception $e) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting prediction " . $e->getMessage(),
                    __METHOD__);
            return array();
        }
    }

    public static function getPredictionsUser($gameids, $userid = '') {
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
            $table = DBConstants::TABLE_PREDICTIONS;
            $query = Fuel\Core\DB::query("select * from $table where user_id=$userid and game_id IN ($gameidsStr)");
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
            $table = DBConstants::TABLE_PREDICTIONS;
            $query = Fuel\Core\DB::query("select * from $table where user_id=$userid and game_id=$gameid");
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
            $htsc1 = intval($predictions['hScore1']);
            $htsc2 = intval($predictions['hScore2']);
            $htResult = 0;
            if ($htsc1 > $htsc2) {
                $htResult = 1;
            }
            if ($htsc2 > $htsc1) {
                $htResult = 2;
            }
            $logPred = json_encode($predictions);
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "PRED: $userid predicted  $logPred for $gameid", __METHOD__);
            Fuel\Core\DB::start_transaction(self::DB_NAME);
            $predJson = json_encode($predictions);
            $query = Fuel\Core\DB::query('insert into ' . DBConstants::TABLE_PREDICTIONS . " (user_id, game_id, result, hresult, prediction) values ($userid, $gameid, $result, $htResult, '$predJson') on duplicate key update result=$result, hresult=$htResult, prediction='$predJson'");
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

    public static function initializeUserScores($userid = '', $leagueid = 1) {
        if (empty($userid)) {
            $userid = \Auth\Auth::get('id');
        }
        if (empty($userid)) {
            return false;
        }
        try {
            Fuel\Core\DB::start_transaction(self::DB_NAME);
            $query = Fuel\Core\DB::query("insert into c_users_scores (user_id,points,metadata,league_id) values($userid,0,'{\"played\":\"0\", \"correct\":\"0\"}', $leagueid)");
            $query->execute(self::DB_NAME);
            Fuel\Core\DB::commit_transaction(self::DB_NAME);
            return true;
        } catch (Exception $e) {
            Fuel\Core\DB::rollback_transaction(self::DB_NAME);
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "User already initialized " . $e->getMessage(), __METHOD__);
            return false;
        }
    }

    public static function addUserToLeague($leagueid, $userid = '') {
        if (empty($userid)) {
            $userid = \Auth\Auth::get('id');
        }
        if (empty($userid)) {
            return false;
        }
        try {
            Fuel\Core\DB::start_transaction(self::DB_NAME);
            $query = Fuel\Core\DB::insert(DBConstants::TABLE_USERS_LEAGUES)->columns(array(
                        DBConstants::COL_LEAGUE_ID,
                        DBConstants::COL_USER_ID,
                    ))->values(array(
                $leagueid,
                $userid,
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
