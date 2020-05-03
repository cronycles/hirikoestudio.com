<?php

namespace App\Services\Categories;

use App\Api\CategoriesApi;
use App\Custom\Sorting\Services\SortingService;

class CategoriesSortingService extends SortingService {

    public function __construct(CategoriesApi $api) {
        parent::__construct($api);
    }

}
