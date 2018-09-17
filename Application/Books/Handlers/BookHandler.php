<?php

declare(strict_types=1);

namespace Application\Books\Handlers;

use Application\Books\Contracts\Commands\BookCreateInterface;
use Application\Books\Contracts\Commands\BookUpdateInterface;
use Application\Books\Contracts\Handlers\BookHandlerInterface;
use Application\Books\Http\Actions\BookUpdate;
use Domain\Contracts\Services\BooksServiceInterface;
use Infrastructure\Container\ServiceBus\SimpleCommandHandler;

/**
 * Class BookHandler
 *
 * @package Application\Books\Handlers
 */
final class BookHandler extends SimpleCommandHandler implements BookHandlerInterface
{
    /** @var  BooksServiceInterface */
    private $service;

    /**
     * BookHandler constructor.
     *
     * @param BooksServiceInterface $service
     */
    public function __construct(BooksServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param BookCreateInterface $command
     */
    public function handleBookCreate(BookCreateInterface $command)
    {
        return $this->service->save($command);
    }

    /**
     * @param BookCreateInterface $command
     */
    public function handleBookUpdate(BookUpdateInterface $command)
    {
        return $this->service->update($command);
    }

    /**
     * @param BookCreateInterface $command
     */
    public function handleBookDelete(BookCreateInterface $command)
    {
        print_r('delete');
        exit;
        return $this->service->delete($command);
    }
}