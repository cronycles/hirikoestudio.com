<?php

namespace App\ViewModelPageBuilders\Auth\Categories;

use App\Services\Categories\CategoriesService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Categories\AuthCategoryCreatePageViewModel;
use App\ViewModels\Pages\Auth\Categories\AuthCategoryEditPageViewModel;
use App\ViewModelsServices\Auth\AuthCategoriesViewModelService;

class AuthCategoryEditViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var CategoriesService
     */
    private $service;

    /**
     * @var AuthCategoriesViewModelService
     */
    private $viewModelService;


    public function __construct(
        CategoriesService $service,
        AuthCategoriesViewModelService $viewModelService) {

        $this->service = $service;
        $this->viewModelService = $viewModelService;
    }

    public function createNewViewModel() {
        return new AuthCategoryEditPageViewModel();
    }

    /**
     * @param AuthCategoryCreatePageViewModel $pageViewModel
     * @param array $params
     * @return AuthCategoryCreatePageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $entity = $this->service->getCategoryById($params['id']);

        $pageViewModel->formData = $this->viewModelService->createFormDataViewModel(
            route('auth.categories.edit', $entity->id),
            __('page-auth-category-edit.form.send'),
            $entity);

        return $pageViewModel;
    }

}
