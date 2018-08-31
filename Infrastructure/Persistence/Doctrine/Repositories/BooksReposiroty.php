<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Domain\Contracts\Repository\BooksRepositoryContract;
use Domain\Entities\Book;
use Infrastructure\Persistence\Doctrine\Repositories\AbstractRepository;
use Doctrine\ORM\EntityManager;

class BooksRepository extends AbstractRepository implements BooksRepositoryContract {

    public function __construct(EntityManager $em, Book $entity) {
        parent::__construct($em, $entity);
    }
}
