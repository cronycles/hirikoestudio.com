<?php

namespace App\ViewModelPageBuilders\Auth\Projects;

use App\Services\Projects\ProjectsService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Projects\AuthProjectEditPageViewModel;
use App\ViewModelsServices\Auth\AuthProjectsViewModelService;

class AuthProjectEditViewModelPageBuilder extends AuthViewModelPageBuilder {

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
        return new AuthProjectEditPageViewModel();
    }

    /**
     * @param AuthProjectEditPageViewModel $pageViewModel
     * @param array $params
     * @return AuthProjectEditPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $entity = $this->service->getProjectById($params['id']);

        $pageViewModel->noCategory = __('page-auth-project-edit.no-category');
        $pageViewModel->addNewCategory = __('page-auth-project-edit.add-category');

        $pageViewModel->formData = $this->viewModelService->createFormDataViewModel(
            route('auth.projects.edit', $entity->id),
            __('page-auth-project-edit.form.send'),
            $entity);

        return $pageViewModel;
    }
}
