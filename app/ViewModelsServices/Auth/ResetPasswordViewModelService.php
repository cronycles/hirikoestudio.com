<?php

namespace App\ViewModelsServices\Auth;

use App\Custom\Form\Models\FormModel;
use App\Entities\ResetPasswordEntity;
use App\FormBuilders\ResetPasswordFormBuilder;

class ResetPasswordViewModelService {

    /**
     * @var ResetPasswordFormBuilder
     */
    private $formBuilder;

    public function __construct(
        ResetPasswordFormBuilder $formBuilder) {

        $this->formBuilder = $formBuilder;
    }

    /**
     * @param string $token
     * @param string $email
     * @return FormModel
     */
    public function createViewModelFormData($token, $email) {
        $entity = new ResetPasswordEntity();
        $entity->token = $token;
        $entity->email = $email;
        return $this->formBuilder->createFormViewModelByConfigurationAndEntity(route('password.update'),
            __('page-auth-reset-password.form.send'),
            $entity);

    }

}
