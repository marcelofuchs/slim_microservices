<?php

namespace Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager as DoctrineManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;

/**
 * Description of EntityManager
 *
 * @author marcelo
 */
class EntityManager implements \Domain\Contracts\Persistence\EntityManagerContract {

    /**
     * @inheritdoc
     */
    public static function create($settings = []) {       
        
        $config = Setup::createYAMLMetadataConfiguration(
            $settings['metadata_dirs'], $settings['dev_mode']
        );
        
//        $config->setMetadataDriverImpl(
//            new AnnotationDriver(
//                new AnnotationReader, $settings['metadata_dirs']
//            )
//        );
        $config->setMetadataDriverImpl(
            new \Doctrine\ORM\Mapping\Driver\YamlDriver(
                 $settings['metadata_dirs']
            )
        );

        $config->setMetadataCacheImpl(
            new FilesystemCache(
                $settings['cache_dir']
            )
        );

        $config->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy);
        $config->setQueryCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
        $config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
        
        return DoctrineManager::create(
            $settings['connection'], $config
        );
    }

}
