<?php

namespace Application\Books\Commands;

use Application\Books\Contracts\Commands\BookCreateInterface;

/**
 * Class BookCreate
 *
 * @package Application\Books\Commands
 */
class BookCreate implements BookCreateInterface
{
    /**
     * @var string
     */
    public $id = null;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $author;

    /**
     * @inheritdoc
     */
    public function __construct(string $name, string $description, string $author)
    {
        $this->name = $name;
        $this->description = $description;
        $this->author = $author;
    }

    /**
     * @inheritdoc
     */
    public static function fromArray(array $data)
    {
        return new self(
            $data['name'],
            $data['description'],
            $data['author']
        );
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author
        ];
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @inheritdoc
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }
}