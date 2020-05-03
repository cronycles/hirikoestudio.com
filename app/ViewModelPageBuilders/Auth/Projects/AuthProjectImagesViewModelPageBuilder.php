<?php

namespace App\ViewModelPageBuilders\Auth\Projects;

use App\Services\Projects\ProjectsService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Projects\AuthProjectImagesPageViewModel;
use App\ViewModelsServices\Auth\AuthProjectsViewModelService;

class AuthProjectImagesViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var ProjectsService
     */
    private $service;

    /**
     * @var AuthProjectsViewModelService
     */
    private $viewModelService;


    public function __construct(
        ProjectsService $service,
        AuthProjectsViewModelService $viewModelService) {

        $this->service = $service;
        $this->viewModelService = $viewModelService;
    }

    public function createNewViewModel() {
        return new AuthProjectImagesPageViewModel();
    }

    /**
     * @param AuthProjectImagesPageViewModel $pageViewModel
     * @param array $params
     * @return AuthProjectImagesPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $entity = $this->service->getProjectById($params['id']);

        $pageViewModel->imageUploader = $this->viewModelService->createImagesUploaderViewModel($entity);

        return $pageViewModel;
    }
}
