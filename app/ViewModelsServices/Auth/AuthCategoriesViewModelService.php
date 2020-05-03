<?php

namespace App\ViewModelsServices\Auth;

use App\Custom\Form\Models\FormModel;
use App\Entities\CategoryEntity;
use App\Custom\Sorting\ViewModels\SortingItemViewModel;
use App\Custom\Sorting\ViewModels\SortingViewModel;
use App\FormBuilders\CategoryFormBuilder;

class AuthCategoriesViewModelService {

    /**
     * @var CategoryFormBuilder
     */
    private $formBuilder;

    public function __construct(CategoryFormBuilder $formBuilder) {

        $this->formBuilder = $formBuilder;
    }

    /**
     * @param string $actionUrl the url of submit form
     * @param string $saveTextButton text of save button
     * @param CategoryEntity $categoryEntity the entity to get the values for the form fields
     * @return FormModel
     */
    public function createFormDataViewModel($actionUrl, $saveTextButton, $categoryEntity = null) {
        return $this->formBuilder->createFormViewModelByConfigurationAndEntity($actionUrl, $saveTextButton, $categoryEntity);
    }

    /**
     * @param CategoryEntity[] $categoryEntities
     * @return SortingViewModel
     */
    public function createSortingViewModelByEntities($categoryEntities) {
        $outcome = new SortingViewModel();
        if ($categoryEntities != null and !empty($categoryEntities)) {
            $outcome->updateUrl = route('auth.categories.sort');

            /** @var CategoryEntity $categoryEntity */
            foreach ($categoryEntities as $categoryEntity) {
                if ($categoryEntity != null) {
                    $sortingItem = new SortingItemViewModel($categoryEntity->id, $categoryEntity->name);
                    array_push($outcome->items, $sortingItem);
                }
            }
        }

        return $outcome;
    }

}
