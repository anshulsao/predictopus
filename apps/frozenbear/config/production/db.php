<?php

/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */
return array(
    'active' => 'local',
    'local' => array(
        'type' => 'mysqli',
        'connection' => array(
            'hostname' => 'freezingbearbackend.czqczfkbvqd0.us-west-2.rds.amazonaws.com',
            'port' => '3306',
            'database' => 'freezingbearbackend',
            'username' => 'root',
            'password' => 'freezingbear',
            'persistent' => true,
            'compress' => true,
        ),
        'identifier' => '',
        'table_prefix' => '',
        'charset' => 'utf8',
        'enable_cache' => true,
        'profiling' => true,
        'readonly' => false,
    )
);
