<?php
//ENTITY MANAGER
$container[\Domain\Contracts\Persistence\EntityManagerContract::class] = function($container) {
    return new Infrastructure\Persistence\Doctrine\EntityManager();
};

//REPOSITORIES
$container[\Domain\Contracts\Repository\BooksRepositoryContract::class] = function($container) {
    $em = $container->get('em');
    return new Infrastructure\Persistence\Doctrine\Repositories\BooksRepository($em, Domain\Entities\Book::class);
};

//SERVICES
$container[\Domain\Contracts\Service\BooksServiceContract::class] = function($container) {
    $repositoryContract = $container->get(\Domain\Contracts\Repository\BooksRepositoryContract::class);
    return new Domain\Services\BooksService($repositoryContract);
};

return $container;
