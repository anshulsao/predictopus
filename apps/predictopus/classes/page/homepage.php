<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Page;

use Fuel\Core\Session;
use Zap2it\Constants;
use Zap2it\Utils\Utils;

class HomePage extends \PageController {
  
    public function populateFields() {
        $this->title = 'Predictopus - Predict results FIFA Worldcup 2014, Game, Fun';
        $this->description = 'Right here is the perfect way to test your predictions and compete with thousands of others! It’s time to unleash the Predictopus within!';
        $this->image = 'http://static.playpredictopus.com/assets/img/logo.png';                
    }

}
