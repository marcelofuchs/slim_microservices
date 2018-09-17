<?php
require_once 'dependencies.pdo.php';
//require_once 'dependencies.redbean.php';

// DATABASE DEFAULT PRELOAD
$container['em'] = function ($container) {
    $manager = $container->get(\Domain\Contracts\Persistence\EntityManagerInterface::class);
    return $manager::create($container['settings']['mm_crm']);
};

//SERVICES
$container[\Domain\Contracts\Services\BooksServiceInterface::class] = function($container) {
    $repositoryContract = $container->get(\Domain\Contracts\Repositories\BooksRepositoryInterface::class);
    return new Domain\Services\BooksService($repositoryContract);
};

$container[\Infrastructure\Container\ServiceBus\CommandBusInterface::class] = function($container){
    $factory = new \Infrastructure\Container\Command\CommandBusFactory($container);
    return $factory();
};

return $container;
