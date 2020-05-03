<?php


namespace App\Custom\CRUD\Api;

use App\Custom\Entities\CustomEntity;

interface ICrudApi {
    /**
     * @param CustomEntity $entity
     * @return bool
     */
    public function storeEntity($entity);

    /**
     * @param CustomEntity $entity
     * @return bool
     */
    public function updateEntity($entity);

    /**
     * @param CustomEntity $entity
     * @return bool
     */
    public function deleteEntity(int $id);
}
