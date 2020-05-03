<?php

namespace App\Http\Controllers\Auth\Categories;

use App\Custom\Sorting\Controllers\SortingController;
use App\Services\Categories\CategoriesSortingService;

class AuthCategoriesSortingController extends SortingController {

    public function __construct(CategoriesSortingService $service) {
        parent::__construct($service);
    }

}
