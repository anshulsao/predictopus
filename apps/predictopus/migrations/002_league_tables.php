<?php

namespace Fuel\Migrations;

/**
 * Description of 002_league_tables
 *
 * @author asao
 */
class League_tables {

    const USERTABLE = 'c_users';

    /**
     * Alter leagues table to include other league details
     * Alter points table to have league column
     * Assign default league to 1
     * Table to record league to user mapping
     */
    function up() {
        try {
            \Fuel\Core\DBUtil::create_table(self::USERTABLE . '_leagues',
                    array(
                'id' => array('type' => 'bigint', 'constraint' => 20, 'auto_increment' => true),
                'user_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '0'),
                'league_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '0'),
                'join_date' => array('type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')),
                    ), array('id'));
            \DBUtil::create_index(self::USERTABLE . '_leagues',
                    array('user_id', 'league_id'), 'userleague', 'UNIQUE');
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }
        try {
            \Fuel\Core\DBUtil::add_fields(self::USERTABLE . '_scores',
                    array(
                'league_id' => array('type' => 'bigint', 'constraint' => 20, 'default' => '1'),
                'rank' => array('type' => 'int', 'constraint' => 11, 'default' => '0')
            ));
            \Fuel\Core\DBUtil::modify_fields(self::USERTABLE . '_scores',
                    array(
                'modified_date' => array('type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')),
            ));
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }

        try {
            \Fuel\Core\DBUtil::add_fields('c_leagues',
                    array(
                'tournament' => array('type' => 'int', 'constraint' => 10, 'default' => '8'),
                'start_date' => array('type' => 'timestamp', 'default' => '0000-00-00 00:00:00'),
            ));
            \Fuel\Core\DBUtil::modify_fields('c_leagues',
                    array(
                'create_date' => array('type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')),
                'name' => array('type' => 'varchar', 'constraint' => 200,
                    'default' => ''),
            ));
            \Fuel\Core\DBUtil::create_index('c_leagues', array('name'), 'name',
                    'UNIQUE');
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }
        try {
            \Fuel\Core\DBUtil::drop_index('c_users_scores','userid');
            \Fuel\Core\DBUtil::drop_index('c_users_scores','userleague');
            \Fuel\Core\DBUtil::create_index('c_users_scores',
                    array('user_id', 'league_id'), 'userleague', 'UNIQUE');             
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }
        $leagueQuery = "insert into c_leagues(name, type, public, tournament, start_date) values('Super 16', 'System', 1, 8, '2014-06-28 00:00:00')";
        $query = \Fuel\Core\DB::query($leagueQuery);
        try {
            $query->execute();
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }
    }

    function down() {
        \DBUtil::drop_table(self::USERTABLE . '_leagues');
        try {
            \Fuel\Core\DBUtil::drop_fields(self::USERTABLE . '_scores',
                    array('league_id', 'rank'));
            \Fuel\Core\DBUtil::drop_fields('c_leagues',
                    array('tournament', 'start_date'));
        } catch (\Database_Exception $e) {
            // Table Creation failed...
            echo $e->getMessage();
        }
    }

}
