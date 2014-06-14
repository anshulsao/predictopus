<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fuel\Tasks;

use \DBConstants;

class RankUsers {

    public static function emailUsers() {
        $getUsersQuery = "select * from users where id=3";
        $query = \Fuel\Core\DB::query($getUsersQuery);
        $users = $query->execute()->as_array();
        foreach ($users as $user) {
            $emailadd = $user['email'];
            $name = $user['username'];
            \Package::load('email');
            $email = \Email::forge();
//TODO: use a view file to generate the email message
            $email->html_body(
                    'Test'
            );

            $email->subject('ABC');
            $email->from('feedback@playpredictopus.com', 'Predictopus');
            $email->to($emailadd, $name);
            try {
                $email->send();
            }// this should never happen, a users email was validated, right?
            catch (\EmailValidationFailedException $e) {
                echo 'Exception' . $e->getMessage();
            } catch (\Exception $e) {
                echo 'Exception' . $e->getMessage();
            }
        }
    }

    public static function notifyUsers() {
        $notification = 'Test Notification http://www.playpredictopus.com';
        $href = 'http://www.playpredictopus.com';
        try {
            // get user info from db
            $getUsersQuery = "select * from users_metadata left join users_providers on users_providers.parent_id=users_metadata.parent_id where `key`='uid' and users_metadata.parent_id=3";
            $query = \Fuel\Core\DB::query($getUsersQuery);
            $users = $query->execute()->as_array();
            foreach ($users as $user) {
                $uid = $user['uid'];
                $accessToken = '311171435643838|21N9NhUC73eRdYbFWS3Wollc62U';
                $url = "https://graph.facebook.com/$uid/notifications";
                $method = 'POST';
                $params = array(
                    //'href' => $href,
                    'template' => $notification,
                    'access_token' => $accessToken
                );
                $curl = \Fuel\Core\Request::forge($url, 'curl');
                $curl->set_method($method);
                // create post request               
                $curl->set_params($params);
                try {
                    $response = $curl->execute()->response();
                    echo print_r($response, 1);
                } catch (\Fuel\Core\RequestStatusException $e) {
                    echo $e->getMessage();
                } catch (\Fuel\Core\RequestException $e) {
                    echo $e->getMessage();
                }
                // send
            }
        } catch (Exception $e) {
            echo 'Exception' . $e->getMessage();
        }
    }

    public static function run() {
        echo date('c') . "  Starting Ranking \n";
        $results = self::getUnprocessedResults();
        if ($results) {
            foreach ($results as $result) {
                self::processGameResult($result);
            }
            if (count($results) > 0) {
                self::updateLeagueRanks();
            }
        }
    }

    public static function correctHalfResults($gameid = 809) {
        $predictions = \Model_UserDataModel::getPredictionsGame($gameid);
        foreach ($predictions as $prediction) {
            $id = $prediction['id'];
            $user_predictions = json_decode($prediction[\DBConstants::COL_PREDICTIONS],
                    1);

            $T1_HT_P = $user_predictions['hScore1'];
            $T2_HT_P = $user_predictions['hScore2'];
            $htResult = 0;
            if ($T1_HT_P > $T2_HT_P) {
                $htResult = 1;
            }
            if ($T2_HT_P > $T1_HT_P) {
                $htResult = 2;
            }
            echo $id . ') htResult=' . $htResult . " Correcting Half result - ($T1_HT_P - $T2_HT_P) $gameid\n";
            $updateQuery = 'update c_users_predictions set hresult=' . $htResult . ' where id=' . $id;
            $query = \Fuel\Core\DB::query($updateQuery);
            $query->execute();
        }
    }

    private static function processGameResult($result) {
        $gameid = $result[\DBConstants::COL_GAME_ID];
        self::correctHalfResults($gameid);
        $predictions = \Model_UserDataModel::getPredictionsGame($gameid);
        $total = count($predictions);
        echo print_r($result, 1);
        $T1_HT = intval($result[\DBConstants::DATA_HSCORE1]);
        $T2_HT = intval($result[\DBConstants::DATA_HSCORE2]);
        $T1_FT = intval($result[\DBConstants::DATA_FSCORE1]);
        $T2_FT = intval($result[\DBConstants::DATA_FSCORE2]);
        $game_hresult = $T1_HT > $T2_HT ? 1 : ($T2_HT > $T1_HT ? 2 : 0);
        $game_result = $T1_FT > $T2_FT ? 1 : ($T2_FT > $T1_FT ? 2 : 0);
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
        //echo '$T1_HT_P_P $T2_HT_P_P $TD_HT_P_P'."   $T1_HT_P_P   $T2_HT_P_P   $TD_HT_P_P \n";
        $T1_HT_P_P = $T1_HT_P_P > 0 ? $T1_HT_P_P : 0.02;
        $T2_HT_P_P = $T2_HT_P_P > 0 ? $T2_HT_P_P : 0.02;
        $TD_HT_P_P = $TD_HT_P_P > 0 ? $TD_HT_P_P : 0.02;
        $T1_FT_P_P = $T1_FT_P_P > 0 ? $T1_FT_P_P : 0.02;
        $T2_FT_P_P = $T2_FT_P_P > 0 ? $T2_FT_P_P : 0.02;
        $TD_FT_P_P = $TD_FT_P_P > 0 ? $TD_FT_P_P : 0.02;
        //echo '$T1_HT_P_P $T2_HT_P_P $TD_HT_P_P'."   $T1_HT_P_P   $T2_HT_P_P   $TD_HT_P_P \n";
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
        switch ($game_hresult) {
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
        echo $game_hresult . "\n";
        //Prediction % for Team A to win at HT
        //Prediction % for Team A to win at FT
        //Prediction % for Team B to win at HT
        //Prediction % for Team B to win at FT
        // where game_id=game_id and 
        foreach ($predictions as $prediction) {
            $user_id = $prediction[\DBConstants::COL_USER_ID];
            $user_predictions = json_decode($prediction[\DBConstants::COL_PREDICTIONS],
                    1);
            //echo print_r($user_predictions, 1);
            $T1_HT_P = intval($user_predictions['hScore1']);
            $T2_HT_P = intval($user_predictions['hScore2']);
            $T1_FT_P = intval($user_predictions['fScore1']);
            $T2_FT_P = intval($user_predictions['fScore2']);
            $user_result = $prediction[\DBConstants::COL_RESULT];
            $user_hresult = 0;
            if ($T2_HT_P > $T1_HT_P) {
                $user_hresult = 2;
            }
            if ($T1_HT_P > $T2_HT_P) {
                $user_hresult = 1;
            }
            $Score_FT = $user_result == $game_result ? $CR_FT_F : 0;
            $Score_HT = $user_hresult == $game_hresult ? $CR_HT_F : 0;
            $Goal_D_FT = abs(($T1_FT_P - $T1_FT)) + abs(($T2_FT_P - $T2_FT));
            $Goal_D_HT = abs(($T1_HT_P - $T1_HT)) + abs(($T2_HT_P - $T2_HT));
            $Score_FT = ($Goal_D_FT == 0) ? $Score_FT * 2 : $Score_FT * (1 + 1 / pow(2,
                            1 + $Goal_D_FT));
            $Score_HT = ($Goal_D_HT == 0) ? $Score_HT * 2 : $Score_HT;
            $score = $Score_FT * 30 + $Score_HT * 15;
            echo date('c') . "  Points for user $user_id : $score HT-> $T1_HT_P - $T2_HT_P ($T1_HT - $T2_HT) FT-> $T1_FT_P - $T2_FT_P ($T1_FT - $T2_FT)  [$user_hresult  ,  $user_result] [$game_hresult  ,  $game_result]    $gameid\n ";
            //update score
            $user_predictions['ahScore1'] = $T1_HT;
            $user_predictions['ahScore2'] = $T2_HT;
            $user_predictions['afScore1'] = $T1_FT;
            $user_predictions['afScore2'] = $T2_FT;
            self::updateUserPoints($user_id, $gameid, $score,
                    json_encode($user_predictions));
        }
    }

    public static function revertRanking($game_id) {
        try {
            // get user info from db
            //$revertQuery = 
        } catch (Exception $e) {
            echo 'Exception' . $e->getMessage();
        }
    }

    public static function updateLeagueRanks() {
        try {
            \Fuel\Core\DB::start_transaction(DBConstants::DB_NAME);
            $metadata = '';
            $leagueQuery = "select * from c_leagues";
            $query = \Fuel\Core\DB::query($leagueQuery);
            $leagues = $query->execute()->as_array();
            foreach ($leagues as $league) {
                $league_id = $league['league_id'];
                $countQuery = "select count(*) as count from c_rel_users_league where league_id=$league_id";
                $query = \Fuel\Core\DB::query($countQuery);
                $countResult = $query->execute()->as_array();
                $count = $countResult[0]["count"];
                $metadata = json_encode(array('total' => $count));

                $updateQuery = "update c_leagues set metadata='$metadata' where league_id=$league_id";
                echo "Updating " . $league['name'] . "($league_id) with $metadata \n";
                $query = \Fuel\Core\DB::query($updateQuery);
                $query->execute();
            }
            $rankingQuery = "update c_rel_users_league set rank = (select rank from (SELECT id AS ID, @curRank := @curRank + 1 AS rank from (select points,id from c_rel_users_league b LEFT JOIN c_users_scores a on a.user_id =b.user_id) p, (SELECT @curRank := 0) r ORDER BY points DESC) as x where x.ID=c_rel_users_league.id)";
            $query = \Fuel\Core\DB::query($rankingQuery);
            $query->execute();
            \Fuel\Core\DB::commit_transaction(DBConstants::DB_NAME);
        } catch (Exception $e) {
            \Fuel\Core\DB::rollback_transaction(DBConstants::DB_NAME);
            echo 'ERROR: ' . $e->getMessage();

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
            $predictions, $processed = 1) {
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
            $table = DBConstants::TABLE_RESULTS;
            $query = \Fuel\Core\DB::query("UPDATE $table SET processed=$processed WHERE game_id=$gameid");
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
            return intval($result[0]['count']);
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
