<?php

//ENTITY MANAGER
$container[\Domain\Contracts\Persistence\EntityManagerInterface::class] = function($container) {
    return new Infrastructure\Persistence\Doctrine\EntityManager();
};

//REPOSITORIES
$container[\Domain\Contracts\Repositories\BooksRepositoryInterface::class] = function($container) {
    $em = $container->get('em');
    return $em->getRepository(Domain\Entities\Book::class);
};

return $container;
