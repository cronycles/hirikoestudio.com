<?php

namespace App\ViewModelsServices;

use App\Entities\CategoryEntity;
use App\ViewModels\Categories\CategoryViewModel;

class CategoriesViewModelService {

    public function __construct() {
    }

    /**
     * Crea la categoria "tutte"
     *
     * @return CategoryViewModel
     */
    public function createCategoryAllViewModel() {
        $outcome = new CategoryViewModel();
        $outcome->id = 0;
        $outcome->name = __('category.allCategories');
        $outcome->isActive = true;
        return $outcome;
    }

    /**
     * @param CategoryEntity[] $categoryEntities
     * @return CategoryViewModel[]
     */
    public function createCategoriesViewModelByEntities($categoryEntities) {
        $outcome = [];
        if ($categoryEntities != null and !empty($categoryEntities)) {
            /** @var CategoryEntity $categoryEntity */
            foreach ($categoryEntities as $categoryEntity) {
                if ($categoryEntity != null) {
                    $categoryViewModel = $this->createCategoryViewModelByEntity($categoryEntity);
                    if ($categoryViewModel != null) {
                        array_push($outcome, $categoryViewModel);
                    }
                }
            }
        }
        return $outcome;
    }

    /**
     * @param CategoryEntity $categoryEntity
     * @return CategoryViewModel
     */
    public function createCategoryViewModelByEntity($categoryEntity) {
        $outcome = null;
        if ($categoryEntity != null) {
            $outcome = new CategoryViewModel();
            $outcome->id = $categoryEntity->id;
            $outcome->name = $categoryEntity->name;
        }
        return $outcome;
    }
}
