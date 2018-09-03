<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Domain\Contracts\Repositories\BooksRepositoryContract;

class BooksRepository extends AbstractRepository implements BooksRepositoryContract {

    /**
     * @innheritdoc
     */
    protected function getAlias(): string {
        return 'Book';        
    }    
}
