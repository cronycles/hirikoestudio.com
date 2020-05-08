<?php

namespace App\FormBuilders;

use App\Custom\Form\Models\Fields\FieldModel;
use App\Custom\Form\Models\FormModel;
use App\Entities\ContactEntity;
use App\Custom\Form\Builders\FormBuilder;
use App\Custom\Form\Helpers\FormHelper;

class ContactFormBuilder extends FormBuilder {

    public function __construct(
        FormHelper $formViewModelService) {
        parent::__construct($formViewModelService, 'contact');
    }

    /**
     * @param FormModel $formViewModel
     * @param ContactEntity $entity
     */
    protected function fillFormFieldValuesWithEntityAttributes($formViewModel, $entity) {
        $fields = $formViewModel->fields;
        /** @var FieldModel $field */
        foreach ($fields as $field) {
            switch ($field->name) {
                case $this->getConfigFieldName('name'):
                    $field->value = $entity->name ?? null;
                    break;
                case $this->getConfigFieldName('email'):
                    $field->value = $entity->email ?? null;
                    break;
                case $this->getConfigFieldName('telephone'):
                    $field->value = $entity->telephone ?? null;
                    break;
                case $this->getConfigFieldName('message'):
                    $field->value = $entity->message ?? null;
                    break;
            }
        }
        return $formViewModel;
    }

    /**
     * @param FormModel $formViewModel
     * @return ContactEntity
     */
    protected function createEntityByFormViewModel($formViewModel) {
        $outcome = new ContactEntity();

        $fields = $formViewModel->fields;
        /** @var FieldModel $field */
        foreach ($fields as $field) {
            switch ($field->name) {
                case $this->getConfigFieldName('name'):
                    $outcome->name = $this->parseStringFieldValue($field->value);
                    break;
                case $this->getConfigFieldName('email'):
                    $outcome->email = $this->parseStringFieldValue($field->value);
                    break;
                case $this->getConfigFieldName('telephone'):
                    $outcome->telephone = $this->parseStringFieldValue($field->value);
                    break;
                case $this->getConfigFieldName('message'):
                    $outcome->message = $this->parseStringFieldValue($field->value);
                    break;
            }
        }


        return $outcome;
    }
}
