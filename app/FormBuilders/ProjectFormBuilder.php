<?php

namespace App\FormBuilders;

use App\Custom\Form\Models\Fields\FieldModel;
use App\Custom\Form\Models\Fields\SelectboxFieldModel;
use App\Custom\Form\Models\FormModel;
use App\Entities\ProjectEntity;
use App\Custom\Form\Builders\FormBuilder;
use App\Custom\Form\Helpers\FormHelper;
use App\Services\Categories\CategoriesService;

class ProjectFormBuilder extends FormBuilder {

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    public function __construct(
        CategoriesService $categoriesService,
        FormHelper $formViewModelService) {

        parent::__construct($formViewModelService, 'project');

        $this->categoriesService = $categoriesService;
    }

    /**
     * @param FormModel $formViewModel
     * @param ProjectEntity $entity
     */
    protected function fillFormFieldValuesWithEntityAttributes($formViewModel, $entity) {
        $fields = $formViewModel->fields;
        /** @var FieldModel|SelectboxFieldModel $field */
        foreach ($fields as $field) {
            switch ($field->name) {
                case $this->getConfigFieldName('title'):
                    $field->value = $entity->title ?? null;
                    break;
                case $this->getConfigFieldName('description'):
                    $field->value = $entity->description ?? null;
                    break;
                case $this->getConfigFieldName('show'):
                    $field->value = $entity->isVisible ?? null;
                    break;
                case $this->getConfigFieldName('category'):
                    $field->items = $this->fillCategoryFieldItems();
                    $field->selectedId = $entity != null ? $entity->category->id : null;
                    break;
            }
        }
        return $formViewModel;
    }

    /**
     * @param FormModel $formViewModel
     * @return ProjectEntity
     */
    protected function createEntityByFormViewModel($formViewModel) {
        $outcome = new ProjectEntity();

        $fields = $formViewModel->fields;
        /** @var FieldModel|SelectboxFieldModel $field */
        foreach ($fields as $field) {
            switch ($field->name) {
                case $this->getConfigFieldName('title'):
                    $outcome->title = $this->parseStringFieldValue($field->value);
                    break;
                case $this->getConfigFieldName('description'):
                    $outcome->descriptionTranslations = $this->parseTranslatableFieldValue($field->value);
                    break;
                case $this->getConfigFieldName('show'):
                    $outcome->isVisible = $this->parseBooleanFieldValue($field->value);
                    break;
                case $this->getConfigFieldName('category'):
                    $outcome->category->id = $this->parseIntegerFieldValue($field->value);
                    break;
            }
        }


        return $outcome;
    }

    /**
     * @return FieldModel[]
     */
    private function fillCategoryFieldItems() {
        $outcome = [];
        $categoryEntities = $this->categoriesService->getCategories();
        foreach ($categoryEntities as $categoryEntity) {
            /** @var SelectboxFieldModel $fieldItem */
            $fieldItem = $this->getFieldItemModelFromConfiguration($this->fieldsConfig['category']);
            $fieldItem->name = $categoryEntity->name;
            $fieldItem->value = $categoryEntity->id;

            array_push($outcome, $fieldItem);
        }
        return $outcome;
    }

}
