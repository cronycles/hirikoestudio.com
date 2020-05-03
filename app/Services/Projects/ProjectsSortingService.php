<?php

namespace App\Services\Projects;

use App\Api\ProjectsApi;
use App\Custom\Sorting\Services\SortingService;

class ProjectsSortingService extends SortingService {

    public function __construct(ProjectsApi $api) {
        parent::__construct($api);
    }

}
