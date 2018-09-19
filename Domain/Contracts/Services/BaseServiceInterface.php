<?php

namespace Domain\Contracts\Services;

use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Interface BaseServiceInterface
 *
 * @package Domain\Contracts\Services
 */
interface BaseServiceInterface {

    /**
     * @param $arrayRecords
     * @return mixed
     */
    public function batchCreate($arrayRecords);

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param $filter
     * @return mixed
     */
    public function findAllFiltered($filter);

    /**
     * @param $entityId
     * @return mixed
     */
    public function find($entityId);

    /**
     * @param $arrKeyValue
     * @return mixed
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param $arrKeyValue
     * @return mixed
     */
    public function findAllBy($arrKeyValue);

    /**
     * @param $filter
     * @return mixed
     */
    public function findAllByFilter($filter);

    /**
     * @param $post
     * @return mixed
     */
    public function loadNew($post);

    /**
     * @return mixed
     */
    public function getEntity();

    /**
     * @param $post
     * @return mixed
     */
    public function create($post);

    /**
     * @param $entity
     * @return mixed
     */
    public function save(CommandInterface $entity);

    /**
     * @param $entityId
     * @param $post
     * @return mixed
     */
    public function update(CommandInterface $entity);

    /**
     * @param $entity
     * @param $post
     * @return mixed
     */
    public function updateEntity(CommandInterface $entity, $post);

    /**
     * @param $entityId
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $parameter
     * @param $exceptionMessage
     * @return mixed
     */
    public function alreadyExists($parameter, $exceptionMessage);

    /**
     * @param $companyId
     * @return mixed
     */
    public function count($companyId);
    
}
