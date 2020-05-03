<?php

namespace App\ViewModelsServices\Auth;

use App\Custom\Form\Models\FormModel;
use App\FormBuilders\LoginFormBuilder;

class LoginViewModelService {

    /**
     * @var LoginFormBuilder
     */
    private $formBuilder;

    public function __construct(
        LoginFormBuilder $formBuilder) {

        $this->formBuilder = $formBuilder;
    }

    /**
     * @return FormModel
     */
    public function createViewModelFormData() {

        return $this->formBuilder->createFormViewModelByConfigurationAndEntity(route('login'),
            __('page-auth-login.form.send'));

    }

}
