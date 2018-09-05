<?php

namespace Domain\Contracts\Services;

interface BaseServiceContract {

    public function batchCreate($arrayRecords);

    public function findAll();

    public function findAllFiltered($filter);

    public function find($entityId);

    public function findBy($arrKeyValue);

    public function findAllBy($arrKeyValue);

    public function findAllByFilter($filter);

    public function loadNew($post);

    public function getEntity();

    public function create($post);

    public function save($entity);

    public function update($entityId, $post);

    public function updateEntity($entity, $post);

    public function delete($entityId);

    public function alreadyExists($parameter, $exceptionMessage);

    public function count($companyId);
    
}
