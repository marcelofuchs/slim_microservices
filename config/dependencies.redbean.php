<?php

//ENTITY MANAGER
$container[\Domain\Contracts\Persistence\EntityManagerInterface::class] = function($container) {
    return new Infrastructure\Persistence\Redbean\EntityManager();
};

//REPOSITORIES
$container[\Domain\Contracts\Repositories\BooksRepositoryInterface::class] = function($container) {
    $em = $container->get('em');
    return new Infrastructure\Persistence\Redbean\Repositories\BooksRepository();
};

return $container;
