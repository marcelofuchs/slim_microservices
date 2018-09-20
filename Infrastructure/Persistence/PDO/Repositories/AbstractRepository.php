<?php

namespace Infrastructure\Persistence\PDO\Repositories;

use Domain\Contracts\Repositories\BaseRepositoryInterface;
use Domain\Contracts\Entities\EntityInterface;
use Infrastructure\Persistence\PDO\EntityManager;

/**
 * Class AbstractRepository
 * @package Infrastructure\Persistence\PDO\Repositories
 */
abstract class AbstractRepository implements BaseRepositoryInterface
{

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
    protected $defaultSort = ["id"];

    /**
     * AbstractRepository constructor.
     * @param $em
     */
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
    protected function parseCriteria(array $criteria, $operator = "AND")
    {
        $condition = [];
        foreach ($criteria as $field => $value) {
            if ($field === '_search') {
                $condition[] = "(" . $this->parseCriteria($value, "OR") . ")";
                continue;
            }

            if ($field === '_isNot') {
                foreach ($value as $_searchField => $_searchValue) {
                    $condition[] = "($_searchField != '$_searchValue')";
                }
                continue;
            }

            if ($field === '_between') {
                foreach ($value as $_searchField => $_searchValue) {
                    list($_valueIni, $_valueEnd) = $_searchValue;
                    $condition[] = "($_searchField BETWEEN '$_valueIni' AND '$_valueEnd')";
                }
                continue;
            }

            switch (gettype($value)) {
                case 'string':
                    if (strpos($value, '%') !== false) {
                        $condition[] = "($field LIKE '$value')";
                        break;
                    }

                    $condition[] = "($field = '$value')";
                    break;
            }

            if (!$condition) {
                continue;
            }

        }

        return (!empty($condition)
            ? implode($condition, " " . $operator . " ")
            : "1=1");
    }

    /**
     * Parse Order By
     *
     * @param array $orderby
     * @param QueryBuilder $queryBuilder
     * @return type
     */
    protected function parseOrderBy(array $orderby = null): string
    {
        if (!$orderby) {
            return "";
        }

        $order = [];

        foreach ($orderby as $field => $direction) {
            $order[] = "$field $direction";
        }

        return "ORDER BY " . implode(", ", $order);
    }

    /**
     * Parse Limit
     *
     * @param int $limit
     * @return string
     */
    protected function parseLimit($limit): string
    {
        if (!$limit) {
            return "";
        }

        return "LIMIT $limit";
    }

    /**
     * Parse Offset
     *
     * @param int $offset
     * @return string
     */
    protected function parseOffset($offset): string
    {
        if (!$offset) {
            return "";
        }

        return "OFFSET $offset";
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
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE " . $this->getPrimaryId() . " = :id ";

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
        $sql = "SELECT * FROM " . $this->getTableName();

        $pdo = $this->em->getConnection()->prepare($sql);
        $pdo->execute();

        return $pdo->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $sql = "SELECT ".implode(", ",$this->listFields())." FROM " . $this->getTableName() .
            " WHERE " . $this->parseCriteria($criteria) .
            " " . $this->parseOrderBy($orderBy) .
            " " . $this->parseLimit($limit) .
            " " . $this->parseOffset($offset);
print_r($sql);exit;
        $pdo = $this->em->getConnection()->prepare($sql);
        $pdo->execute();

        return $pdo->fetchAll(\PDO::FETCH_ASSOC);
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
        $sql = "SELECT COUNT(*) total FROM " . $this->getTableName();

        $pdo = $this->em->getConnection()->prepare($sql);
        $pdo->execute();

        return $pdo->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param EntityInterface $entity
     */
    public function save(EntityInterface $entity)
    {
    }

    /**
     * @param $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return bool
     */
    public function delete($id, $lockMode = null, $lockVersion = null)
    {
        $table = $this->getTableName();
        $primaryId = $this->getPrimaryId();

        $sql = "DELETE FROM " . $table . " WHERE " . $primaryId . " = " . $id;

        $pdo = $this->em->getConnection()->prepare($sql);

        $pdo->execute();

        return ($pdo) ? true : false;
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {

    }

    /**
     * @return string
     */
    protected abstract function getTableName(): string;

    /**
     * @return string
     */
    protected abstract function getPrimaryId(): string;

    /**
     * List Fields
     *
     * Incluir um array com todos os campos que serao retornados na listagem de multiplos registros.
     * Ex:
     * return [
     *          'id',
     *          'name as nomeCliente'
     *  ];
     *
     * @return array
     */
    protected abstract function listFields(): array;
}