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

        $config = new \Doctrine\ORM\Configuration();
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyDir($settings['cache_dir']);
        $config->setProxyNamespace('Domain\Entities');
        $config->setMetadataDriverImpl(
            new \Doctrine\ORM\Mapping\Driver\YamlDriver(
                 $settings['metadata_dirs']
            )
        );

        $config->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy);
        $config->setQueryCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
        $config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);

        $entityManager = \Doctrine\ORM\EntityManager::create($settings['connection'], $config);

        return $entityManager;
        
        return $manager;
    }

}
