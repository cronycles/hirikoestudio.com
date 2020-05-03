<?php

namespace App\ViewModelsServices\Auth;

use App\Custom\Form\Models\FormModel;
use App\FormBuilders\RegisterFormBuilder;

class RegisterViewModelService {

    /**
     * @var RegisterFormBuilder
     */
    private $formBuilder;

    public function __construct(
        RegisterFormBuilder $formBuilder) {

        $this->formBuilder = $formBuilder;
    }

    /**
     * @return FormModel
     */
    public function createViewModelFormData() {

        return $this->formBuilder->createFormViewModelByConfigurationAndEntity(route('register'),
            __('page-auth-register.form.send'));

    }

}
