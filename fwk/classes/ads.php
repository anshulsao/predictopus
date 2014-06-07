<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdsUtil {

    const AD_TARGETTING_KEY = "adsTarget";

    public static $adsConfig = '';

    public static function getAdDefinitionScript($pageAdsConfig, $params) {
        // should define the ads
        $adsConfig = Fuel\Core\Config::load(APPPATH . 'config' . DS . 'ads.json');
        $adsConfig = json_encode($adsConfig);
        self::$adsConfig = $adsConfig;
        $params = json_encode($params);
        $pageAdsConfig = self::encodeAdsConfig($pageAdsConfig);
        return "GPTWrapper.targeting = $params; gptWrapper = new GPTWrapper($pageAdsConfig, $adsConfig);";
    }

    public static function getAdDisplayScript($pageAdsConfig) {
        $adsConfig = self::$adsConfig;
        //logger(\Fuel\Core\Fuel::L_ERROR, $adsConfig, __METHOD__);
        $pageAdsConfig = self::encodeAdsConfig($pageAdsConfig);
        return "GPTWrapper.displayDefinedAds($pageAdsConfig,$adsConfig);";
    }

    private static function encodeAdsConfig($pageAdsConfig) {

        //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($pageAdsConfig, 1), __METHOD__);
        $prefix = Fuel\Core\Config::get("adsPrefix");
        $unitName = GenUtility::getValueSafelyArr($pageAdsConfig,
                        'relUnitName', null);
        if (isset($unitName)) {
            $pageAdsConfig["unitName"] = $prefix . $unitName;            
        }
        return json_encode($pageAdsConfig);
    }

    /**
     * 
     * @param type $request active request object
     * @param type $key 
     * @param type $value
     * @usage AdsUtil::adTargeting($this->request, "anshul", "sao");
     */
    public static function adTargeting($request, $key, $value) {
        $params = GenUtility::getValueSafelyArr($request->named_params,
                        self::AD_TARGETTING_KEY, array());

        if (!empty($value)) {
            $params[$key] = $value;
            $request->named_params[self::AD_TARGETTING_KEY] = $params;
        }
    }

}
