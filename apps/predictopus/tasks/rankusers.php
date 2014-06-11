<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fuel\Tasks;

use \DBConstants;

class RankUsers {

    public static function run() {
        echo 'Starting Ranking';
        $results = self::getUnprocessedResults();
        if ($results) {
            foreach ($results as $result) {
                self::processGameResult($result);
            }
        }
    }

    private static function processGameResult($result) {
        $gameid = $result[\DBConstants::COL_GAME_ID];
        $predictions = \Model_UserDataModel::getPredictionsGame($gameid);
        $total = count($predictions);
        echo print_r($result, 1);
        $T1_HT = $result[\DBConstants::DATA_HSCORE1];
        $T2_HT = $result[\DBConstants::DATA_HSCORE2];
        $T1_FT = $result[\DBConstants::DATA_FSCORE1];
        $T2_FT = $result[\DBConstants::DATA_FSCORE2];
        $game_hresult = $T1_HT > $T2_HT ? 1 : ($T2_HT > $T1_HT ? 2 : 0);
        $game_result = $T1_FT > $T2_FT ? 1 : ($T1_FT > $T2_FT ? 2 : 0);
        //TODO: Calculate Half Time total
        $T1_HT_P_P = self::getCountStat($gameid, DBConstants::COL_HRESULT, 1) / $total
                * 1.0;
        $T2_HT_P_P = self::getCountStat($gameid, DBConstants::COL_HRESULT, 2) / $total
                * 1.0;
        $TD_HT_P_P = self::getCountStat($gameid, DBConstants::COL_HRESULT, 0) / $total
                * 1.0;

        $T1_FT_P_P = self::getCountStat($gameid, DBConstants::COL_RESULT, 1) / $total
                * 1.0;
        $T2_FT_P_P = self::getCountStat($gameid, DBConstants::COL_RESULT, 2) / $total
                * 1.0;
        $TD_FT_P_P = self::getCountStat($gameid, DBConstants::COL_RESULT, 0) / $total
                * 1.0;

        $T1_HT_P_P = $T1_HT_P_P > 0 ? $T1_HT_P_P : 0.02;
        $T2_HT_P_P = $T2_HT_P_P > 0 ? $T2_HT_P_P : 0.02;
        $TD_HT_P_P = $TD_HT_P_P > 0 ? $TD_HT_P_P : 0.02;
        $T1_FT_P_P = $T1_FT_P_P > 0 ? $T1_FT_P_P : 0.02;
        $T2_FT_P_P = $T2_FT_P_P > 0 ? $T2_FT_P_P : 0.02;
        $TD_FT_P_P = $TD_FT_P_P > 0 ? $TD_FT_P_P : 0.02;
        $CR_FT_F = 0;
        switch ($game_result) {
            case 0:
                $CR_FT_F = 1 / (sqrt($TD_FT_P_P));
                break;
            case 1:
                $CR_FT_F = 1 / (sqrt($T1_FT_P_P));
                break;
            case 2:
                $CR_FT_F = 1 / (sqrt($T2_FT_P_P));
                break;
        }
        $CR_HT_F = 0;
        switch ($game_result) {
            case 0:
                $CR_HT_F = 1 / (sqrt($TD_HT_P_P));
                break;
            case 1:
                $CR_HT_F = 1 / (sqrt($T1_HT_P_P));
                break;
            case 2:
                $CR_HT_F = 1 / (sqrt($T2_HT_P_P));
                break;
        }
        //Prediction % for Team A to win at HT
        //Prediction % for Team A to win at FT
        //Prediction % for Team B to win at HT
        //Prediction % for Team B to win at FT
        // where game_id=game_id and 
        foreach ($predictions as $prediction) {
            $user_id = $prediction[\DBConstants::COL_USER_ID];
            $user_predictions = json_decode($prediction[\DBConstants::COL_PREDICTIONS],
                    1);
            echo print_r($user_predictions, 1);
            $T1_HT_P = $user_predictions['hScore1'];
            $T2_HT_P = $user_predictions['hScore2'];
            $T1_FT_P = $user_predictions['fScore1'];
            $T2_FT_P = $user_predictions['fScore2'];
            $user_result = $prediction[\DBConstants::COL_RESULT];
            $user_hresult = $prediction[\DBConstants::COL_HRESULT];
            $Score_FT = $user_result == $game_result ? $CR_FT_F : 0;
            $Score_HT = $user_hresult == $game_hresult ? $CR_HT_F : 0;
            $Goal_D_FT = abs(($T1_FT_P - $T1_FT)) + abs(($T2_FT_P - $T2_FT));
            $Goal_D_HT = abs(($T1_HT_P - $T1_HT)) + abs(($T2_HT_P - $T2_HT));
            $Score_FT = ($Goal_D_FT == 0) ? $Score_FT * 2 : $Score_FT * (1 + 1 / pow(2,
                            1 + $Goal_D_FT));
            $Score_HT = ($Goal_D_HT == 0) ? $Score_HT * 2 : $Score_HT;
            $score = $Score_FT * 30 + $Score_HT * 15;
            echo "Points for user $user_id : $score HT-> $T1_HT_P - $T2_HT_P ($T1_HT - $T2_HT) FT-> $T1_FT_P - $T2_FT_P ($T1_FT - $T2_FT)\n ";
            //update score
            $user_predictions['ahScore1'] = $T1_HT;
            $user_predictions['ahScore2'] = $T2_HT;
            $user_predictions['afScore1'] = $T1_FT;
            $user_predictions['afScore2'] = $T2_FT;
            self::updateUserPoints($user_id, $gameid, $score,
                    json_encode($user_predictions));
        }
        self::updateLeagueRanks();
    }

    public static function updateLeagueRanks() {
        try {
            \Fuel\Core\DB::start_transaction(DBConstants::DB_NAME);

            \Fuel\Core\DB::commit_transaction(DBConstants::DB_NAME);
        } catch (Exception $e) {
            \Fuel\Core\DB::rollback_transaction(DBConstants::DB_NAME);
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting prediction " . $e->getMessage(),
                    __METHOD__);
            return false;
        }
    }

    /**
     * Update points for user
     * @param type $userid
     * @param type $gameid
     * @param type $score
     * @return boolean
     */
    private static function updateUserPoints($userid, $gameid, $score,
            $predictions) {
        try {
            \Model_UserDataModel::initializeUserScores($userid);
            \Fuel\Core\DB::start_transaction(DBConstants::DB_NAME);
            $table = DBConstants::TABLE_PREDICTIONS;
            $query = \Fuel\Core\DB::query("UPDATE $table SET points=$score, processed=1, prediction='$predictions' WHERE user_id=$userid && game_id=$gameid");
            $query->execute(DBConstants::DB_NAME);
            $userQuery = \Fuel\Core\DB::query("select * from c_users_scores where user_id=$userid");
            $results = $userQuery->execute(DBConstants::DB_NAME)->as_array();

            $result = $results[0];
            $cumPoints = $result['points'] + $score;
            $stats = json_decode($result['metadata'], 1);
            $stats['played'] += 1;
            if ($score > 0) {
                $stats['correct'] +=1;
            }
            $json = json_encode($stats);

            $table = DBConstants::TABLE_USER_SCORES;
            $query = \Fuel\Core\DB::query("UPDATE $table SET points=$cumPoints, metadata='$json' WHERE user_id=$userid");
            $query->execute(DBConstants::DB_NAME);
            \Fuel\Core\DB::commit_transaction(DBConstants::DB_NAME);
            return true;
        } catch (Exception $e) {
            \Fuel\Core\DB::rollback_transaction(DBConstants::DB_NAME);
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting prediction " . $e->getMessage(),
                    __METHOD__);
            return false;
        }
    }

    private static function getCountStat($gameid, $key, $val) {
        try {
            $table = DBConstants::TABLE_PREDICTIONS;
            $query = \Fuel\Core\DB::query("select count(*) as count from $table where game_id=$gameid and $key=$val");
            $result = $query->execute(DBConstants::DB_NAME)->as_array();
            //echo print_r($result, 1);
            return $result[0]['count'];
        } catch (Exception $e) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting prediction " . $e->getMessage(),
                    __METHOD__);
            return 0;
        }
    }

    /**
     * Fetch all unprocessed games
     * @return boolean
     */
    private static function getUnprocessedResults() {
        $table = \DBConstants::TABLE_RESULTS;
        try {
            $query = \Fuel\Core\DB::query("select * from $table where processed=0");
            $games = $query->execute(\DBConstants::DB_NAME)->as_array();
            return $games;
        } catch (Exception $ex) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting prediction " . $e->getMessage(),
                    __METHOD__);
            return false;
        }
    }

}
