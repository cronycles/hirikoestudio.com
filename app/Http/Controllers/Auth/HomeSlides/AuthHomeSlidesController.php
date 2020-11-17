<?php

namespace App\Http\Controllers\Auth\HomeSlides;

use App\Custom\ImagesUploader\Controllers\ImagesUploaderController;
use App\Services\Carousel\CarouselImagesService;

class AuthHomeSlidesController extends ImagesUploaderController {

    public function __construct(CarouselImagesService $service) {
        parent::__construct($service);
    }


}
