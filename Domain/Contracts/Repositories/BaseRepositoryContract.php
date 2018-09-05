<?php

namespace Domain\Contracts\Repositories;

use Domain\Contracts\Entities\EntityContract;

interface BaseRepositoryContract {

    /**
     * Retorna a contagem total da última consulta realizada, se for
     * utlizado o método $this->queryBuilder() para a construção da consulta
     * personalizada.
     *
     * @return int|null
     */
    public function countLastQuery();
    
    /**
     * Create Query Builder
     * 
     * Prepara a consulta de acordo com parametros informados, como criterias.
     * 
     * @param type $alias
     * @param type $indexBy
     */
    public function createQueryBuilder($alias, $indexBy = null);

    /**
     * Find
     * 
     * Encontra apenas 1 registro de acordo com o id
     * 
     * @param type $id
     * @param type $lockMode
     * @param type $lockVersion
     */
    public function find($id, $lockMode = null, $lockVersion = null);
    
    /**
     * Find All
     * 
     * Encontra todos or registros, deve levar em conta as condicoes obrigatórias de criterio.
     */
    public function findAll();

    /**
     * Find By
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param type $limit
     * @param type $offset
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * Find One By
     * 
     * @param array $criteria
     * @param array $orderBy
     */
    public function findOneBy(array $criteria, array $orderBy = null);
    
    /**
     * Transactional
     * 
     * @param \Closure $handler
     */
    public function transactional(\Closure $handler);
    
    /**
     * Get List
     * 
     * @param array $criteria
     * @param array $sort
     * @param int $limit
     * @param int $offset
     */
    public function getList(array $criteria, array $sort = [], int $limit = 10, int $offset = 0): array;

    /**
     * Count
     * 
     * @param array $criteria
     * @return int
     */
    public function count(array $criteria): int;
}