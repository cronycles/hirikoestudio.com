<?php

namespace App\FormBuilders;

use App\Custom\Form\Models\Fields\FieldModel;
use App\Custom\Form\Models\FormModel;
use App\Custom\Form\Builders\FormBuilder;
use App\Custom\Form\Helpers\FormHelper;
use App\Entities\ResetPasswordEntity;

class ResetPasswordFormBuilder extends FormBuilder {

    public function __construct(
        FormHelper $formViewModelService) {

        parent::__construct($formViewModelService, 'reset-password');
    }

    /**
     * @param FormModel $formViewModel
     * @param ResetPasswordEntity $entity
     */
    protected function fillFormFieldValuesWithEntityAttributes($formViewModel, $entity) {
        $fields = $formViewModel->fields;
        /** @var FieldModel $field */
        foreach ($fields as $field) {
            switch ($field->name) {
                case $this->getConfigFieldName('token'):
                    $field->value = $entity->token ?? null;
                    break;
                case $this->getConfigFieldName('email'):
                    $field->value = $entity->email ?? null;
                    break;
            }
        }
        return $formViewModel;
    }

    /**
     * @param FormModel $formViewModel
     * @return ResetPasswordEntity
     */
    protected function createEntityByFormViewModel($formViewModel) {
        $outcome = new ResetPasswordEntity();

        return $outcome;
    }
}
