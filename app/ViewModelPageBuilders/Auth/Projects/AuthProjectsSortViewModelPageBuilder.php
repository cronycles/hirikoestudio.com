<?php

namespace App\ViewModelPageBuilders\Auth\Projects;

use App\Services\Projects\ProjectsService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Projects\AuthProjectEditPageViewModel;
use App\ViewModels\Pages\Auth\Projects\AuthProjectsSortPageViewModel;
use App\ViewModelsServices\Auth\AuthProjectsViewModelService;

class AuthProjectsSortViewModelPageBuilder extends AuthViewModelPageBuilder {

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
        return new AuthProjectsSortPageViewModel();
    }

    /**
     * @param AuthProjectEditPageViewModel $pageViewModel
     * @param array $params
     * @return AuthProjectEditPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $entities = $this->service->getProjects(false);

        $pageViewModel->sorting = $this->viewModelService->createSortingViewModelByEntities($entities);

        return $pageViewModel;
    }
}
