<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModuleTDV {

    protected $name;
    protected $isCached;
    protected $isCritical;
    protected $isLazy;
    protected $moduleParams;
    protected $moduleMarkup;

    public function getIsCritical() {
        return $this->isCritical;
    }

    public function getIsLazy() {
        return $this->isLazy;
    }

    public function setIsLazy($isLazy) {
        $this->isLazy = $isLazy;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    const MODAL_CSS_SUFFIX = '-modal.css';
    const MOBILE_CSS_SUFFIX = '-mobile.css';
    const TABLET_CSS_SUFFIX = '-tablet.css';
    const DESKTOP_CSS_SUFFIX = '-desktop.css';
    const EXPIRATION_TIME = 10800;

    /**
     * Construct module object from a config object
     * @param type $moduleConfig JSON config
     * @return Module object
     */
    public function __construct($moduleConfig) {
        //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($moduleConfig, 1), __METHOD__);
        $this->name = GenUtility::getValueSafelyArr($moduleConfig, 'module',
                        false);
        logger(\Fuel\Core\Fuel::L_DEBUG,
                "Creating new Module instance for $this->name", __METHOD__);
        if (!$this->name) {
            return false;
        }
        $this->isCached = GenUtility::getValueSafelyArr($moduleConfig, 'cache',
                        false);
        $this->isCritical = isset($moduleConfig['critical']) ? true : false;
        $this->isLazy = isset($moduleConfig['lazy']) ? true : false;
        $this->moduleParams = GenUtility::getValueSafelyArr($moduleConfig,
                        'params', array());
        //$this->isCached = false;
    }

    public function getLazyInlineJs($parentId, $requestParams) {
        $path = '/rmp/' . $this->name;
        $params = array_merge($requestParams, $this->moduleParams);
        $params["cache"] = $this->isCached;
        $params = json_encode($params);
        $js = <<<JS
           var config = {
               parentId: "$parentId",
               modulePath: "$path",
               moduleParams: $params
           }
           new Y.services.ModuleLazyLoader(config);
JS;
        return $js;
    }

    public function getCacheKey() {
        $isMobile = DeviceWrapper::is_mobileonly();
        $key = $isMobile ? $this->name . "-mobile" : $this->name;
        return $key;
    }

    public function getMarkup($requestParams) {
        $isCacheMiss = true;
        if ($this->isCached) {
            try {
                $moduleMarkup = Fuel\Core\Cache::get($this->getCacheKey(), true);
                $isCacheMiss = false;
                logger(\Fuel\Core\Fuel::L_DEBUG,
                        "Serving module $this->name from cache", __METHOD__);
            } catch (\Fuel\Core\CacheNotFoundException $e) {
                logger(\Fuel\Core\Fuel::L_DEBUG,
                        "Cache missed for module $this->name ", __METHOD__);
            }
        }
        if ($isCacheMiss ) {
            // load the module only if its not lazy
            $moduleMarkup = $this->getMarkupRaw($requestParams);

            if ($this->isCached && !empty($moduleMarkup)) {
                Fuel\Core\Cache::set($this->getCacheKey(), $moduleMarkup,
                        self::EXPIRATION_TIME);
            }
        }

        $this->moduleMarkup = $moduleMarkup;
        return $moduleMarkup;
    }

    public function getModuleJs($type = 'js') {
        $moduleMarkup = $this->moduleMarkup;
        if (!$moduleMarkup || !$moduleMarkup->response->body) {
            return false;
        }

        $moduleJs = GenUtility::getValueSafely($moduleMarkup->response->body,
                        $type);
        if (is_array($moduleJs)) {
            $moduleJs = array_filter($moduleJs);
        }

        if (!empty($moduleJs)) {
            return $moduleJs;
        }

        return false;
    }

    public function getCss() {
        $moduleName = $this->name;
        $cssBaseName = 'modules' . DS . $moduleName . DS . $moduleName;
        $moduleCss = $this->getModuleJs('css');
        $modalCss = $this->getCSSName($cssBaseName . self::MODAL_CSS_SUFFIX);
        if (DeviceWrapper::is_mobileonly()) {
            $deviceCss = $this->getCSSName($cssBaseName . self::MOBILE_CSS_SUFFIX);
        } else if (Agent::is_tablet()) {
            $deviceCss = $this->getCSSName($cssBaseName . self::TABLET_CSS_SUFFIX);
        } else {
            $deviceCss = $this->getCSSName($cssBaseName . self::DESKTOP_CSS_SUFFIX);
        }
        $defaultCss = array($modalCss, $deviceCss);        
        if (!$moduleCss) {
            $moduleCss = array();
        }

        return array_merge($defaultCss, $moduleCss);
    }

    private function getCSSName($css) {
        $fileName = APPPATH . 'public' . DS . 'assets' . DS . 'css' . DS . $css;
        logger(\Fuel\Core\Fuel::L_DEBUG, $fileName, __METHOD__);
        if (file_exists($fileName)) {
            return $css;
        }
        return false;
    }

    /**
     * Get markup for the module
     * @param type $request Request object
     * @return string
     */
    private function getMarkupRaw($requestParams) {

        try {
            $moduleRequest = Fuel\Core\Request::forge($this->name);
            $moduleRequest->named_params = array_merge($moduleRequest->named_params,
                    $requestParams, $this->moduleParams);
            $moduleMarkup = $moduleRequest->execute();
            $module = $this;
            /* logger(\Fuel\Core\Fuel::L_DEBUG,
              $module->getName() . " XXX: " . print_r($moduleMarkup, 1),
              __METHOD__); */
        } catch (HttpNotFoundException $e) {
            $moduleMarkup = false;
            logger(Fuel\Core\Fuel::L_ERROR, $e, __METHOD__);
        }
        return isset($moduleMarkup) ? $moduleMarkup : false;
    }

    const MODULE_ERR_FAILED = 0;
    const MODULE_ERR_EXCEPTION = 1;

    public static function getModuleError($condition, $data) {
        if ((\Fuel\Core\Fuel::$env == \Fuel\Core\Fuel::DEVELOPMENT)) {
            switch ($condition) {
                case self::MODULE_ERR_FAILED:
                    return "Module Not found/failed: $data";
                case self::MODULE_ERR_EXCEPTION:
                    return "Module threw exception: $data";
            }
        } else {
            return "";
        }
    }

}
