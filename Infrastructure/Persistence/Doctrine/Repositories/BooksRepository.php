<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Domain\Contracts\Repositories\BooksRepositoryInterface;
use Domain\Contracts\Repositories\EntityInterface;

class BooksRepository extends AbstractRepository implements BooksRepositoryInterface {

    /**
     * @innheritdoc
     */
    protected function getAlias(): string {
        return 'Book';        
    }
}
