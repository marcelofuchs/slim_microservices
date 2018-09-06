<?php

namespace Domain\Services;

use Domain\Abstractions\AbstractDomainService;
use Domain\Contracts\Services\BooksServiceInterface;

class BooksService extends AbstractDomainService implements BooksServiceInterface
{
    public function __construct($repositoryContract)
    {
        parent::__construct($repositoryContract);
    }   
}