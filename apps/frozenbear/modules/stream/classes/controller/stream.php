<?php

namespace Stream;

/**
 * Description of stream
 *
 * @author asao
 */
class Controller_Stream extends \Controller_ModuleBase {

    public function action_index() {
        // Call Model to get data
        $response = \Model_UserModel::getUserHomeFeed(0,50);
        if($response->getStatus() != '200'){
            return false;
        }
        $streamData = $response->getBodyObjectJSON();
        //logger(\Fuel\Core\Fuel::L_ERROR, print_r($streamData, 1), __METHOD__);
        $modData = array(
            'stream' => $streamData
        );
        $data = array(
            "moduleId" => 'stream',
            "moduleClasses" => '',
            "content" => \View::forge('stream.mustache', $modData),
            "js" => array(),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }

}
