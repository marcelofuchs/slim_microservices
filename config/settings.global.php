<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,
        'mm_crm' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,
            
            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => __DIR__ . '/../' . getenv('DOCTRINE_CACHE_DIR'),
            
            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [
                __DIR__ . '/../' . getenv('DOCTRINE_METADATA_DIR'),
            ],
            
            'connection' => [
                'driver' => 'pgsql',//redbean
                //'driver' => getenv('DATABASE_DRIVER'),//doctrine
                'host' => getenv('DATABASE_HOST'),
                'port' => getenv('DATABASE_PORT'),
                'user' => getenv('DATABASE_USER'),
                'password' => getenv('DATABASE_PASSWORD'),
                'dbname' => getenv('DATABASE_NAME'),
                'charset' => 'utf8',
                'driverOptions' => [
                    1002 => "SET NAMES 'UTF8'"
                ],
            ]
        ]
    ]
];
