<?php

namespace Domain\Contracts\Persistence;

/**
 * Entity Manager
 * 
 * @author marcelo
 */
interface EntityManagerContract {

    /**
     * Create unique entity manager (Doctrine/Eloquent)
     * 
     * Sample:
     *
     * ''' 
     * 
     * $settings = [
     *       // if true, metadata caching is forcefully disabled
     *       'dev_mode' => true,
     *
     *       // path where the compiled metadata info will be cached
     *       // make sure the path exists and it is writable
     *       'cache_dir' => __DIR__ . '/var/doctrine',
     *
     *       // you should add any other path containing annotated entity classes
     *       'metadata_dirs' => [__DIR__ . '/src/Domain'],
     *       
     *       'connection' => [
     *           'driver' => 'pdo_mysql',
     *           'host' => getenv('DATABASE_HOST'),
     *           'port' => getenv('DATABASE_PORT'),
     *           'user' => getenv('DATABASE_USER'),
     *           'password' => getenv('DATABASE_PASSWORD'),
     *           'dbname' => getenv('DATABASE_NAME'),
     *           'charset' => 'utf-8'
     *       ]
     * ]
     * 
     * '''
     * 
     * @param array $settings
     */
    public static function create($settings = []);
}
