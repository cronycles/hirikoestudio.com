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
     * @return array
     */
    public function createImagesViewModel(array $imageEntities, bool $doesSetDefaultImagesIfNone = true) {
        $outcome = [];
        if ($imageEntities != null && !empty($imageEntities)) {
            /** @var ImageEntity $imageEntity */
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
    private function createImageViewModel(ImageEntity $imageEntity) {
        $outcome = null;
        if ($imageEntity != null) {
            $outcome = new ImageViewModel();
            $outcome->id = $imageEntity->id;
            $outcome->url = $imageEntity->url;
        }
        return $outcome;
    }

}
