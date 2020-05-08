<?php

namespace App\ViewModels\Pages\Auth\Projects;

use App\Custom\ImagesUploader\ViewModels\ImagesPageViewModelTrait;
use App\ViewModels\Pages\PageViewModel;

class AuthProjectImagesPageViewModel extends PageViewModel {

    use ImagesPageViewModelTrait;

    public function __construct() {
        parent::__construct();
    }

}
