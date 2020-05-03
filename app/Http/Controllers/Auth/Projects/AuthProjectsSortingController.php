<?php

namespace App\Http\Controllers\Auth\Projects;

use App\Custom\Sorting\Controllers\SortingController;
use App\Services\Projects\ProjectsSortingService;

class AuthProjectsSortingController extends SortingController {

    public function __construct(ProjectsSortingService $service) {
        parent::__construct($service);
    }


}
