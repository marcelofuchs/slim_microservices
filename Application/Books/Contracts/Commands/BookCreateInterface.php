<?php

namespace Application\Books\Contracts\Commands;

use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Interface BookCreateInterface
 *
 * @package Application\Books\Contracts\Commands
 */
interface BookCreateInterface extends CommandInterface
{
    /**
     * BookCreateInterface constructor.
     *
     * @param string $name
     * @param string $description
     * @param string $author
     */
    public function __construct(string $name, string $description, string $author);
}