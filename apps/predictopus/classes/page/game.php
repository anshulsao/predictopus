<?php

namespace Page;

use Fuel\Core\Session;
use Zap2it\Constants;
use Zap2it\Utils\Utils;

/**
 * Description of game
 *
 * @author asao
 */
class game extends \PageController {

    public function populateFields() {

        $gameId = $value_request = $this->request->param('gameid', '');
        if($gameId == ''){
            return;
        }
        //logger(400, print_r($gameId, 1));
        $model = \Model_OpenFootballModel::getInstance(8);
        $game = $model->getGameDetails($gameId);
        $team1 = $game['team1Name'];
        $team1code = $game['team1Code'];
        $team2 = $game['team2Name'];
        $date = $game['date'];
        $time = $game['timeDisp'];
        $this->title = "Predictopus - Predict results for $team1 vs $team2 on $date, FIFA World Cup 2014";
        $this->description = "Predict results for the FIFA World Cup 2014, Who do you fancy? $team1 or $team2 ! Kick off $date ($time local time) It’s time to unleash the Predictopus within!";
        $this->image = "http://static.playpredictopus.com/assets/img/badges/$team1code.php";
    }

}
