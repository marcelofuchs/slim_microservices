<?php

namespace Domain\Services;

use Application\Books\Contracts\Commands\BookCreateInterface;
use Domain\Abstractions\AbstractDomainService;
use Domain\Contracts\Services\BooksServiceInterface;
use Domain\Entities\Book;
use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Class BooksService
 * @package Domain\Services
 */
class BooksService extends AbstractDomainService implements BooksServiceInterface
{
    /**
     * @param CommandInterface $bookCommand
     *
     * @return mixed
     */
    public function save(CommandInterface $bookCommand)
    {
        /** @var BookCreateInterface $command */
        $command = $bookCommand;
        $id = null;

        $book = new Book(
            $id,
            $command->getName(),
            $command->getDescription(),
            $command->getAuthor()
        );

        $this->repository->save($book);
        $bookCommand->id = $book->getId();
    }
}