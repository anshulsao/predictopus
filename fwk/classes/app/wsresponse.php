<?php
namespace App;

class WSResponse {

    private $body;
    private $headers;
    private $status;
    private $isXml = false;
    private $data;

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    function __construct($status = '', $headers = '', $body = '') {
        $this->status = $status;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function setHeaders($headers) {
        $this->headers = $headers;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setIsXml($isXml) {
        $this->isXml = $isXml;
    }

    public function getBody() {
        return $this->body;
    }

    public function getBodyObjectJSON() {
        //logger(\Fuel\Core\Fuel::L_DEBUG, print_r($this->body, 1));
        if (is_array($this->body)) {
            return $this->body;
        }
        if ($this->isXml) {
            $xml = simplexml_load_string($this->body);
            $this->body = json_encode($xml);
            //logger(\Fuel\Core\Fuel::L_DEBUG, $this->body, __METHOD__);
        }
        return json_decode($this->body, 1);
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getStatus() {
        return $this->status;
    }

}
