<?php

namespace App\Services\Projects;

use App\Api\ProjectsApi;
use App\Custom\CRUD\Services\CrudService;

class ProjectsCrudService extends CrudService {

    public function __construct(ProjectsApi $api) {
        parent::__construct($api);
    }

}
