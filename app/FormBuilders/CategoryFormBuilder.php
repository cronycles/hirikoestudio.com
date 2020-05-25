<?php

namespace App\FormBuilders;

use App\Custom\Form\Models\Fields\FieldModel;
use App\Custom\Form\Models\Fields\SelectboxFieldModel;
use App\Custom\Form\Models\FormModel;
use App\Entities\CategoryEntity;
use App\Entities\ProjectEntity;
use App\Custom\Form\Builders\FormBuilder;
use App\Custom\Form\Helpers\FormHelper;

class CategoryFormBuilder extends FormBuilder {

    /**
     * @var FormHelper
     */
    private $formHelper;

    public function __construct(FormHelper $formHelper) {

        parent::__construct($formHelper, 'category');

        $this->formHelper = $formHelper;

    }

    /**
     * @param FormModel $formViewModel
     * @param CategoryEntity $entity
     * @return FormModel
     */
    protected function fillFormFieldValuesWithEntityAttributes($formViewModel, $entity) {
        $fields = $formViewModel->fields;
        /** @var FieldModel $field */
        foreach ($fields as $field) {
            switch ($field->name) {
                case $this->getConfigFieldName('name'). "_" . $field->localeCode:
                    $field->value = $this->formHelper->getTranslatableFieldValueFromTranslatableEntity($field, $entity->nameTranslations ?? null);
                    break;
            }
        }
        return $formViewModel;
    }

    /**
     * @param FormModel $formViewModel
     * @return CategoryEntity
     */
    protected function createEntityByFormViewModel($formViewModel) {
        $outcome = new CategoryEntity();

        $fields = $formViewModel->fields;
        /** @var FieldModel|SelectboxFieldModel $field */
        foreach ($fields as $field) {
            switch ($field->name) {
                case $this->getConfigFieldName('name'):
                    array_push($outcome->nameTranslations, $this->formHelper->parseTranslatableField($field));
                    break;
            }
        }


        return $outcome;
    }

}
