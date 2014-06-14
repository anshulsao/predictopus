<?php

class Model_OpenFootballModel extends \Model_Base {

    const DBNAME = 'football.db';

    public $tournamentId;
    public static $instances = array();
    public $teams = array();
    public $grounds = array();

    public function __construct($tournamentId) {
        parent::__construct();
        $this->tournamentId = $tournamentId;
        $this->db = new SqlLiteDb(ROOT . self::DBNAME);
        $this->getTeams();
        $this->getGrounds();
    }

    public static function getInstance($tournamentId) {
        $instance = GenUtility::getValueSafelyArr(self::$instances,
                        $tournamentId, '');
        if (empty($instance)) {
            $instance = new Model_OpenFootballModel($tournamentId);
            self::$instances[$tournamentId] = $instance;
        }
        return $instance;
    }

    public function getFullFixtures($userid = '') {
        if (empty($userid)) {
            $userid = \Auth\Auth::get('id');
        }
        $db = $this->db;
        $fixtures = array();
        $queryRounds = "select * from rounds where event_id=" . $this->tournamentId;
        $results = $db->query($queryRounds);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $queryGames = "select * from games where round_id=" . $row['id'];
            $games = array();
            $gameIds = array();
            $results2 = $db->query($queryGames);
            while ($row2 = $results2->fetchArray(SQLITE3_ASSOC)) {
                //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($row2, 1), __METHOD__);
                $data = $this->parseGame($row2);
                $gameDate = $data['time'];
                $time = strtotime($gameDate) + 3 * 60 * 60;
                if ($time < strtotime("now")) {
                    $data['matchEnded'] = true;
                }
                array_push($games, $data);
            }
            //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($row, 1), __METHOD__);
            $gameDate = GenUtility::getValueSafelyArr($row, 'start_at');
            $fixture = array(
                'title' => $row['title'],
                'date' => $gameDate,
                'games' => $games
            );
            if (!empty($gameDate)) {
                $gameDateObj = new DateTime($gameDate);
                $gameDateDisp = $gameDateObj->format('d M Y');
                $fixture['dispStartDate'] = $gameDateDisp;
                $gameDate2 = GenUtility::getValueSafelyArr($row, 'end_at');
                $gameDateObj2 = new DateTime($gameDate2);
                $gameDateDisp2 = $gameDateObj2->format('d M Y');
                if ($gameDateDisp2 !== $gameDateDisp) {
                    $fixture['dispEndDate'] = $gameDateDisp2;
                }                
                
            }
            logger(\Fuel\Core\Fuel::L_DEBUG, "--->" . print_r($fixture, 1), __METHOD__);
            array_push($fixtures, $fixture);
        }

// populate predictions
        if (!empty($userid)) {
            $games2 = array();
            foreach ($fixtures as &$fix) {
                foreach ($fix['games'] as &$game) {
                    $games2[$game['id']] = &$game;
                }
            }
            $gameIds = array_keys($games2);
            $predictions = Model_UserDataModel::getPredictionsUser($gameIds);
            //logger(400,"*******: ". print_r($predictions, 1));
            foreach ($predictions as $prediction) {
                $id = $prediction['game_id'];
                $game = &$games2[$id];
                $game['p'] = $prediction;
                //logger(400,"*******: ". print_r($game, 1));
                
            }
        }
        return $fixtures;
    }

    public function getGameDetails($gameId) {
        $game = array();
        $db = $this->db;
        $queryGames = "select * from games where id=" . $gameId;
        $results = $db->query($queryGames);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $game = $this->parseGame($row);
            //logger(400, print_r($this->teams, 1), __METHOD__);
        }
        return $game;
    }

    private function parseGame($row2) {
        $team1 = $this->teams[$row2['team1_id']];
        $team2 = $this->teams[$row2['team2_id']];
        $timeRaw = $row2['play_at'];
        $timeObj = new DateTime($timeRaw);
        $time = $timeObj->format('H:s');
        $date = $timeObj->format('d M Y');
        $groundObj = GenUtility::getValueSafelyArr($this->grounds,
                        $row2['ground_id'], array());
        $data = array(
            'id' => $row2['id'],
            'team1Name' => $team1['title'],
            'team1Code' => strtolower($team1['code']),
            'team2Name' => $team2['title'],
            'team2Code' => strtolower($team2['code']),
            'time' => $timeRaw,
            'timeDisp' => $time,
            'date' => $date,
            'groundTitle' => GenUtility::getValueSafelyArr($groundObj, 'title'),
            'groundFullTitle' => GenUtility::getValueSafelyArr($groundObj,
                    'synonyms'),
            'groundCapacity' => GenUtility::getValueSafelyArr($groundObj,
                    'capacity'),
            'p' => false
        );
        return $data;
    }

    private function getTeams() {
        $db = $this->db;
        $queryGetTournamentTeams = "select team_id from events_teams where event_id=" . $this->tournamentId;
        $queryTeamsByIds = "select id,key,title,code,country_id from teams where id in ";
        $results = $db->cascadeQuery($queryGetTournamentTeams, $queryTeamsByIds);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $this->teams[$row['id']] = $row;
        }
        //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($this->teams, 1), __METHOD__);
    }

    private function getGrounds() {
        $db = $this->db;
        $grounds = array();
        $queryGetGroundIds = "select ground_id from events_grounds where event_id=" . $this->tournamentId;
        $queryGetGrounds = "select * from grounds where id in";
        $results = $db->cascadeQuery($queryGetGroundIds, $queryGetGrounds);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $this->grounds[$row['id']] = $row;
        }
        //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($this->grounds, 1), __METHOD__);
    }

}
