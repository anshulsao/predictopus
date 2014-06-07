<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller_Main extends Controller_Base {

    const EXPIRATION_TIME = 10800;
    const LAZY_PLACE_HOLDER = "<div class='z2t-rmp-loading'> Loading...</div>";
    const CSS = "css";
    const JS = "js";

    private $templateData = array(
        'title' => '',
        'description' => '',
        'slot1' => '',
        'slot2' => '',
        'slot3' => '',
        'slot4' => '',
        'slot5' => '',
        'slot6' => '',
        'slot7' => '',
        'slot8' => '',
        'header' => '',
        'footer' => '',
        'adsInlineJs' => '',
        'adsDisplayInlineJs' => '',
        'bodyClasses' => '',
        'tablet' => ''
    );
    private $css = array('bootstrap.min.css', 'themes/default/theme-modal.css');
    private $js = array('bootstrap.min.js', 'mustache.js');
    public static $isDev = false;
    private $moduleInlineJs = array();
    private $bodyClass = array();

    public function action_counter() {
        logger(\Fuel\Core\Fuel::L_ERROR,
                "HP:ADCALLNEW " . $_GET["message"] . $_SERVER['HTTP_USER_AGENT'],
                __METHOD__);
    }

    /**
     * All requests are routed here
     */
    public function action_index($pageType) {
        try {
            // 1. get request route
            // 2. call page mapper to get config and template
            // 3. process config and render template
            // 4. return final markup
            $fileName = APPPATH . 'config' . DS . 'pages' . DS . $pageType . '.json';
            //check if file exists
            if (!file_exists($fileName)) {
                logger(\Fuel\Core\Fuel::L_DEBUG,
                        "No page type found for " . $pageType);
                return Fuel\Core\Request::forge('_404_')->execute();
            }
            $pageConfig = Fuel\Core\Config::load($fileName);
            //$pageConfig = json_decode($pageConfigs, 1);
            //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($pageConfig, 1), __METHOD__);
            if (DeviceWrapper::is_mobileonly()) {
                $css[] = 'themes/default/theme-mobile.css';
                $view = \Fuel\Core\View::forge('base/mobile_page_template',
                                $this->templateData);
                $pageConfig = GenUtility::getValueSafelyArr($pageConfig,
                                'mobile');
                if (empty($pageConfig)) {
                    $pageConfig = GenUtility::getValueSafelyArr($pageConfig,
                                    'default');
                    $view = \Fuel\Core\View::forge('base/page_template_2',
                                    $this->templateData);
                }
            } else {
                if (DeviceWrapper::is_tabletonly()) {
                    $css[] = 'themes/default/theme-tablet.css';
                    $this->templateData['tablet'] = true;
                } else {
                    $css[] = 'themes/default/theme-desktop.css';
                    $this->templateData['tablet'] = false;
                }
                $view = \Fuel\Core\View::forge('base/page_template_2',
                                $this->templateData);
                $pageConfig = $pageConfig['default'];
            }
            $this->parsePageConfig($pageConfig, $view);
            $view->set('getMarkup',
                    function ($arr, $name) {
                return isset($arr[$name]) ? $arr[$name] : '';
            });
            $cssUrl = $this->getCDNComboedUrl(self::CSS, $this->css);
            $jsUrl = $this->getCDNComboedUrl(self::JS, $this->js);
            $view->set('cssUrl', $cssUrl, false);
            $view->set('jsUrl', $jsUrl, false);
            $view->set('moduleInlineJs', $this->moduleInlineJs, false);
            $view->set('bodyClasses', self::getBodyClasses($this->bodyClass));
            $status = 200;
            if (($pageType == 404) || ($pageType == 500)) {
                $status = $pageType;
            }
            return Fuel\Core\Response::forge($view, $status);
        } catch (\Fuel\Core\HttpNotFoundException $e) {
            return Fuel\Core\Request::forge('_404_')->execute();
        } catch (Exception $e) {
            if ((Fuel\Core\Config::get('z2t-show-errors'))) {
                throw $e;
            } else {
                $this->response_status = 500;
                return Fuel\Core\Request::forge('_500_')->execute();
            }
        }
    }

    private static function getBodyClasses($addClasses = null) {
        $bodyClass = '';
        if (GenUtility::isLoggedIn()) {
            $bodyClass .= ' loggedin ';
        } else {
            $bodyClass .= ' loggedout ';
        }

        if (\DeviceWrapper::is_tabletonly()) {
            $bodyClass .= "tablet";
        }

        if ($addClasses) {
            $bodyClass .= is_array($addClasses) ? implode(' ', $addClasses) : $addClasses;
        }

        if (\Fuel\Core\Config::get("ssl_login")) {
            $bodyClass .= " ssl-login";
        }

        return $bodyClass;
    }

    private function getCDNComboedUrl($type, $list) {
        $cdn = Fuel\Core\Config::get("cdn");
        $version = Fuel\Core\Config::get("cdnversion");
        //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($list, 1), __METHOD__);
        $url = "$cdn/combo$type?version=$version&" . implode("&", $list);
        return $url;
    }

    private function parsePageConfig($pageConfig, $view) {
        $title = $this->getValueSafelyArr($pageConfig, 'title');
        $description = $this->getValueSafelyArr($pageConfig, 'description');
        $adsConfig = $this->getValueSafelyArr($pageConfig, 'ads', array());
        $slotsConfig = $this->getValueSafelyArr($pageConfig, 'slots', array());
        $pageClass = $this->getValueSafelyArr($pageConfig, 'controller', null);
        if ($pageClass && class_exists($pageClass)) {
            logger(\Fuel\Core\Fuel::L_INFO,
                    "Page level controller found: $pageClass", __METHOD__);
            $reflection = new \ReflectionClass($pageClass);
            $pageController = $reflection->newInstance($title);
            $view->set('title', $pageController->getTitle());
            $view->set('description', $pageController->getDescription());
            $view->set('socialHeader', $pageController->getSocialHeader(), false);
            $trackingValuesAsJson = $pageController->getTrackingParams(true);
            $view->set('trackingParams', $trackingValuesAsJson, false);
            $view->set('htmlAttribs', $pageController->getHtmlAttribs(), false);
        } else {
            logger(\Fuel\Core\Fuel::L_DEBUG,
                    "Page level controller not found: $pageClass", __METHOD__);
            $view->set('title', $title);
            $view->set('description', $description);
            $view->set('socialHeader', '');
            $view->set('htmlAttribs', '');
        }

        $this->processSlots($view, $slotsConfig);
        $params = $this->request->param(AdsUtil::AD_TARGETTING_KEY);
        $view->set('adsInlineJs',
                AdsUtil::getAdDefinitionScript($adsConfig, $params), false);
        $view->set('adsDisplayInlineJs',
                AdsUtil::getAdDisplayScript($adsConfig), false);
        $this->renderBasicModules($view);
    }

    /**
     * Process slot info from the config file
     * @param type $view
     * @param type $slots
     */
    public function processSlots($view, $slots) {
        $slotsMarkup = array();
        foreach ($slots as $slot) {
            $slotName = $this->getValueSafelyArr($slot, 'slot', false);
            if (!$slotName) {
                // If the slot name is not present log and continue
                logger(\Fuel\Core\Fuel::L_WARNING,
                        "No slot name present skipping this slot", __METHOD__);
                continue;
            }
            $modules = $this->getValueSafelyArr($slot, 'modules');
            $markup = $this->getSlotMarkup($modules, $slotName);
            $slotsMarkup[$slotName] = $markup;
        }
        // set the slot markups
        $view->set('slots', $slotsMarkup, FALSE);
    }

    public function getSlotMarkup($modulesConfig, $slotId) {
        $request = $this->request;
        $slotMarkup = '';
        foreach ($modulesConfig as $moduleConfig) {
            $module = new ModuleTDV($moduleConfig);
            $params = $request->params();
            if ($module->getIsLazy()) {
                $inlineJs = $module->getLazyInlineJs($slotId, $params);
                $lazyPlaceHolder = self::LAZY_PLACE_HOLDER;
                $slotMarkup .= $lazyPlaceHolder;
                array_push($this->moduleInlineJs, $inlineJs);

                $bodyClass = $module->getModuleJs('bodyClass');
                array_push($this->bodyClass, $bodyClass);

                continue;
            }

            try {
                $markup = $module->getMarkup($params);
            } catch (\Fuel\Core\HttpNotFoundException $e) {
                throw $e;
            } catch (Fuel\Core\PhpErrorException $ex) {
                $markup = ModuleTDV::getModuleError(ModuleTDV::MODULE_ERR_EXCEPTION,
                                $module->getName() . "-" . $ex->getMessage());
                logger(\Fuel\Core\Fuel::L_ERROR, $ex, __METHOD__);
            } catch (Exception $ex) {
                $markup = ModuleTDV::getModuleError(ModuleTDV::MODULE_ERR_EXCEPTION,
                                $module->getName() . "-" . $ex->getMessage());
                logger(\Fuel\Core\Fuel::L_ERROR, $ex, __METHOD__);
            }

            if (!$markup || empty($markup) || (isset($markup->response) && isset($markup->response->body)
                    && empty($markup->response->body))) {
                if ($module->getIsCritical()) {
                    logger(\Fuel\Core\Fuel::L_ERROR,
                            '500 Internal Server Error for module: ' . $module->getName());
                    throw new Exception('Internal Server Error for module: ' . $module->getName());
                }
                $markup = ModuleTDV::getModuleError(ModuleTDV::MODULE_ERR_FAILED,
                                $module->getName());
            }
            $inlineJs = $module->getModuleJs('inlineJs');
            array_push($this->moduleInlineJs, $inlineJs);

            $bodyClass = $module->getModuleJs('bodyClass');
            array_push($this->bodyClass, $bodyClass);

            $jsArray = $module->getModuleJs();
            $cssArray = $module->getCss();
            /* logger(\Fuel\Core\Fuel::L_DEBUG,
              "CSS ----> " . print_r($cssArray, 1), __METHOD__); */
            $this->css = array_merge($this->css, $cssArray);
            if ($jsArray) {
                $this->js = array_merge($this->js, $jsArray);
            }
            $slotMarkup = &$markup;
        }
        return $slotMarkup;
    }

    /**
     * Sets view for common modules like header
     * @param type $view
     */
    public function renderBasicModules($view) {
        $headerConfig = array(
            "module" => 'header'
        );

        $header = new ModuleTDV($headerConfig);
        $params = $this->request->params();
        $markup = $header->getMarkup($params);
        $inlineJs = $header->getModuleJs('inlineJs');
        array_push($this->moduleInlineJs, $inlineJs);
        $jsArray = $header->getModuleJs();
        $cssArray = $header->getCss();
        $this->css = array_merge($this->css, $cssArray);
        if ($jsArray) {
            $this->js = array_merge($this->js, $jsArray);
        }
        $view->set('header', $markup, FALSE);
    }

    /**
     * Check if the css is already added for the page and is present and add it 
     * to the css array accordingly.
     * 
     * TODO: File exists check
     * 
     * @param type $cssName Name of the css to be added
     */
    private function addCss($cssName) {
        if (!array_key_exists($cssName, $this->css)) {
            $this->css[$cssName] = $cssName;
        }
    }

    /**
     * Get the comboed assets 
     * @param $type "css" or "js"
     * @return response 
     */
    public function action_combo($type) {
        $params = $_GET;
        switch ($type) {
            case "css":
                $header = array("Content-type" => "text/css");
                break;
            case "js":
                $header = array("Content-type" => "application/javascript");
                break;
        }

        $fileName = $this->getComboedAsset($type, array_keys($_GET));
        $content = "";
        if (!empty($fileName)) {
            $content = file_get_contents($fileName);
        }
        return \Fuel\Core\Response::forge($content, '200', $header);
    }

    private function getComboedAsset($type, $list) {
        switch ($type) {
            case "css":
                foreach ($list as $key => $value) {
                    $value = str_replace("_", ".", $value);
                    try {
                        \Casset\Casset::get_filepath_css($value);
                    } catch (\Casset\Casset_Exception $e) {
                        continue;
                    }
                    \Casset\Casset::css($value);
                }
                $header = array("Content-type" => "text/css");
                $fileName = \Casset\Casset::render_css(false,
                                array("gen_tags" => false));
                /* logger(\Fuel\Core\Fuel::L_DEBUG, print_r($fileName, 1),
                  __METHOD__); */
                break;
            case "js":
                foreach ($list as $key => $value) {
                    $value = str_replace("_", ".", $value);
                    try {
                        \Casset\Casset::get_filepath_js($value);
                    } catch (\Casset\Casset_Exception $e) {
                        continue;
                    }
                    \Casset\Casset::js($value);
                }
                $header = array("Content-type" => "application/javascript");
                $fileName = \Casset\Casset::render_js(false,
                                array("gen_tags" => false));
                /* logger(\Fuel\Core\Fuel::L_DEBUG, print_r($fileName, 1),
                  __METHOD__); */
                break;
        }


        $content = "";
        if (count($fileName) > 0) {
            $fileName = explode("/", $fileName[0]);
            $fileName = $fileName[5];
            return \Casset\Casset::get_cache_path() . $fileName;
        }
        return false;
    }

    public function action_rmp() {

        $modulePath = $this->getParam("modulepath");
        $format = $this->getParam("format");
        logger(\Fuel\Core\Fuel::L_INFO, "Rmp Call for module: $modulePath",
                __METHOD__);
        $moduleConfig = array(
            "module" => $modulePath
        );
        $module = new ModuleTDV($moduleConfig);
        $params = $this->request->params();
        $markup = $module->getMarkup($params);
        $cssArray = $module->getCss();        
        if ($format !== "json") {
            $cssArray = array_merge($this->css, $cssArray);
        }
        $inlineJS = $module->getModuleJs('inlineJs');
        $js = $module->getModuleJs();
        $classes = $this->getParam("classes");
        $cssUrl = $this->getCDNComboedUrl(self::CSS, $cssArray);
        $jsUrl = "";
        if (!empty($js)) {
            $jsUrl = $this->getCDNComboedUrl(self::JS, $js);
        }
        $templateData = array(
            "classes" => $classes,
            "css" => $cssUrl,
            "markup" => utf8_encode($markup),
            "inline" => $inlineJS,
            "js" => $jsUrl
        );        
        $templateDataEncoded = json_encode($templateData);
        //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($templateDataEncoded, 1),
        //      __METHOD__);
        if ($format == "json") {
            $response = \Fuel\Core\Response::forge($templateDataEncoded, '200',
                            array("Content-type" => "application/json"));
            return $response;
        }

        $view = \Fuel\Core\View::forge('base/rmp_full', $templateData, false);
        return Fuel\Core\Response::forge($view);
    }

    public function action_loadbalancer() {
        $view = \Fuel\Core\View::forge('base/index');
        return Fuel\Core\Response::forge($view);
    }

    public function action_respondproxy() {
        $view = \Fuel\Core\View::forge('base/respondproxy');
        return Fuel\Core\Response::forge($view);
    }

}
