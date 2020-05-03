<?php

namespace App\ViewModelPageBuilders\Auth\Categories;

use App\Entities\CategoryEntity;
use App\Services\Categories\CategoriesService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Form\FormModel;
use App\ViewModels\Pages\Auth\Categories\AuthCategoryCreatePageViewModel;
use App\ViewModelsServices\Auth\AuthCategoriesViewModelService;
use App\ViewModelsServices\CategoriesViewModelService;
use App\ViewModelsServices\Fields\FieldsViewModelService;

class AuthCategoryCreateViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var AuthCategoriesViewModelService
     */
    private $authCategoriesViewModelService;


    public function __construct(
        AuthCategoriesViewModelService $authCategoriesViewModelService) {

        $this->authCategoriesViewModelService = $authCategoriesViewModelService;
    }

    public function createNewViewModel() {
        return new AuthCategoryCreatePageViewModel();
    }

    /**
     * @param AuthCategoryCreatePageViewModel $pageViewModel
     * @param array $params
     * @return AuthCategoryCreatePageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $pageViewModel->formData = $this->authCategoriesViewModelService->createFormDataViewModel(
            route('auth.categories.create'),
            __('page-auth-category-create.form.send'));
        return $pageViewModel;
    }
}
