<?php
/**
 * Wrapper class on top of Special_Agent package to enforce strict mobile and tablet detection since is_mobile() returns
 * true for both mobiles and tablets.

 */
use \Fuel\Core\Request;
class DeviceWrapper extends \Agent{

    public static function getDeviceType(){
        $reqParams = Request::main()->named_params;
        if(isset($reqParams['devicetype'])){
            return $reqParams['devicetype'];
        } else {
            if(self::is_mobile()){
                $isTablet = self::is_tablet();
                if($isTablet)
                    $deviceType = 'tablet';
                else
                    $deviceType = 'mobile' ;
            } else {
                $deviceType = 'desktop';
            }
            Request::main()->named_params['devicetype'] = $deviceType;

            return $deviceType;
        }
    }

    public static function is_mobileonly(){
        return self::getDeviceType() == 'mobile';
    }

    public static function is_tabletonly(){
        return self::getDeviceType() == 'tablet';
    }

} 