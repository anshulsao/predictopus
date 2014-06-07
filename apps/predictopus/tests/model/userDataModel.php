<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @group PredModel
 * @group UserDataModel
 */
class Test_Model_UserDataModel extends \Model_Base {

    const DB_NAME = 'local';

    public static function test_insertPrediction() {
        $userid = 1;
        $gameid = 0078888;
        $predictions = array('test' => 'test');
        $output = Model_UserDataModel::insertPrediction($gameid, $result,
                        $predictions, $userid);
        echo print_r($output, 1);
        assert(true);
    }
}
