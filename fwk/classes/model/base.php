<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This is the parent class of all modules containing some common 
 * functionalities
 *
 * @author asao
 */
class Model_Base extends \Fuel\Core\Model {

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const TMS_API_KEY = 'gxfbjnutbyvesr7kqmf84zv8';
    const API_VERSION = '/v1';
    const HOST_HEADER_KEY = 'Host';
    const SOLR_SEARCH_URL_BASE = '/select';
    const SOLR_RECO_P2P_URL_BASE = '/select';
    const SOLR_POPULAR_URL_BASE = '/select';
    const SOLR_SIMILAR_ARTICLE_URL_BASE = '/mlt';

    protected $servers;
    protected $tempHash;

    public function __construct() {
        $this->servers = \Fuel\Core\Config::get('servers');
    }

    /**
     * 
     * @param type $host
     * @param type $urlFragment
     * @param type $method GET, POST etc
     * @param type $headers array of headers in key => value format
     * @param type $params array of params to be passed in key => value format
     */
    protected function callWebserviceThroughCache($host, $urlFragment, $method,
            $headers, $params) {
        $warnishHost = $this->servers['Warnish'];
        logger(\Fuel\Core\Fuel::L_DEBUG, "*** Going Through Warnish ***",
                __METHOD__);
        $hostFragments = explode('/', $host);
        $headers[self::HOST_HEADER_KEY] = $hostFragments[2];
        $host = $warnishHost;
        $url = $host . $urlFragment;
        return $this->callWebservice($url, $method, $headers, $params);
    }

    /**
     * 
     * @param type $url URL to be called
     * @param type $method GET, POST etc
     * @param type $headers array of headers in key => value format
     * @param type $params array of params to be passed in key => value format
     */
    protected function callWebservice($url, $method, $headers, $params,
            $isThroughCache = true) {

        $isTimed = Fuel\Core\Config::get('timermode');
        if ($isTimed) {
            $startRequest = microtime(true);
        }
        $arh = apache_request_headers();
        $hashResponse = false;
        if (!array_key_exists('ZAP2IT-GET-FRESH-CONTENTS', $arh)) {
            $hashResponse = $this->checkInRequestHash($url, $method, $headers,
                    $params);
        } else {
            logger(\Fuel\Core\Fuel::L_DEBUG,
                    "ZAP2IT-GET-FRESH-CONTENTS detected in the http header!",
                    __METHOD__);
            $isThroughCache = true;
        }

        \Profiler::mark(__METHOD__ . ': REQUEST: Start of ' . $url);
        if ($hashResponse) {
            logger(\Fuel\Core\Fuel::L_DEBUG, "RETURNING FROM REQUEST HASH",
                    __METHOD__);
            \Profiler::mark(__METHOD__ . ': REQUEST: End of ' . $url);
            return $hashResponse;
        }
        $urlOld = $url;
        if ($isThroughCache) {
            $urlFragments = explode('/', $url);
            $host = $urlFragments[2];
            $warnishHost = $this->servers['Warnish'];
            logger(\Fuel\Core\Fuel::L_DEBUG,
                    "***** Going Through Warnish *** $host", __METHOD__);
            $headers[self::HOST_HEADER_KEY] = $host;
            $url = str_replace($host, $warnishHost, $url);
        }
        $curl = \Fuel\Core\Request::forge($url, 'curl');
        logger(\Fuel\Core\Fuel::L_INFO, "Params: " . json_encode($params),
                __METHOD__);
        $curl->set_method($method);
        /* $curl->set_options(array(
          'PROXY' => 'localhost',
          'PROXYPORT' => '8887'
          )); */
        foreach ($headers as $key => $value) {
            $curl->set_header($key, $value);
        }
        if (array_key_exists('ZAP2IT-GET-FRESH-CONTENTS', $arh)) {
            $curl->set_header('ZAP2IT-GET-FRESH-CONTENTS', true);
        }

        $curl->set_params($params);
        try {
            $response = $curl->execute()->response();
        } catch (\Fuel\Core\RequestStatusException $e) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    '4XX ' . self::getPrettyUrl($url, $params) . "   " . $e->getMessage(),
                    __METHOD__);

            return new \Zap2it\Response('400');
        } catch (\Fuel\Core\RequestException $e) {
            logger(\Fuel\Core\Fuel::L_ERROR,
                    '500 ' . self::getPrettyUrl($url, $params) . "   " . $e->getMessage(),
                    __METHOD__);
            try {
                if (\Fuel\Core\Config::get('log_to_cw', false)) {
                    $cwClient = GenUtility::getCloudWatchClient();
                    $cwClient->putMetricData(array(
                        'Namespace' => 'Zap2it/Frontend',
                        'MetricData' => array(
                            array(
                                'MetricName' => '500 Server Error',
                                'Timestamp' => time(),
                                'Value' => 1,
                                'Unit' => 'Count',
                                'Dimensions' => array(array('Name' => 'Env', 'Value' => \Fuel\Core\Fuel::$env)),
                            ),
                        ),
                    ));
                }
            } catch (Exception $e) {
                logger(\Fuel\Core\Fuel::L_ERROR, print_r($e->getMessage(), true));
            }

            return new \Zap2it\Response('500');
        }

        $retResponse = new \Zap2it\Response($response->status,
                $response->headers, $response->body);
        $this->storeInRequestHash($urlOld, $method, $headers, $params,
                $retResponse);
        \Profiler::mark(__METHOD__ . ': REQUEST: End of ' . $url);
        if ($isTimed) {
            $endRequest = microtime(true);
            $time = round(($endRequest - $startRequest) * 1000, 0);
            $GLOBALS['requestTimes'][self::getPrettyUrl($urlOld, $params)] = $time;
        }

        return $retResponse;
    }

    public function callWebservices($requests, $isThroughCache = true) {
        //$isThroughCache = false;
        $arh = apache_request_headers();
        $isTimed = Fuel\Core\Config::get("timermode");
        if ($isTimed) {
            $startRequest = microtime(true);
        }
        $curl = \Fuel\Core\Request::forge('', 'multicurl');
        $responses = array();
        $hashes = array();
        if ($isTimed && count($requests) > 0) {
            $timerKey = 'Multi|' . count($requests) . "|" . self::getPrettyUrl($requests[0]['url'],
                            $requests[0]['params']);
        }
        foreach ($requests as $request) {
            // Handle errors with multi call
            $url = $request['url'];
            $method = $request['method'];
            $headers = $request['headers'];
            $params = $request['params'];
            $key = $request['key'];

            switch ($method){
                case 'GET':
                case 'POST':
                    break;
                default:
                    $method = self::METHOD_GET;
                    break;
            }

            $hashResponse = false;
            if (!array_key_exists('ZAP2IT-GET-FRESH-CONTENTS', $arh)) {
                $hashResponse = $this->checkInRequestHash($url, $method,
                        $headers, $params);
            } else {
                logger(\Fuel\Core\Fuel::L_DEBUG,
                        "ZAP2IT-GET-FRESH-CONTENTS detected in the http header!",
                        __METHOD__);
                $isThroughCache = true;
            }

            \Profiler::mark(__METHOD__ . ": REQUEST MULTICURL: Start of $key - $url");
            $hashes[$key] = $this->calculateHash($url, $method, $headers,
                    $params);
            if ($hashResponse) {
                logger(\Fuel\Core\Fuel::L_DEBUG, "RETURNING FROM REQUEST HASH",
                        __METHOD__);
                $responses[$key] = $hashResponse;
                continue;
            }
            if ($isThroughCache) {
                $urlFragments = explode('/', $url);
                $host = $urlFragments[2];
                $warnishHost = $this->servers['Warnish'];
                logger(\Fuel\Core\Fuel::L_DEBUG,
                        "***** Going Through Warnish *** $host", __METHOD__);
                $headers[self::HOST_HEADER_KEY] = $host;
                $url = str_replace($host, $warnishHost, $url);
            }

            if (array_key_exists('ZAP2IT-GET-FRESH-CONTENTS', $arh)) {
                $headers['ZAP2IT-GET-FRESH-CONTENTS'] = true;
            }
            $curl->add_call($method, $url, $key, $params, $headers);
        }

        //logger(\Fuel\Core\Fuel::L_DEBUG, 'Calls being made in callWebServices: ' . print_r($curl, 1)) ;
        $response = $curl->execute();
        //logger(\Fuel\Core\Fuel::L_DEBUG, 'Call response in callWebServices: ' . print_r($response, 1));

        foreach ($response as $key => $res) {
            //TODO handle error case
            if (!empty($res['error'])) {
                $responses[$key] = new \Zap2it\Response('500', '', $res['error']);
            } else {

                $responses[$key] = new \Zap2it\Response('200', '',
                        $res['response']);
                $this->storeInRequestHashRaw($hashes[$key], $responses[$key]);
            }
            \Profiler::mark(__METHOD__ . ': REQUEST MULTICURL: End of ' . $key);
        }
        if ($isTimed) {
            $endRequest = microtime(true);
            $time = round(($endRequest - $startRequest) * 1000, 0);
            $GLOBALS['requestTimes'][$timerKey] = $time;
        }
        return $responses;
    }

    protected function storeInRequestHashRaw($hash, $value) {
        $request = \Fuel\Core\Request::active();
        $parentRequest = $request->parent();
        $parentRequest = isset($parentRequest) ? $request->parent() : $request;
        $requests = $this->getValueSafelyArr($parentRequest->named_params,
                "requestsHash", null);
        logger(\Fuel\Core\Fuel::L_DEBUG,
                "REQUEST CACHE: Storing response in request hash $this->tempHash",
                __METHOD__);
        if (isset($requests)) {
            $requests[$hash] = $value;
            $parentRequest->named_params["requestsHash"] = $requests;
            return true;
        }
        $requests = array($hash => $value);
        $parentRequest->named_params["requestsHash"] = $requests;
        return true;
    }

    protected function storeInRequestHash($url, $method, $headers, $params,
            $value) {
        $hash = $this->calculateHash($url, $method, $headers, $params);
        //logger(\Fuel\Core\Fuel::L_ERROR, $this->getPrettyUrl($url, $params). "--" .$hash, __METHOD__);
        return $this->storeInRequestHashRaw($hash, $value);
    }

    protected function checkInRequestHash($url, $method, $headers, $params) {
        $hash = $this->calculateHash($url, $method, $headers, $params);
        //logger(\Fuel\Core\Fuel::L_ERROR, $this->getPrettyUrl($url, $params). '  CHK  ' .$hash, __METHOD__);
        $request = \Fuel\Core\Request::active();
        $parentRequest = $request->parent();
        $parentRequest = isset($parentRequest) ? $request->parent() : $request;
        $requests = $this->getValueSafelyArr($parentRequest->named_params,
                "requestsHash", null);
        if (isset($requests) && isset($requests[$hash])) {
            logger(\Fuel\Core\Fuel::L_DEBUG,
                    "REQUEST CACHE: Found response in request hash for $this->tempHash",
                    __METHOD__);
            return $requests[$hash];
        }
        return false;
    }

    protected function calculateHash($url, $method, $headers, $params) {
        $headersString = '';
        $paramsString = '';
        sort($headers);
        sort($params);
        foreach ($headers as $key => $header) {
            $headersString.=$key . $header;
        }
        foreach ($params as $key => $param) {
            $paramsString.=$key . $param;
        }
        // removing header in hash string
        $hashString = $url . $method . $paramsString;
        $hash = md5($hashString);
        $this->tempHash = $hashString;
        return $hash;
    }

    /**
     * Function to retrieve value from an $object for the given $key.
     * Optionally specify a default value to be returned if $key is not present in the object
     *
     * @param        $object
     * @param        $key
     * @param string $default
     *
     * @return string
     */
    public function getValueSafely($object, $key, $default = '') {
        if (isset($object) && isset($object->{$key})) {
            return $object->{$key};
        }

        return $default;
    }

    protected static function getPrettyUrl($url, $params) {
        return $url . "?" . http_build_query($params);
    }

    /**
     * Function to retrieve value from an $array for the given $key.
     * Optionally specify a default value to be returned if $key is not present in the object
     *
     * @param        $array
     * @param        $keys
     * @param string $default
     * @param string $splitter
     *
     * @return string
     */
    public function getValueSafelyArr($array, $keys, $default = '',
            $splitter = ',') {
        return GenUtility::getValueSafelyArr($array, $keys, $default,
                        $splitter);
    }

}
