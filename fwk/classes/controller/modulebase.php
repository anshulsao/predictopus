<?php

/**
 * This controller acts as a base class for all TDV modules 
 * Functionalities: 
 *  - Consistant markup for all modules
 *  - Abstract js and css inclusion as well as module id generation
 * @author Anshul Sao <anshul.sao@tribune.com>
 */

/**
 * The ModuleBase Controller.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_ModuleBase extends Controller_Base {

    static $defaultData = array(
        "moduleId" => "auto-generated-id-",
        "moduleClasses" => "",
        "head" => "",
        "foot" => "",
        "content" => "",
        "js" => array(),
        "css" => array(),
        "inlineJs" => '',
    );

    public function before() {
        parent::before();
    }

    public function render($data) {
        self::$defaultData["moduleId"] .= rand();
        $data = array_merge(self::$defaultData, $data);
        $view = \Fuel\Core\View::forge('base/module', $data);
        $view->set('head', $data['head'], false);
        return $view;
    }

    protected function jsonSuccessMsg($message) {
        return $this->renderJson('success', $message);
    }

    protected function jsonErrorMsg($message) {
        return $this->renderJson('error', $message);
    }

    protected function jsonError($data) {
        return $this->renderJson('error', '', $data);
    }

    protected function jsonSuccess($data) {
        return $this->renderJson('success', '', $data);
    }

    protected function renderJson($status = 'success', $message = '',
            $data = array()) {
        $output = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
        $host = \Fuel\Core\Uri::base(false);
        $host = str_replace("https:", "http:", $host);
        $host = substr($host, 0, strlen($host) - 1);
        $headers = array(
            'Access-Control-Allow-Origin' => $host,
            'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept, Cookie',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
            'Content-type' => 'application/json'
        );
        return \Fuel\Core\Response::forge(json_encode($output), '200', $headers);
    }

    protected function getValueSafely($object, $key, $default = '') {
        if (isset($object) && isset($object->{$key})) {
            return $object->{$key};
        }
        return $default;
    }

    /**
     * Function to retrieve value from an $array for the given $key.
     * Optionally specify a default value to be returned if $key is not present in the object
     *
     * @param        $array
     * @param        $keys
     * @param string $default
     * @param string $splitter
     * @return string
     */
    protected function getValueSafelyArr($array, $keys, $default = '',
            $splitter = ',') {
        return GenUtility::getValueSafelyArr($array, $keys, $default,
                        $splitter);
    }

}
