<?php

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Domain\Contracts\Repositories\BaseRepositoryInterface;
use Domain\Contracts\Entities\EntityInterface;

abstract class AbstractRepository extends EntityRepository implements BaseRepositoryInterface {

    /** @var string */
    protected $alias;

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

    /**
     * Query Builder
     * 
     * @return QueryBuilder
     */
    protected function queryBuilder(): QueryBuilder {
        $this->lastQuery = $this->_em->createQueryBuilder()
                ->select($this->getAlias())
                ->from($this->_entityName, $this->getAlias());
        
        $this->parseCriteria($this->defaultCriteria, $this->lastQuery);
        $this->parseOrderBy($this->defaultSort, $this->lastQuery);

        return $this->lastQuery;
    }

    /**
     * Retorna a contagem total da última consulta realizada, se for
     * utlizado o método $this->queryBuilder() para a construção da consulta
     * personalizada.
     *
     * @return int|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countLastQuery() {
        if (!$this->lastQuery ||
                !($this->lastQuery instanceof QueryBuilder)
        ) {
            return null;
        }

        return (int) $this->lastQuery
                        ->select(sprintf('COUNT(%s) total', $this->getAlias()))
                        ->resetDQLPart('groupBy')
                        ->resetDQLPart('orderBy')
                        ->setFirstResult(null)
                        ->setMaxResults(null)
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    /**
     * Parse Criteria
     * 
     * @param array $criteria
     * @param QueryBuilder $queryBuilder
     */
    protected function parseCriteria(array $criteria, QueryBuilder $queryBuilder) {
        foreach ($criteria as $field => $value) {
            $condition = null;
            $fieldName = $this->getFieldWithAlias($field);

            if ($field === '_search') {
                $likes = [];
                foreach ($value as $_searchField => $_searchValue) {
                    $_searchField = $this->getFieldWithAlias($_searchField);
                    $condition = $queryBuilder->expr()->like(
                            $_searchField, $queryBuilder->expr()->literal($_searchValue)
                    );
                    array_push($likes, (string) $condition);
                }
                $queryBuilder->andWhere(implode(' OR ', $likes));
                continue;
            }

            if ($field === '_isNot') {
                foreach ($value as $_searchField => $_searchValue) {
                    $_searchField = $this->getFieldWithAlias($_searchField);
                    $condition = $queryBuilder->expr()->neq(
                            $_searchField, $queryBuilder->expr()->literal($_searchValue)
                    );
                    $queryBuilder->andWhere($condition);
                }
                continue;
            }

            if ($field === '_between') {
                foreach ($value as $_searchField => $_searchValue) {
                    $_searchField = $this->getFieldWithAlias($_searchField);
                    list($_valueIni, $_valueEnd) = $_searchValue;
                    $condition = $queryBuilder->expr()->between(
                            sprintf('DATE(%s)', $_searchField), (string) $queryBuilder->expr()->literal($_valueIni), (string) $queryBuilder->expr()->literal($_valueEnd)
                    );
                    $queryBuilder->andWhere($condition);
                }
                continue;
            }

            switch (gettype($value)) {
                case 'array':
                    $condition = $queryBuilder->expr()->in(
                            $fieldName, $value
                    );
                    break;
                case 'NULL':
                    $condition = $queryBuilder->expr()->isNull($fieldName);
                    break;
                case 'string':
                    if (strpos($value, '%') !== false) {
                        $condition = $queryBuilder->expr()->like($fieldName, $value);
                        break;
                    }

                    $condition = $queryBuilder->expr()->eq(
                            $fieldName, $queryBuilder->expr()->literal($value)
                    );
                    break;
                default:
                    $condition = $queryBuilder->expr()->eq($fieldName, $value);
                    break;
            }

            if (!$condition) {
                continue;
            }

            $queryBuilder->andWhere($condition);
        }
    }

    /**
     * Parse Order By
     * 
     * @param array $orderby
     * @param QueryBuilder $queryBuilder
     * @return type
     */
    protected function parseOrderBy(array $orderby = null, QueryBuilder $queryBuilder) {
        if (!$orderby) {
            return;
        }

        foreach ($orderby as $field => $direction) {
            $field = $this->getFieldWithAlias($field);
            $queryBuilder->addOrderBy($field, strtoupper($direction));
        }
    }

    /**
     * Retorna o campo com o alias da entidade caso não houver
     *
     * @param $field
     * @return string
     */
    protected function getFieldWithAlias($field) {
        if (strpos($field, '.') === false) {
            return sprintf('%s.%s', $this->getAlias(), $field);
        }
        return $field;
    }

    /**
     * @inheritdoc
     */
    public function createQueryBuilder($alias, $indexBy = null) {
        $this->alias = $alias;
        return $this->queryBuilder();
    }

    /**
     * @inheritdoc
     */
    public function find($id, $lockMode = null, $lockVersion = null) {
        $queryBuilder = $this->queryBuilder();
        $queryBuilder->andWhere($this->getAlias() . '.id = :id');
        $queryBuilder->setParameter('id', $id);
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @inheritdoc
     */
    public function findAll() {
        $conn = $this->getEntityManager()
            ->getConnection();
//        $sql = 'select * from "Book" where '.time().'>0 ';exit;
//        $stmt = $conn->prepare($sql);
//        $stmt->execute();
//        return $stmt->fetchAll();
        
        $queryBuilder = $this->queryBuilder();
        
        $stmt = $conn->prepare($queryBuilder->getQuery()->getSQL());
        $stmt->execute();
        return $stmt->fetchAll();
        
        //return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) {
        $queryBuilder = $this->queryBuilder();
        $this->parseCriteria($criteria, $queryBuilder);
        $this->parseOrderby($orderBy, $queryBuilder);

        if ($limit) {
            $queryBuilder->setMaxResults($limit);
        }

        if ($offset) {
            $queryBuilder->setFirstResult($offset);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(array $criteria, array $orderBy = null) {
        $result = $this->findBy($criteria, $orderBy, 1);

        if (!$result) {
            return null;
        }

        return reset($result);
    }

    /**
     * @inheritdoc
     */
    abstract protected function getAlias();

    /**
     * @inheritdoc
     */
    public function transactional(\Closure $handler) {
        $this->_em->transactional($handler);
    }

    /**
     * @inheritdoc
     */
    public function getList(array $criteria, array $sort = [], int $limit = 10, int $offset = 0): array {
        $qb = $this->createQueryBuilder($this->getAlias());

        foreach ($criteria as $key => $value) {
            $qb->andWhere(sprintf("%s.%s = %s", $this->getAlias(), $key, ':' . $key));
            $qb->setParameter($key, $value);
        }

        foreach ($sort as $key => $direction) {
            $qb->addOrderBy(sprintf("%s.%s", $this->getAlias(), $key), $direction);
        }

        $qb->setMaxResults($limit);
        $qb->setFirstResult($offset);

        return $qb->getQuery()->getResult();
    }

    /**
     * @inheritdoc
     */
    public function count(array $criteria): int {
        $qb = $this->createQueryBuilder($this->getAlias());
        $qb->select('COUNT(1)');

        foreach ($criteria as $key => $value) {
            $qb->andWhere(sprintf("%s.%s = %s", $this->getAlias(), $key, ':' . $key));
            $qb->setParameter($key, $value);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
    
    public function save(EntityInterface $repurchase)
    {
        $this->getEntityManager()->persist($repurchase);
        $this->getEntityManager()->flush();
        return $repurchase;
    }

    /**
     * @inheritdoc
     */
    public function delete($id, $lockMode = null, $lockVersion = null) {
        $entity = $this->find($id, $lockMode = null, $lockVersion = null);
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
        
        return ($entity)? true : false;
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->_em;
    }
}
