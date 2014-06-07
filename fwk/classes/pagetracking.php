<?php
use \Zap2it\Constants;

class PageTracking {

    protected $siteName;
    protected $pageName;
    protected $pageTitle;
    protected $pageType;
    protected $pType;
    protected $siteServer;
    protected $pageCategory;
    protected $author;
    protected $provider;
    protected $uid;
    protected $loggedin;
    protected $showType;
    protected $current;
    protected $relatedShows;
    protected $city;
    protected $zip;
    protected $channel;
    protected $currentUrl;
    protected $device;
    protected $visitorNamespace;
    protected $trackingServer;
    protected $secureTrackingServer;
    protected $visitorMigrationKey;
    protected $authorChartbeat;


    function __construct() {
        $this->account = Constants::OMNITURE_ACCOUNT;
        $this->siteName = Constants::SITE_NAME;
        $this->pageName = '';
        $this->pageType = '';
        $this->pType = '';
        $this->siteServer = Constants::SITE_SERVER;
        $this->pageCategory = '';
        $this->author='';
        $this->provider='';
        $this->uid='';
        $this->loggedin=  GenUtility::isLoggedIn() ? 'yes' : 'no';
        $this->showSpecificStream='';
        $this->showType='';
        $this->current='';
        $this->relatedShows='';
        $this->city='';
        $this->zip='';
        $this->channel=Constants::CHANNEL;
        $this->currentUrl = \Fuel\Core\Uri::main();
        $this->visitorNamespace = Constants::VISITOR_NAMESPACE;
        $this->trackingServer = Constants::TRACKING_SERVER;
        $this->trackingServerSecure = '';//Constants::SECURE_TRACKING_SERVER;
        $this->authorChartbeat='';
        $this->eventsToTrack='event1,event2,event3'; /* recording three events for omniture : event1 will get populated on content stream fetch */
    }


    /**
     * @param $params object with values set for the tracking values
     */
    public function setTrackingParams($params){
        foreach ($params as $key => $value){
            $this->$key = $value;
        }
    }
    public function getTrackingParams($asJson){
        $object =  array_filter($this->getTrackingObject());
        return $asJson ? str_replace('\/','/',json_encode($object)) : $object;

        //return json_encode($object);
    }
    private function getTrackingObject(){
        $var = get_object_vars($this);
        foreach($var as &$value){
            if(is_object($value) && method_exists($value,'getTrackingObject')){
                $value = $value->getTrackingObject();
            }
        }
        return $var;
    }

} 