<?php

namespace App\FormBuilders;

use App\Custom\Form\Models\FormModel;
use App\Custom\Form\Builders\FormBuilder;
use App\Custom\Form\Helpers\FormHelper;
use App\Entities\UserEntity;

class RegisterFormBuilder extends FormBuilder {

    public function __construct(
        FormHelper $formViewModelService) {

        parent::__construct($formViewModelService, 'register');
    }

    /**
     * @param FormModel $formViewModel
     * @param UserEntity $entity
     */
    protected function fillFormFieldValuesWithEntityAttributes($formViewModel, $entity) {
        return $formViewModel;
    }

    /**
     * @param FormModel $formViewModel
     * @return UserEntity
     */
    protected function createEntityByFormViewModel($formViewModel) {
        $outcome = new UserEntity();

        return $outcome;
    }
}
