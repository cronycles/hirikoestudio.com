<?php

namespace App\Services\Categories;

use App\Api\CategoriesApi;
use App\Entities\CategoryEntity;

class CategoriesService {

    /**
     * @var CategoriesApi
     */
    private $api;

    public function __construct(CategoriesApi $api) {
        $this->api = $api;
    }

    /**
     * @return CategoryEntity
     * @param $maxNumber int max number of items requested
     */
    public function getCategoryById($id) {
        return $this->api->getCategoryById($id);
    }

    /**
     * @return CategoryEntity[]
     * @param $maxNumber int max number of items requested
     */
    public function getCategories($maxNumber = null) {
        return $this->api->getCategories($maxNumber);
    }

}
