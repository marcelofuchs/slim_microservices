<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Domain\Contracts\Repositories\EmpresasRepositoryInterface;

class EmpresasRepository extends AbstractRepository implements EmpresasRepositoryInterface {

    /**
     * @innheritdoc
     */
    protected function getAlias(): string {
        return 'Empresas';
    }
}
