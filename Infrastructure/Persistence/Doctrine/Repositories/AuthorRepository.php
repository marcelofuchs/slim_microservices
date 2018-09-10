<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Domain\Contracts\Repositories\AuthorRepositoryInterface;

class AuthorRepository extends AbstractRepository implements AuthorRepositoryInterface {

    /**
     * @innheritdoc
     */
    protected function getAlias(): string {
        return 'Author';
    }    
}
