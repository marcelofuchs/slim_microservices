<?php

$container = [
    //REPOSITORIES
    \Domain\Contracts\Repository\BooksRepositoryContract::class => function($container) {
        $em = $this->get('em');
        return new Infrastructure\Persistence\Doctrine\Repositories\BooksRepository($em, Domain\Entities\Book::class);
    },
            
    //SERVICES
    \Domain\Contracts\Service\BooksServiceContract::class => function($container) {
        $repositoryContract = $container->get(\Domain\Contracts\Repository\BooksRepositoryContract::class);
        return new Domain\Services\BooksService($repositoryContract);       
    }
];

return $container;