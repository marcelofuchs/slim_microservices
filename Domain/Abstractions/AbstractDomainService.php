<?php

namespace Domain\Abstractions;

use \Domain\Contracts\Services\BaseServiceInterface;
use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Class AbstractDomainService
 *
 * @package Domain\Abstractions
 */
abstract class AbstractDomainService implements BaseServiceInterface
{
    /**
     * @var
     */
    public $repository;

    /**
     * AbstractDomainService constructor.
     * @param $repositoryContract
     */
    public function __construct($repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @param $arrayRecords
     * @return mixed|string
     */
    public function batchCreate($arrayRecords)
    {
        foreach ($arrayRecords as $data) {
            $entity = $this->loadNew($data);
            $this->repository->onlySave($entity);
        }

        return 'Records Sucessfully saved!';
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function findAllFiltered($filter)
    {
        return $this->repository->findAllFiltered($filter);
    }

    /**
     * @param $entityId
     * @return mixed
     */
    public function find($entityId)
    {
        return $this->repository->find($entityId);
    }

    /**
     * @param $arrKeyValue
     * @return mixed
     */
    public function findBy($arrKeyValue)
    {
        return $this->repository->findBy($arrKeyValue);
    }

    /**
     * @param $arrKeyValue
     * @return mixed
     */
    public function findAllBy($arrKeyValue)
    {
        return $this->repository->findAllBy($arrKeyValue);
    }

    /**
     * @param $filter
     * @return mixed
     */
    public function findAllByFilter($filter)
    {
        return $this->repository->findAll($filter);
    }

    /**
     * @param $post
     * @return mixed
     */
    public function loadNew($post)
    {
        return $this->repository->loadNew($post);
    }

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->repository->getEntity();
    }

    /**
     * @param $post
     * @return mixed
     */
    public function create($post)
    {
        if (!is_object($post)) {
            $post = $this->loadNew($post);
        }

        return $this->repository->save($post);
    }

    /**
     * @param $entity
     * @return mixed
     */
    abstract public function save(CommandInterface $entity);

    /**
     * @param $entityId
     * @param $post
     * @return mixed
     */
    public function update($entityId, $post)
    {
        $entity = $this->find($entityId);
        return $this->repository->update($entity, $post);
    }

    /**
     * @param $entity
     * @param $post
     * @return mixed
     */
    public function updateEntity(CommandInterface $entity, $post)
    {
        return $this->repository->update($entity, $post);
    }

    /**
     * @param $entityId
     * @return mixed
     */
    public function delete($entityId)
    {
        return $this->repository->delete($entityId);
    }

    /**
     * @param $parameter
     * @param $exceptionMessage
     * @return mixed|void
     * @throws \Exception
     */
    public function alreadyExists($parameter, $exceptionMessage)
    {
        $user = $this->repository->findBy($parameter);
        if (!is_null($user)) {
            throw new \Exception($exceptionMessage, 401);
        }
    }

    /**
     * @param $companyId
     * @return mixed
     */
    public function count($companyId)
    {
        return $this->repository->count($companyId);
    }
}