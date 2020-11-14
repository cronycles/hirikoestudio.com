<?php

namespace App\Services\Carousel;

use App\Api\CarouselImagesApi;
use App\Custom\ImagesUploader\Services\ImagesUploaderService;
use App\Entities\CarouselImageEntity;

class CarouselImagesService extends ImagesUploaderService {

    public function __construct(CarouselImagesApi $api) {
        parent::__construct($api);
    }

    /**
     * @return CarouselImageEntity[];
     */
    public function getCarouselImages() {
        return $this->api->getCarouselImages();
    }
}
