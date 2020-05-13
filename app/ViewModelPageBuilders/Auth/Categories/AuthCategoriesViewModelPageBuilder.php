<?php

namespace App\ViewModelPageBuilders\Auth\Categories;

use App\Entities\CategoryEntity;
use App\Services\Categories\CategoriesService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Categories\AuthCategoryIndexPageViewModel;
use App\Custom\CRUD\ViewModels\CrudLinkViewModel;
use App\Custom\CRUD\ViewModels\CrudTableItemViewModel;
use App\Custom\CRUD\ViewModels\CrudTableViewModel;

class AuthCategoriesViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    public function __construct(
        CategoriesService $categoriesService) {

        $this->categoriesService = $categoriesService;
    }

    public function createNewViewModel() {
        return new AuthCategoryIndexPageViewModel();
    }

    /**
     * @param AuthCategoryIndexPageViewModel $pageViewModel
     * @param array $params
     * @return AuthCategoryIndexPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $categoryEntities = $this->categoriesService->getCategories();

        $pageViewModel->createLink = new CrudLinkViewModel(route('auth.categories.create'), __('page-auth-categories.create-new-button'));
        $pageViewModel->sortLink = new CrudLinkViewModel(route('auth.categories.sort'), __('page-auth-categories.sort-button'));

        $pageViewModel->crudTable = $this->createCrudTableViewModel($categoryEntities);
        return $pageViewModel;
    }

    /**
     * @param CategoryEntity[] $entities
     * @return CrudTableViewModel
     */
    private function createCrudTableViewModel(array $entities) {
        $outcome = new CrudTableViewModel();
        $outcome->isEditingEnabled = true;
        $outcome->isDeletingEnabled = true;

        if($entities != null && !empty($entities)) {
            foreach ($entities as $entity) {
                $crudItem = new CrudTableItemViewModel();
                $crudItem->id = $entity->id;
                $crudItem->name = $entity->name;
                $crudItem->editUrl = route('auth.categories.edit', ['id' =>$entity->id]);
                $crudItem->deleteUrl = route('auth.categories.delete', ['id' =>$entity->id]);
                array_push($outcome->items, $crudItem);
            }
        }

        return $outcome;
    }

}
