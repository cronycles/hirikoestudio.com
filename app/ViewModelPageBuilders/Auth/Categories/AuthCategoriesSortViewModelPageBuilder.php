<?php

namespace App\ViewModelPageBuilders\Auth\Categories;

use App\Services\Categories\CategoriesService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Categories\AuthCategoriesSortPageViewModel;
use App\ViewModelsServices\Auth\AuthCategoriesViewModelService;

class AuthCategoriesSortViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * @var AuthCategoriesViewModelService
     */
    private $authCategoriesViewModelService;

    public function __construct(
        CategoriesService $categoriesService,
        AuthCategoriesViewModelService $authCategoriesViewModelService) {

        $this->categoriesService = $categoriesService;
        $this->authCategoriesViewModelService = $authCategoriesViewModelService;
    }

    public function createNewViewModel() {
        return new AuthCategoriesSortPageViewModel();
    }

    /**
     * @param AuthCategoriesSortPageViewModel $pageViewModel
     * @param array $params
     * @return AuthCategoriesSortPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $categoryEntities = $this->categoriesService->getCategories(false);

        $pageViewModel->sorting = $this->authCategoriesViewModelService->createSortingViewModelByEntities($categoryEntities);

        return $pageViewModel;
    }

}
