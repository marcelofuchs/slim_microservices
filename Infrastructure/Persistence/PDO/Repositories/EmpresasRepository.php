<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\PDO\Repositories;

use Domain\Contracts\Entities\EntityInterface;
use Domain\Contracts\Repositories\EmpresasRepositoryInterface;


class EmpresasRepository extends AbstractRepository implements EmpresasRepositoryInterface
{

    /**
     * @innheritdoc
     *
     */
    protected function getAlias(): string
    {
        return 'Empresa';
    }

    protected function getTableName(): string
    {
        return 'empresa';
    }

    protected function getPrimaryId(): string
    {
        return 'id';
    }

    protected function listFields(): array
    {
        return [
            'id',
            'razao_social',
            'nome_fantasia',
            'cnae',
            'cnpj',
            'ie',
            'im',
            'enquadramento_tributario',
            'endereco',
            'telefone',
            'email',
            'responsavel'
        ];
    }

    public function save(EntityInterface $entity)
    {
        /** @var \Domain\Entities\Book $book */
        $book = $entity;

        $sql = ($book->id)
            ? "UPDATE book SET name = :name, description = :description, author = :author WHERE id = :id"
            : "INSERT INTO book (name, description, author) VALUES (:name, :description, :author)";

        try {
            $pdo = $this->em->getConnection()->prepare($sql);

            $pdo->bindValue(":name", $book->getName());
            $pdo->bindValue(":description", $book->getDescription());
            $pdo->bindValue(":author", $book->getAuthor());
            if ($book->id) {
                $pdo->bindValue(":id", $book->id);
            }

            $pdo->execute();

            if (!$book->id) {
                $book->id = $this->em->getConnection()->lastInsertId();
            }

            return $book;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @inheritdoc
     */
    public function delete($id, $lockMode = null, $lockVersion = null){
        return false;
    }


}