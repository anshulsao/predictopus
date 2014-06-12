<?php

/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */
return array(
    'cdn' => '//static.playpredictopus.com',
    'cdnversion' => 'prod-000002',
    'profiling' => false,
    'disqus_params' => array(
        'forum' => 'predictopus',
        'public_key' => 'u6xptgT0nNYJUjBoOzTu9izeSBgmGQY3duHTbQ2YTFg1yYpIzM0dHnhRVuGDKd6k',
        'private_key' => 'qb5Gm3fWb313q2YOiZ3zNzBZOh7R0diwtEULPFqQE0ZDcPYipU8AH3Ro6aR0uLj7'
    ),
    'log_threshold' => Fuel::L_ERROR,
    'security' => array(
        // 'csrf_autoload'    => false,
        // 'csrf_token_key'   => 'fuel_csrf_token',
        // 'csrf_expiration'  => 0,        
        'uri_filter' => array('htmlentities'),
        // 'input_filter'  => array(),
        'output_filter' => array('Security::htmlentities'),
        'whitelisted_classes' => array(
            'Fuel\\Core\\Response',
            'Fuel\\Core\\View',
            'Fuel\\Core\\ViewModel',
            'Closure',
        ),
    ),
    'module_paths' => array(
        APPPATH . 'modules' . DS
    ),
    'z2t-show-errors' => false,
);
