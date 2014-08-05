<?php

namespace Tagcloud;

/**
 * Description of tagcloud
 *
 * @author asao
 */
class Controller_Tagcloud extends \Controller_ModuleBase {

    public function action_index() {
        $modData = array();
        $data = array(
            "moduleId" => 'tagcloud',
            "moduleClasses" => '',
			"head" => "Your Stamps",
            "content" => \View::forge('tagcloud.mustache', $modData),
            "js" => array('modules/tagcloud/tagcloud.js', 'modules/tagcloud/tagcloudcustom.js'),
            "css" => array(),
            "inlineJs" => '',
        );
        return $this->render($data);
    }

}
