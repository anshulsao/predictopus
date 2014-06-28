<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LeaderBoard;

/**
 * Description of leaderboard
 *
 * @author asao
 */
class Model_LeaderBoard extends \Model_Base {

    const DB_NAME = 'local';

    public static function getLeagues() {
        try {
            $query = \Fuel\Core\DB::query('select * from c_leagues where type="System"');
            $leagues = $query->execute(self::DB_NAME)->as_array();
            return $leagues;
        } catch (Exception $e) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting leagues " . $e->getMessage(),
                    __METHOD__);
            return array();
        }
    }

    public static function getLeaderBoard($limit = 20, $league = 1) {
        try {

            $query = \Fuel\Core\DB::query("select c_users_scores.user_id, rank, value, points from c_users_scores left join (select parent_id,value from users_metadata where `key`='fullname') a on a.parent_id = c_users_scores.user_id where rank >0 and league_id=$league order by rank asc limit $limit");
            $leader = $query->execute(self::DB_NAME)->as_array();
            return $leader;
        } catch (Exception $e) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    "Error while getting leader board " . $e->getMessage(),
                    __METHOD__);
            return array();
        }
    }

}
