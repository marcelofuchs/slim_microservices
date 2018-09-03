<?php

namespace Domain\Services;

use Domain\Abstractions\AbstractDomainService;
use Domain\Contracts\Services\BooksServiceContract;

class BooksService extends AbstractDomainService implements BooksServiceContract
{
    public function __construct($repositoryContract)
    {
        parent::__construct($repositoryContract);
    }   
}