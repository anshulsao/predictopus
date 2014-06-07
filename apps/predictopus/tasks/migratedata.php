<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fuel\Tasks;

class MigrateData {

    public static $tournamentId = 8;
    public static $db = null;

    public static function importAll() {

        self::$db = new \SQLite3(ROOT . 'football.db');
        $start = microtime();
        $teams = self::getTeams();
        //echo print_r($teams, 1);
        $grounds = self::getGrounds();
        //echo print_r($grounds, 1);
        $games = self::getFixutres();
        //echo print_r($games, 1);
        $end = microtime();

        echo print_r($end - $start, 1);
    }

    public static function getFixutres() {
        $groups = array();
        $db = self::$db;
        $queryRounds = "select * from rounds where event_id=" . self::$tournamentId;
        $results = $db->query($queryRounds);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {

            $queryGames = "select * from games where round_id=" . $row['id'];
            $games = array();
            $results2 = $db->query($queryGames);
            while ($row2 = $results2->fetchArray(SQLITE3_ASSOC)) {
                array_push($games, $row2);
            }
            $row["games"] = $games;
            array_push($groups, $row);
        }

        return $groups;
    }

    public static function getGrounds() {
        $grounds = array();
        $queryGetGroundIds = "select ground_id from events_grounds where event_id=" . self::$tournamentId;
        $queryGetGrounds = "select * from grounds where id in";
        $results = self::cascadeQuery($queryGetGroundIds, $queryGetGrounds);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $city = self::getCity($row["city_id"]);
            $country = self::getCountry($row["country_id"]);
            $row["city"] = $city;
            $row["country"] = $country;
            array_push($grounds, $row);
        }
        return $grounds;
    }

    public static function cascadeQuery($idQuery, $nextQuery) {
        $db = self::$db;
        $results = $db->query($idQuery);
        $idArr = array();
        while ($row = $results->fetchArray(SQLITE3_NUM)) {
            array_push($idArr, $row[0]);
        }
        $ids = implode(",", $idArr);
        $results = $db->query($nextQuery . "($ids)");
        return $results;
    }

    public static function getTeams() {
        $teams = array();
        $db = self::$db;
        $queryGetTournamentTeams = "select team_id from events_teams where event_id=" . self::$tournamentId;
        $queryTeamsByIds = "select id,key,title,code,country_id from teams where id in ";
        $results = self::cascadeQuery($queryGetTournamentTeams, $queryTeamsByIds);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $country = self::getCountry($row["country_id"]);
            echo "flag-".$country['key']. "   flag-".$country['code']."\n";
            $players = self::getPlayers($row["id"]);
            $row["country"] = $country;
            $row["players"] = $players;
            unset($row["country_id"]);
            array_push($teams, $row);
            //echo print_r($row, 1);
        }
        return $teams;
    }

    public static function getPlayers($teamId) {
        $db = self::$db;
        $players = array();
        $queryRoster = "select person_id from rosters where team_id=$teamId and event_id=" . self::$tournamentId;
        $queryGetPlayers = "select id,key,name,synonyms,born_at,country_id,nationality_id from persons where id in ";
        $results = self::cascadeQuery($queryRoster, $queryGetPlayers);

        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            array_push($players, $row);
        }
        return $players;
    }

    public static function getCountry($countryId) {
        $db = self::$db;
        $query = "select * from countries where id=$countryId";
        $results = $db->query($query);
        return $results->fetchArray(SQLITE3_ASSOC);
    }

    public static function getCity($cityId) {
        $db = self::$db;
        $query = "select * from places where id=$cityId";
        $results = $db->query($query);
        return $results->fetchArray(SQLITE3_ASSOC);
    }

}
