<?php

namespace Domain\Services;

use Domain\Abstractions\AbstractDomainService;
use Domain\Contracts\Repository\BooksRepositoryContract;
use Domain\Contracts\Service\BooksServiceContract;

class BooksService extends AbstractDomainService implements BooksServiceContract
{
    public function __construct(BooksRepositoryContract $repositoryContract)
    {
        parent::__construct($repositoryContract);
    }

    public function getCategoriesByCompany($companyId,$filter)
    {
        return  $this->repository->getCategoriesByCompany($companyId,$filter);
    }
}