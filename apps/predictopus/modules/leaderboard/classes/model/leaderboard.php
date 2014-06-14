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

    public static function getLeaderBoard($limit = 20) {
        try {
            
            $query = \Fuel\Core\DB::query("select c_rel_users_league.user_id, rank, value, a.points from c_rel_users_league left join (select parent_id,points,value from users_metadata left join c_users_scores on users_metadata.parent_id=c_users_scores.user_id where `key`='nickname') a on a.parent_id = c_rel_users_league.user_id where rank >0 order by rank asc limit $limit");
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
