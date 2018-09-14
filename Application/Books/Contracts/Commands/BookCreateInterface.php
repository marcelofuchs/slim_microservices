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


    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param mixed $name
     * @return BookCreate
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @param mixed $description
     * @return BookCreate
     */
    public function setDescription($description);

    /**
     * @return mixed
     */
    public function getAuthor();

    /**
     * @param mixed $author
     * @return BookCreate
     */
    public function setAuthor($author);
}