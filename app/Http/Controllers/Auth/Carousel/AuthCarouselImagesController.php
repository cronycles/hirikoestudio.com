<?php

namespace App\Http\Controllers\Auth\Carousel;

use App\Custom\ImagesUploader\Controllers\ImagesUploaderController;
use App\Services\Carousel\CarouselImagesService;

class AuthCarouselImagesController extends ImagesUploaderController {

    public function __construct(CarouselImagesService $service) {
        parent::__construct($service);
    }


}
