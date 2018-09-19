<?php

namespace Domain\Services;

use Application\Books\Contracts\Commands\BookCreateInterface;
use Domain\Abstractions\AbstractDomainService;
use Domain\Contracts\Services\BooksServiceInterface;
use Domain\Entities\Book;
use Infrastructure\Container\ServiceBus\Command\CommandInterface;
use Slim\Exception\NotFoundException;

/**
 * Class BooksService
 * @package Domain\Services
 */
class BooksService extends AbstractDomainService implements BooksServiceInterface
{
    /**
     * @param CommandInterface $command
     *
     * @return mixed
     */
    public function save(CommandInterface $command)
    {
        /** @var BookCreateInterface $command */
        $command = $command;
        $id = null;

        $book = new Book(
            $id,
            $command->getName(),
            $command->getDescription(),
            $command->getAuthor()
        );

        $this->repository->save($book);
        $command->id = $book->getId();
    }

    /**
     * @param CommandInterface $command
     *
     * @return mixed
     */
    public function update(CommandInterface $command)
    {
        /** @var BookCreateInterface $command */
        $command = $command;

        $book = $this->repository->find($command->id);

        if(!$book){
            throw new \Exception("Book not found.", 404);
        }

        $book = new Book(
            $command->id,
            $command->getName(),
            $command->getDescription(),
            $command->getAuthor()
        );

        $this->repository->save($book);
    }
}