<?php

namespace Infrastructure\Persistence\PDO\Repositories;

use Domain\Contracts\Repositories\BaseRepositoryInterface;
use Domain\Contracts\Entities\EntityInterface;
use Infrastructure\Persistence\PDO\EntityManager;

abstract class AbstractRepository implements BaseRepositoryInterface {

    /** @var string */
    protected $alias;

    /** @var EntityManager */
    protected $em;

    /** @var QueryBuilder */
    protected $lastQuery;

    /**
     * Utilize para setar os where
     * padrões para todas as consultas
     *
     * @var array
     */
    protected $defaultCriteria = [];

    /**
     * Ordenação padrão de consultas.
     *
     * @var array
     */
    protected $defaultSort = [];

    public function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * Query Builder
     *
     * @return QueryBuilder
     */
    protected function queryBuilder(): QueryBuilder
    {
    }

    /**
     * Retorna a contagem total da última consulta realizada, se for
     * utlizado o método $this->queryBuilder() para a construção da consulta
     * personalizada.
     *
     * @return int|null
     */
    public function countLastQuery()
    {
    }

    /**
     * Parse Criteria
     *
     * @param array $criteria
     * @param QueryBuilder $queryBuilder
     */
    protected function parseCriteria(array $criteria, QueryBuilder $queryBuilder)
    {
    }

    /**
     * Parse Order By
     *
     * @param array $orderby
     * @param QueryBuilder $queryBuilder
     * @return type
     */
    protected function parseOrderBy(array $orderby = null, QueryBuilder $queryBuilder)
    {
    }

    /**
     * Retorna o campo com o alias da entidade caso não houver
     *
     * @param $field
     * @return string
     */
    protected function getFieldWithAlias($field)
    {
    }

    /**
     * @inheritdoc
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
    }

    /**
     * @inheritdoc
     */
    public function find(int $id, $lockMode = null, $lockVersion = null)
    {
        $sql = "SELECT * FROM ".$this->getTableName()." WHERE ".$this->getPrimaryId()." = :id ";

        $pdo = $this->em->getConnection()->prepare($sql);
        $pdo->bindParam(':id', $id);
        $pdo->execute();

        return $pdo->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @inheritdoc
     */
    public function findAll()
    {
        $sql = "SELECT * FROM ".$this->getTableName();

        $pdo = $this->em->getConnection()->prepare($sql);
        $pdo->execute();

        return $pdo->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
    }

    /**
     * @inheritdoc
     */
    abstract protected function getAlias();

    /**
     * @inheritdoc
     */
    public function transactional(\Closure $handler)
    {
    }

    /**
     * @inheritdoc
     */
    public function getList(array $criteria, array $sort = [], int $limit = 10, int $offset = 0): array
    {
    }

    /**
     * @inheritdoc
     */
    public function count(array $criteria): int
    {
    }

    public function save(EntityInterface $entity)
    {
    }

    public function delete($id, $lockMode = null, $lockVersion = null)
    {
        $sql = "DELETE FROM ".$this->getTableName()." WHERE ".$this->getPrimaryId()." = ".$id;

        $pdo = $this->em->getConnection()->prepare($sql);
        $pdo->execute();

        return ($pdo)? true : false;
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
    }

    protected abstract function getTableName():string;


    protected abstract function getPrimaryId():string;
}
