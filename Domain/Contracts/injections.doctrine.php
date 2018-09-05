<?php
// DATABASE DEFAULT PRELOAD
$container['em'] = function ($container) {
    $manager = $container->get(\Domain\Contracts\Persistence\EntityManagerContract::class);
    return $manager::create($container['settings']['mm_crm']);
};

//ENTITY MANAGER
$container[\Domain\Contracts\Persistence\EntityManagerContract::class] = function($container) {
    return new Infrastructure\Persistence\Doctrine\EntityManager();
};

//REPOSITORIES
$container[\Domain\Contracts\Repositories\BooksRepositoryContract::class] = function($container) {
    $em = $container->get('em');
    return $em->getRepository(Domain\Entities\Book::class);
};

//SERVICES
$container[\Domain\Contracts\Services\BooksServiceContract::class] = function($container) {
    $repositoryContract = $container->get(\Domain\Contracts\Repositories\BooksRepositoryContract::class);
    return new Domain\Services\BooksService($repositoryContract);
};

return $container;