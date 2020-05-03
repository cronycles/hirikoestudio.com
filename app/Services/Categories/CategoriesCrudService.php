<?php

namespace App\Services\Categories;

use App\Api\CategoriesApi;
use App\Custom\CRUD\Services\CrudService;

class CategoriesCrudService extends CrudService {

    public function __construct(CategoriesApi $api) {
        parent::__construct($api);
    }

}
