<?php

namespace App\Services\Projects;

use App\Api\ProjectsApi;
use App\Custom\ImagesUploader\Services\ImagesUploaderService;

class ProjectsImagesService extends ImagesUploaderService {

    public function __construct(ProjectsApi $api) {
        parent::__construct($api);
    }

}
