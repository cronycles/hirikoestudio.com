<?php

namespace App\ViewModels\Pages\Auth\HomeSlides;

use App\Custom\ImagesUploader\ViewModels\ImagesPageViewModelTrait;
use App\ViewModels\Pages\PageViewModel;

class AuthHomeSlidesPageViewModel extends PageViewModel {

    use ImagesPageViewModelTrait;

    public function __construct() {
        parent::__construct();
    }

}
