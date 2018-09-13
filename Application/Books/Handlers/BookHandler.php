<?php

declare(strict_types=1);

namespace Application\Books\Handlers;

use Application\Books\Contracts\Commands\BookCreateInterface;
use Domain\Contracts\Services\BooksServiceInterface;
use Infrastructure\Container\ServiceBus\SimpleCommandHandler;

final class BookHandler extends SimpleCommandHandler
{
    /** @var  BooksServiceInterface */
    private $service;

    public function __construct(BooksServiceInterface $repurchaseService)
    {
        $this->service = $repurchaseService;
    }

    public function handleBookCreate(BookCreateInterface $command)
    {
        $this->service->save($command);
    }

    public function handleBookDelete(BookCreateInterface $command)
    {
        $this->service->delete($command);
    }
}