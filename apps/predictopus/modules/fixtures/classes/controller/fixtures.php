<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fixtures;

class Controller_Fixtures extends \Controller_ModuleBase {

    /**
     * Full Fixtures for given tournament id
     * @return type
     */
    public function action_index() {
        $tournamentId = $this->getParam('tournamentId');
        $model = \Model_OpenFootballModel::getInstance($tournamentId);
        $modData = $model->getFullFixtures($tournamentId);
        logger(\Fuel\Core\Fuel::L_DEBUG, print_r($modData, 1), __METHOD__);
        $data = array(
            "moduleId" => 'full-fixtures',
            "moduleClasses" => '',
            "content" => \View::forge('fullfixtures.mustache',
                    array('fixtures' => $modData)),
            "js" => array(''),
            "css" => array('flags.css'),
            "inlineJs" => '',
            "head" => "Fixtures" 
        );
        return $this->render($data);
    }

}
