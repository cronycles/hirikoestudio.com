<?php

namespace App\Custom\Form\Helpers;

use App\Custom\Form\Captcha\Services\CaptchaService;
use App\Custom\Form\Models\FormModel;
use App\Custom\Form\Models\Fields\CheckboxItemFieldModel;
use App\Custom\Form\Models\Fields\SelectboxItemFieldModel;
use Illuminate\Http\Request;

class FormHelper {

    /**
     * @var FieldsHelper
     */
    private $fieldsViewModelService;

    /**
     * @var CaptchaService
     */
    private $captchaService;

    function __construct(
        FieldsHelper $fieldsViewModelService,
        CaptchaService $service) {

        $this->fieldsViewModelService = $fieldsViewModelService;
        $this->captchaService = $service;
    }

    /**
     * @param array $configuration
     * @param string|null $actionUrl
     * @param string|null $buttonText
     * @return FormModel
     */
    public function createEmptyFormViewModelByConfiguration(array $configuration, $actionUrl = null, $buttonText = null) {
        $outcome = $this->initializeFormByConfiguration($configuration, $actionUrl, $buttonText);
        $outcome->fields = $this->fieldsViewModelService->createEmptyFieldsByConfiguration($configuration);
        return $outcome;
    }

    /**
     * @param array $configuration
     * @param \Illuminate\Http\Request $request
     * @return FormModel
     */
    public function createAndFillFormModelByConfigurationAndInputRequest(array $configuration, Request $request) {
        $outcome = $this->initializeFormByConfiguration($configuration, null, null);
        $outcome->fields = $this->fieldsViewModelService->createAndFillFieldsByConfigurationAndInputRequest($configuration, $request);

        if($this->isACaptchaForm($configuration)) {
            $outcome->captcha->isValid = $this->captchaService->validateCaptcha(config('custom.captcha.field'));
        }

        return $outcome;
    }

    public function isAValidCaptchaFormRequest(Request $request, array $configuration) {
        $outcome = false;
        if($this->isACaptchaForm($configuration)) {
            $captchaFieldValue = $request->input(config('custom.captcha.field'));
            $outcome = $this->captchaService->validateCaptcha($captchaFieldValue);
        }
        return $outcome;
    }

    /**
     * @param array $configuration
     * @param string $actionUrl
     * @param string $buttonText
     * @return FormModel
     */
    public function initializeFormByConfiguration($configuration, $actionUrl, $buttonText) {
        $outcome = new FormModel();
        $outcome->id = $configuration['id'];
        $outcome->actionUrl = $actionUrl;
        $outcome->buttonText = $buttonText;

        if($this->isACaptchaForm($configuration)) {
            $outcome->captcha = $this->captchaService->getModel($outcome->id);
        }

        return $outcome;
    }

    /**
     * @param array $fieldConfiguration
     * @return CheckboxItemFieldModel|SelectboxItemFieldModel|null
     */
    public function getFieldItemModelFromConfiguration(array $fieldConfiguration) {
        return $this->fieldsViewModelService->getFieldItemModelFromConfiguration($fieldConfiguration);
    }

    private function isACaptchaForm($formConfiguration) {
        return array_key_exists('withCaptcha', $formConfiguration) && $formConfiguration['withCaptcha'] === true;
    }

}
