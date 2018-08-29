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
            'cache_dir' => __DIR__ . '/../../../data/cache/doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [__DIR__ . '/../../../Domain/Entities'],
            
            'connection' => [
                'driver' => 'pdo_pgsql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'mydb',
                'user' => 'user',
                'password' => 'secret',
                'charset' => 'utf-8'
            ]
        ]
    ]
];