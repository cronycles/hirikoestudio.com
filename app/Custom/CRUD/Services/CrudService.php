<?php

namespace App\Custom\CRUD\Services;

use App\Custom\CRUD\Api\ICrudApi;
use App\Custom\Entities\CustomEntity;

abstract class CrudService {

    /**
     * @var ICrudApi
     */
    private $api;

    public function __construct(ICrudApi $api) {
        $this->api = $api;
    }

    /**
     * @param CustomEntity $entity
     * @return bool
     */
    public function storeEntity($entity) {
        return $this->api->storeEntity($entity);
    }

    /**
     * @param CustomEntity $entity
     * @return bool
     */
    public function updateEntity($entity) {
        return $this->api->updateEntity($entity);
    }

    /**
     * @param CustomEntity $entity
     * @return bool
     */
    public function deleteEntity(int $id) {
        return $this->api->deleteEntity($id);
    }

}
