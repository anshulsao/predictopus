<?php

namespace Tagcloud;

/**
 * Description of tagcloud
 *
 * @author asao
 */
class Controller_Tagcloud extends \Controller_ModuleBase {

    public function action_index() {
        $response = \Model_UserModel::getUserStampCloud(0, 50, false);
        if ($response->getStatus() != '200') {
            return false;
        }
        $tagData = \GenUtility::getValueSafelyArr($response->getBodyObjectJSON(), 'stamp_details');
        $tagDataNew = array();
        foreach ($tagData as $key => $data){
            $data['tag_name'] = $key;
            $tagDataNew[] = $data;          
        }
        $modData = array(
            'tags' => $tagDataNew
        );
        logger(\Fuel\Core\Fuel::L_ERROR, print_r($modData, 1), __METHOD__);
        $data = array(
            "moduleId" => 'tagcloud',
            "moduleClasses" => '',
            "head" => "Your Stamps",
            "content" => \View::forge('tagcloud.mustache', $modData),
            "js" => array(),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }

}
