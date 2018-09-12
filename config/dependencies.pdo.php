<?php
// DATABASE DEFAULT PRELOAD
$container['em'] = function ($container) {
    $manager = $container->get(\Domain\Contracts\Persistence\EntityManagerInterface::class);
    return $manager::create($container['settings']['mm_crm']);
};

//ENTITY MANAGER
$container[\Domain\Contracts\Persistence\EntityManagerInterface::class] = function($container) {
    return new Infrastructure\Persistence\PDO\EntityManager();
};

//REPOSITORIES
$container[\Domain\Contracts\Repositories\BooksRepositoryInterface::class] = function($container) {
    $em = $container->get('em');
    return new Infrastructure\Persistence\PDO\Repositories\BooksRepository($em);
};

//SERVICES
$container[\Domain\Contracts\Services\BooksServiceInterface::class] = function($container) {
    $repositoryContract = $container->get(\Domain\Contracts\Repositories\BooksRepositoryInterface::class);
    return new Domain\Services\BooksService($repositoryContract);
};

return $container;