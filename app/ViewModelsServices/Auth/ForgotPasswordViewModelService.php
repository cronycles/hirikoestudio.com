<?php

namespace App\ViewModelsServices\Auth;

use App\Custom\Form\Models\FormModel;
use App\FormBuilders\ForgotPasswordFormBuilder;

class ForgotPasswordViewModelService {

    /**
     * @var ForgotPasswordFormBuilder
     */
    private $formBuilder;

    public function __construct(
        ForgotPasswordFormBuilder $formBuilder) {

        $this->formBuilder = $formBuilder;
    }

    /**
     * @return FormModel
     */
    public function createViewModelFormData() {

        return $this->formBuilder->createFormViewModelByConfigurationAndEntity(route('password.email'),
            __('page-auth-forgot-password.form.send'));

    }

}
