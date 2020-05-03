<?php

namespace App\Http\Controllers\Auth\Projects;

use App\Custom\ImagesUploader\Controllers\ImagesUploaderController;
use App\Services\Projects\ProjectsImagesService;

class AuthProjectsImagesController extends ImagesUploaderController {

    public function __construct(ProjectsImagesService $service) {
        parent::__construct($service);
    }


}
