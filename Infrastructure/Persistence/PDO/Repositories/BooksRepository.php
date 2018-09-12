<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\PDO\Repositories;

use Domain\Contracts\Entities\EntityInterface;
use Domain\Contracts\Repositories\BooksRepositoryInterface;


class BooksRepository extends AbstractRepository implements BooksRepositoryInterface {

    /**
     * @innheritdoc
     *
     */
    protected function getAlias(): string {
        return 'Book';
    }

    protected function getTableName(): string {
        return 'book';
    }

    protected function getPrimaryId(): string {
        return 'id';
    }

    public function save(EntityInterface $entity)
    {
        try {
            /** @var \Domain\Entities\Book $book */
            $book = $entity;
            $sql = "INSERT INTO book (name, description, author) VALUES (:name, :description, :author)";

            $pdo = $this->em->getConnection()->prepare($sql);

            $pdo->bindValue(":name", $book->getName());
            $pdo->bindValue(":description", $book->getDescription());
            $pdo->bindValue(":author", $book->getAuthor());

            $pdo->execute();

            $book->id = $this->em->getConnection()->lastInsertId();

            return $book;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}