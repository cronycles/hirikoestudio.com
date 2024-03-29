<?php

namespace App\ViewModelsServices;

use App\Entities\ImageEntity;
use App\Custom\ImagesUploader\ViewModels\ImageViewModel;

class ImagesViewModelService {

    public function __construct() {
    }

    /**
     * @param ImageEntity[] $imageEntities
     * @return ImageViewModel
     */
    public function createImageCoverViewModelByImageEntityList($imageEntities) {
        $outcome = null;
        if ($imageEntities != null && !empty($imageEntities)) {
            $outcome = $this->createImageViewModel($imageEntities[0]);
        }
        else {
            $outcome = $this->getDefaultImage();
        }
        return $outcome;
    }

    /**
     * @return ImageViewModel
     */
    private function getDefaultImage() {
        $outcome = new ImageViewModel();
        $outcome->id = 0;
        $outcome->url = config('custom.images.static.defaultProjectImage');

        return $outcome;
    }

    /**
     * @param ImageEntity[] $imageEntities
     * @param bool $doesSetDefaultImagesIfNone
     * @return ImageViewModel[]
     */
    public function createImagesViewModel(array $imageEntities, bool $doesSetDefaultImagesIfNone = true) {
        $outcome = [];
        if (!empty($imageEntities)) {
            foreach ($imageEntities as $imageEntity) {
                $imageViewModel = $this->createImageViewModel($imageEntity);
                if ($imageViewModel != null) {
                    array_push($outcome, $imageViewModel);
                }
            }
        }
        else {
            if($doesSetDefaultImagesIfNone) {
                array_push($outcome, $this->getDefaultImage());
            }
        }
        return $outcome;
    }

    /**
     * @param ImageEntity $imageEntity
     * @return ImageViewModel
     */
    public function createImageViewModel(ImageEntity $imageEntity, bool $isMobile = false) {
        $outcome = null;
        if ($imageEntity != null) {
            $outcome = new ImageViewModel();
            $outcome->id = $imageEntity->id;
            $outcome->url = $imageEntity->url;
            $outcome->name = $imageEntity->name;
            $outcome->width = $imageEntity->width;
            $outcome->height = $imageEntity->height;
            $outcome->isSmallViewEnabled = $imageEntity->isSmallViewEnabled;
            $outcome->isMobile = $isMobile;
        }
        return $outcome;
    }

}
