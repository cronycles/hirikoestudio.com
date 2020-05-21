<?php

namespace App\Custom\Form\Helpers;

use App\Custom\Form\Captcha\Services\CaptchaService;
use App\Custom\Form\Models\Fields\FieldModel;
use App\Custom\Form\Models\FormModel;
use App\Custom\Form\Models\Fields\CheckboxItemFieldModel;
use App\Custom\Form\Models\Fields\SelectboxItemFieldModel;
use App\Custom\Translations\Entities\TranslationEntity;
use Illuminate\Http\Request;

class FormHelper {

    /**
     * @var FieldsHelper
     */
    private $fieldsHelper;

    /**
     * @var CaptchaService
     */
    private $captchaService;

    function __construct(
        FieldsHelper $fieldsHelper,
        CaptchaService $service) {

        $this->fieldsHelper = $fieldsHelper;
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
        $outcome->fields = $this->fieldsHelper->createEmptyFieldsByConfiguration($configuration);
        return $outcome;
    }

    /**
     * @param array $configuration
     * @param \Illuminate\Http\Request $request
     * @return FormModel
     */
    public function createAndFillFormModelByConfigurationAndInputRequest(array $configuration, Request $request) {
        $outcome = $this->initializeFormByConfiguration($configuration, null, null);
        $outcome->fields = $this->fieldsHelper->createAndFillFieldsByConfigurationAndInputRequest($configuration, $request);

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
        return $this->fieldsHelper->getFieldItemModelFromConfiguration($fieldConfiguration);
    }

    /**
     * @param TranslationEntity[]|null $translationEntity
     * @return string
     */
    public function getTranslatableFieldValueFromTranslatableEntity(FieldModel $field, $translationEntity) {
        return $this->fieldsHelper->getTranslatableFieldValueFromTranslatableEntity($field, $translationEntity);
    }

    /**
     * @param FieldModel $field
     * @return TranslationEntity
     */
    public function parseTranslatableField(FieldModel $field) {
        return $this->fieldsHelper->parseTranslatableField($field);
    }

    private function isACaptchaForm($formConfiguration) {
        return array_key_exists('withCaptcha', $formConfiguration) && $formConfiguration['withCaptcha'] === true;
    }

}
