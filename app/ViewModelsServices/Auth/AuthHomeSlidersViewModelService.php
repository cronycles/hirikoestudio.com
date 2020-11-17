<?php

namespace App\ViewModelsServices\Auth;

use App\Entities\CarouselImageEntity;
use App\Custom\ImagesUploader\ViewModels\ImagesUploaderViewModel;
use App\ViewModelsServices\ImagesViewModelService;

class AuthHomeSlidersViewModelService {

    /**
     * @var ImagesViewModelService
     */
    private $imagesViewModelService;

    public function __construct(ImagesViewModelService $imagesViewModelService) {
        $this->imagesViewModelService = $imagesViewModelService;
    }

    /**
     * @param CarouselImageEntity[]
     * @return ImagesUploaderViewModel
     */
    public function createImagesUploaderViewModel(array $entities) {
        $outcome = new ImagesUploaderViewModel();

        /** @var CarouselImageEntity $entity */
        foreach ($entities as $entity) {
            $imageViewModel = $this->imagesViewModelService->createImageViewModel($entity->image, $entity->isMobile);
            array_push($outcome->images, $imageViewModel);
        }
        $outcome->uploadApiUrl = route('auth.home-slides.images.upload');
        $outcome->updateSortApiUrl = route('auth.home-slides.imagesSort');
        $outcome->maxNumberOfFiles = config('custom.images.upload.maxNumberOfFiles');
        return $outcome;

    }

}
