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
        $this->request = Fuel\Core\Request::main();       
        $this->setPageTitle($pageTitle);       
        $this->populateFields();

    }

    public function getHtmlAttribs() {
        return $this->htmlAttribs;
    }


    protected function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;
    }

    public function getPageTitle() {
        return $this->pageTitle;
    }

    

    public abstract function populateFields();

   
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


}
