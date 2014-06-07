<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fuel\Migrations;

class Create_Tables {

    const USERTABLE = 'C_users';
    const RELTABLE = 'C_rel';

    function up() {
        try {
            \Fuel\Core\DBUtil::create_database('predictopus');
        } catch (\Database_Exception $e) {
            // Creation failed...
        }

        //user_id	game_id	 result	hgoal1	hgoal2	fgoal1	fgoal2	scorers 	points
        try {
            \Fuel\Core\DBUtil::create_table(self::USERTABLE . '_predictions',
                    array(
                'id' => array('type' => 'bigint', 'constraint' => 20, 'auto_increment' => true),
                'user_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '0'),
                'game_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '0'),
                'result' => array('type' => 'int'),
                'prediction' => array('type' => 'blob', 'default' => ''),
                'points' => array('type' => 'bigint', 'constraint' => 20),
                'modified_date' => array('type' => 'timestamp', ' default' => 'CURRENT_TIMESTAMP'),
                    ), array('id'));
            \DBUtil::create_index(self::USERTABLE . '_predictions',
                    array('user_id', 'game_id'), 'usergame', 'UNIQUE');
            \Fuel\Core\DBUtil::create_index(self::USERTABLE . '_predictions',
                    array('game_id'), 'game');
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }

        //id	user_id	league_id		points
        try {
            \Fuel\Core\DBUtil::create_table(self::USERTABLE . '_league_scores',
                    array(
                'id' => array('type' => 'bigint', 'constraint' => 20, 'auto_increment' => true),
                'user_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '0'),
                'league_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '0'),
                'points' => array('type' => 'bigint', 'constraint' => 20),
                'modified_date' => array('type' => 'datetime'),
                    ), array('id'));
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }

        try {
            //id 	league_name	
            \Fuel\Core\DBUtil::create_table('C_leagues',
                    array(
                'id' => array('type' => 'bigint', 'constraint' => 20, 'auto_increment' => true),
                'league_name' => array('type' => 'varchar', 'constraint' => 256,
                    'default' => ''),
                'create_date' => array('type' => 'datetime'),
                    ), array('id'));
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }

        try {
            //id 	league_name	
            \Fuel\Core\DBUtil::create_table(self::RELTABLE . '_users_league',
                    array(
                'id' => array('type' => 'bigint', 'constraint' => 20, 'auto_increment' => true),
                'league_id' => array('type' => 'bigint', 'constraint' => 20),
                'join_date' => array('type' => 'datetime'),
                    ), array('id'));
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }
        \DBUtil::set_connection(null);
    }

    function down() {
        \DBUtil::drop_table(self::USERTABLE . '_predictions');
        \DBUtil::drop_table(self::USERTABLE . '_league_scores');
        \DBUtil::drop_table('C_leagues');
        \DBUtil::drop_table(self::RELTABLE . '_users_league');

        \DBUtil::set_connection(null);
    }

}
