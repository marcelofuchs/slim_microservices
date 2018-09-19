<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Domain\Contracts\Repositories\BooksRepositoryInterface;

class BooksRepository extends AbstractRepository implements BooksRepositoryInterface {

    /**
     * @innheritdoc
     */
    protected function getAlias(): string {
        return 'Book';        
    }
}
