<?php
namespace Util;
/**
 * Description of utils
 *
 * @author asao
 */
class Utils {

    /**
     * Get a well formed URL for webservices calls
     * @param type $server
     * @param type $endPoint
     * @param type $templateData
     * @return string
     */
    public static function getUrl($server, $endPoint, $templateData = '') {
        if (!empty($templateData)) {
            foreach ($templateData as $index => $data) {
                $endPoint = \str_replace('{'."$index}", $data, $endPoint);
            }
        }
        $url = $server . $endPoint;
        return $url;
    }

}
