<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class PageController {

    protected $title;
    protected $description;
    // used for putting link ref for contentstream SEO
    protected $page;
    protected $image;

    /* Facebook meta-data as documented here: http://ogp.me/#string */

    /* Twitter cards as documented here: https://dev.twitter.com/docs/cards */

    /* site catalyst tracking */
    protected $request;
    protected $pageTitle;
    protected $htmlAttribs = '';

    public function __construct($pageTitle = null) {
        $this->pageTracking = new PageTracking();
        $this->servers = \Fuel\Core\Config::get('servers');
        $this->request = Fuel\Core\Request::main();
        $this->makeParallelCalls();
        $this->setPageTitle($pageTitle);
        $this->addGenericTracking();
        $this->populateFields();
        $this->addPageTracking();

        /*
          $this->omnitureTracking->account = \Zap2it\Constants::OMNITURE_REPORT_SUITE_ID;
          $this->omnitureTracking->dc = \Zap2it\Constants::OMNITURE_DATA_COLLECTION_SERVERS;
          $this->omnitureTracking->trackingServer = \Zap2it\Constants::OMNITURE_TRACKING_SERVERS;
          $this->omnitureTracking->trackingServerSecure = \Zap2it\Constants::OMNITURE_TRACKING_SECURE_SERVERS;
         */
    }

    public function getHtmlAttribs() {
        return $this->htmlAttribs;
    }

    public abstract function addPageTracking();

    protected function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;
    }

    public function getPageTitle() {
        return $this->pageTitle;
    }

    private function addGenericTracking() {
        $usr = 'u';
        $gender = '';
        $age = '';
        $request = Fuel\Core\Request::main();
        if (GenUtility::isLoggedIn()) {
            $usr = 'r';
            $gender = \Auth\Auth::get(Zap2it\Constants::USER_KEY_GENDER);
            $gender = $gender == 'Male' ? 'm' : 'f';
        }
        AdsUtil::adTargeting($request, 'usr', $usr);
        if (!empty($gender)) {
            AdsUtil::adTargeting($request, 'gdr', $gender);
        }
    }

    public abstract function populateFields();

    public abstract function setTrackingParams($data);
    /*
     * Framework Error Handling Doc: http://fuelphp.com/docs/general/error.html
     */

    public function getTrackingParams($asJson = false) {
        return $this->pageTracking->getTrackingParams($asJson);
    }

    public function handleError($response) {
        switch ($response->getStatus()) {
            case 200:
                // Not checking for empty content, as this should be handled at the individaual page controller level
                return $response->getBodyObjectJSON();

            case 404:
                throw new \Fuel\Core\HttpNotFoundException;

            case 400:
                throw new \Fuel\Core\HttpNotFoundException;

            default :
                return array();
        }
    }

    public function getTitle() {
        return Fuel\Core\Security::strip_tags($this->title);
    }

    public function getDescription() {
        return Fuel\Core\Security::strip_tags(preg_replace('/"/', "'",
                                $this->description));
    }

    public function getImage() {
        return $this->image;
    }

    public function getPage() {
        return $this->page;
    }

    public function getSocialHeader() {
        $social = '<meta name="twitter:site" content="@zap2it">';
        $title = $this->getTitle();
        if (!empty($title)) {
            $social .= "<meta property='og:title' content='$title'>";
            $social .= "<meta property='twitter:title' content='$title'>";
        }

        $description = $this->getDescription();
        if (!empty($description)) {
            $social .= "<meta property='og:description' content='$description'>";
        }

        $image = $this->getImage();
        if (!empty($image)) {
            $social .= "<meta property='og:image' content='$image'/>";
        }
        $page = $this->getPage();
        if (is_int($page)) {
            $social .= "<link rel='next' href='/?page=" . ($page + 1) . "'>";
            if ($page > 0) {
                $social .= "<link rel='prev' href='/?page=" . ($page - 1) . "'>";
            }
        }
        
        $cannonical = \Fuel\Core\Uri::segments();
        logger(400, print_r($cannonical, 1 ), __METHOD__);
        return $social;
    }

    public function makeParallelCalls() {
        
    }

}
