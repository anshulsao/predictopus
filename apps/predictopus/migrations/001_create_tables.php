<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fuel\Migrations;

class Create_Tables {

    const USERTABLE = 'c_users';
    const RELTABLE = 'c_rel';

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
                'result' => array('type' => 'int', 'constraint' => 4),
                'hresult' => array('type' => 'int', 'constraint' => 4),
                'prediction' => array('type' => 'blob', 'default' => ''),
                'points' => array('type' => 'bigint', 'constraint' => 20),
                'processed' => array('type' => 'tinyint', 'constraint' => 1, 'default' => '0'),
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

        try {
            //id 	league_name
            \Fuel\Core\DBUtil::create_table('c_leagues',
                    array(
                'league_id' => array('type' => 'bigint', 'constraint' => 20, 'auto_increment' => true),
                'name' => array('type' => 'varchar', 'constraint' => 256,
                    'default' => ''),
                'type' => array('type' => 'varchar', 'constraint' => 256,
                    'default' => ''),
                'public' => array('type' => 'tinyint', 'constraint' => 1, 'default' => '1'),
                'metadata' => array('type' => 'blob', 'default' => ''),
                'create_date' => array('type' => 'timestamp', ' default' => 'CURRENT_TIMESTAMP'),
                    ), array('league_id'));
            // Create a global league
            \Fuel\Core\DB::insert('c_leagues')->columns(array('name', 'type', 'public'))->values(
                    array('Global League', 'System', 1))->execute('local');
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }

        //id	user_id	league_id		points
        try {
            \Fuel\Core\DBUtil::create_table(self::USERTABLE . '_scores',
                    array(
                'id' => array('type' => 'bigint', 'constraint' => 20, 'auto_increment' => true),
                'user_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '0'),
                'points' => array('type' => 'bigint', 'constraint' => 20),
                'metadata' => array('type' => 'blob', 'default' => ''),
                'modified_date' => array('type' => 'timestamp', ' default' => 'CURRENT_TIMESTAMP'),
                    ), array('id'));
            \DBUtil::create_index(self::USERTABLE . '_scores', array('user_id'),
                    'userid', 'UNIQUE');
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
                'user_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '0'),
                'rank' => array('type' => 'int', 'constraint' => 11, 'default' => '0'),
                'metadata' => array('type' => 'blob', 'default' => ''),
                'join_date' => array('type' => 'timestamp', ' default' => 'CURRENT_TIMESTAMP'),
                    ), array('id'));
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }


        try {
            //id 	league_name	
            \Fuel\Core\DBUtil::create_table('c_results',
                    array(
                'id' => array('type' => 'bigint', 'constraint' => 20, 'auto_increment' => true),
                'game_id' => array('type' => 'bigint', 'constraint' => 20),
                'hscore1' => array('type' => 'int', 'constraint' => 4, 'default' => '0'),
                'hscore2' => array('type' => 'int', 'constraint' => 4, 'default' => '0'),
                'fscore1' => array('type' => 'int', 'constraint' => 4, 'default' => '0'),
                'fscore2' => array('type' => 'int', 'constraint' => 4, 'default' => '0'),
                'processed' => array('type' => 'tinyint', 'constraint' => 1, 'default' => '0'),
                'metadata' => array('type' => 'blob', 'default' => ''),
                'result_date' => array('type' => 'timestamp', ' default' => 'CURRENT_TIMESTAMP'),
                    ), array('id'));
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }
        \DBUtil::set_connection(null);
    }

    function down() {
        \DBUtil::drop_table(self::USERTABLE . '_predictions');
        \DBUtil::drop_table(self::USERTABLE . '_scores');
        \DBUtil::drop_table('c_leagues');
        //\DBUtil::drop_table(self::RELTABLE . '_users_league');
        \DBUtil::drop_table('c_results');

        \DBUtil::set_connection(null);
    }

}
