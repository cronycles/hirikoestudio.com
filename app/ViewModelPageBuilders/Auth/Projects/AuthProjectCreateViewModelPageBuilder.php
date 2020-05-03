<?php

namespace App\ViewModelPageBuilders\Auth\Projects;

use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Projects\AuthProjectCreatePageViewModel;
use App\ViewModelsServices\Auth\AuthProjectsViewModelService;

class AuthProjectCreateViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var AuthProjectsViewModelService
     */
    private $viewModelService;


    public function __construct(
        AuthProjectsViewModelService $viewModelService) {

        $this->viewModelService = $viewModelService;
    }

    public function createNewViewModel() {
        return new AuthProjectCreatePageViewModel();
    }

    /**
     * @param AuthProjectCreatePageViewModel $pageViewModel
     * @param array $params
     * @return AuthProjectCreatePageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $pageViewModel->noCategory = __('page-auth-project-create.no-category');
        $pageViewModel->addNewCategory = __('page-auth-project-create.add-category');

        $pageViewModel->formData = $this->viewModelService->createFormDataViewModel(
            route('auth.projects.create'),
            __('page-auth-project-create.form.send'));

        return $pageViewModel;
    }
}
