<?php

namespace Domain\Entities;

/**
 * Book Entity
 * */
class Book {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $author;

    /**
     * @var string
     */
    public $description;

    /**
     * @return int id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string author
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @return Book
     */
    public function setName($name) {

        if (!$name && !is_string($name)) {
            throw new \InvalidArgumentException("Book name is required", 400);
        }

        $this->name = $name;
        return $this;
    }

    /**
     * @return Book
     */
    public function setAuthor($author) {

        if (!$author && !is_string($author)) {
            throw new \InvalidArgumentException("Author is required", 400);
        }

        $this->author = $author;
        return $this;
    }

    /**
     * @return Book
     */
    public function getValues() {
        return get_object_vars($this);
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
}
