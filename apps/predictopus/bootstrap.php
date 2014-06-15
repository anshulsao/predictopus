<?php

// Load in the Autoloader
require COREPATH . 'classes' . DIRECTORY_SEPARATOR . 'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH . 'bootstrap.php';

/**
 * ROOT path
 */
define('ROOT', realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR);
ini_set('memory_limit', '2G');

Autoloader::add_classes(array(
    // Add classes you want to override here
    // Example: 'View' => APPPATH.'classes/view.php',
    'Controller_Main' => ROOT . 'fwk/classes/controller/main.php',
    'Controller_Base' => ROOT . 'fwk/classes/controller/base.php',
    'Controller_ModuleBase' => ROOT . 'fwk/classes/controller/modulebase.php',
    'Model_Base' => ROOT . 'fwk/classes/model/base.php',
    'AdsUtil' => ROOT . 'fwk/classes/ads.php',
    'ModuleTDV' => ROOT . 'fwk/classes/module.php',
    'GenUtility' => ROOT . 'fwk/classes/genutil.php',
    'PageController' => ROOT . 'fwk/classes/page/pagecontroller.php',
    'Casset\\Casset_Exception' => COREPATH . 'packages/casset/classes/casset.php',
    'PageTracking' => ROOT . 'fwk/classes/pagetracking.php',
    'DeviceWrapper' => ROOT . 'fwk/classes/devicewrapper.php',
    'OmnitureMeasurement' => ROOT . 'fwk/classes/appmeasurement.php',
    'Auth\\Auth_CustomOpauth' => APPPATH. 'classes/auth/customopauth.php'
));

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
Fuel::init('config.php');
