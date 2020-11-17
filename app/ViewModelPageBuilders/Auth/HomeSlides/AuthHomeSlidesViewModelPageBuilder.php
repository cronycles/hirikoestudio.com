<?php

namespace App\ViewModelPageBuilders\Auth\HomeSlides;

use App\Services\Carousel\CarouselImagesService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\HomeSlides\AuthHomeSlidesPageViewModel;
use App\ViewModelsServices\Auth\AuthHomeSlidersViewModelService;

class AuthHomeSlidesViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var CarouselImagesService
     */
    private $service;

    /**
     * @var AuthHomeSlidersViewModelService
     */
    private $viewModelService;


    public function __construct(
        CarouselImagesService $service,
        AuthHomeSlidersViewModelService $viewModelService) {

        $this->service = $service;
        $this->viewModelService = $viewModelService;
    }

    public function createNewViewModel() {
        return new AuthHomeSlidesPageViewModel();
    }

    /**
     * @param AuthHomeSlidesPageViewModel $pageViewModel
     * @param array $params
     * @return AuthHomeSlidesPageViewModel
     */
    public function fillPageViewModel($pageViewModel, array $params) {

        $imageEntities = $this->service->getCarouselImages();

        $pageViewModel->imageUploader = $this->viewModelService->createImagesUploaderViewModel($imageEntities);
        $pageViewModel->imageUploader->isSmallViewEnabled = false;
        $pageViewModel->imageUploader->isMobileTickEnabled = true;
        return $pageViewModel;
    }
}
