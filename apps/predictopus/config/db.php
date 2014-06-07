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
            'hostname' => 'localhost',
            'port' => '8889',
            'database' => 'predictopus',
            'username' => 'root',
            'password' => 'root',
            'persistent' => true,
            'compress' => true,
        ),
        'identifier' => '',
        'table_prefix' => '',
        'charset' => 'utf8',
        'enable_cache' => true,
        'profiling' => true,
        'readonly' => false,
    ),
    'lite' => array(
        'type' => 'pdo',
        'connection' => array(
            'dsn' => 'sqlite:'.ROOT.'football.db',
            'username' => '',
            'password' => '',
        ),
        'identifier' => '',
        'table_prefix' => '',
        'charset' => 'utf8',
        'enable_cache' => true,
        'profiling' => true,
        'readonly' => false,
    )
);
