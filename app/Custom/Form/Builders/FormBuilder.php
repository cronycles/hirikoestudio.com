<?php

namespace App\Custom\Form\Builders;

use App\Custom\Entities\CustomEntity;
use App\Custom\Form\Captcha\Entities\CaptchaEntityTrait;
use App\Custom\Form\Models\Fields\FieldModel;
use App\Custom\Form\Models\FormModel;
use App\Custom\Translations\Entities\TranslationEntity;
use App\Custom\Form\Helpers\FormHelper;
use Illuminate\Http\Request;

abstract class FormBuilder {

    use TranslatableFormBuilderTrait;

    /**
     * @var FormHelper
     */
    private $formHelper;

    /**
     * @var array
     */
    protected $formConfig;

    /**
     * @var array
     */
    protected $fieldsConfig;

    public function __construct(
        FormHelper $formViewModelService,
        string $formConfigKey) {

        $this->formHelper = $formViewModelService;

        $this->formConfig = config('custom.form.'. $formConfigKey);
        $this->fieldsConfig = $this->formConfig['fields'];
    }

    public function createFormViewModelByConfigurationAndEntity(string $actionUrl, string $saveTextButton, $customEntity = null) {
        $outcome = $this->formHelper->createEmptyFormViewModelByConfiguration(
            $this->formConfig,
            $actionUrl,
            $saveTextButton);

        return $this->fillFormFieldValuesWithEntityAttributes($outcome, $customEntity);
    }

    /**
     * @param Request $request
     * @return CustomEntity
     */
    public function createEntityFromRequest(Request $request) {
        $formViewModel = $this->createFormViewModelByRequestInput($request);
        $outcome = $this->createEntityByFormViewModel($formViewModel);
        return $outcome;
    }

    public function isAValidCaptchaRequest(Request $request) {
        return $this->formHelper->isAValidCaptchaFormRequest($request, $this->formConfig);
    }

    /**
     * @param FormModel $formViewModel
     * @param CustomEntity $entity
     * @return FormModel
     */
    protected abstract function fillFormFieldValuesWithEntityAttributes($formViewModel, $entity);


    /**
     * @param FormModel $formViewModel
     * @return CustomEntity
     */
    protected abstract function createEntityByFormViewModel($formViewModel);

    protected function parseStringFieldValue($fieldValue) {
        return  $fieldValue;
    }

    protected function parseIntegerFieldValue($fieldValue) {
        return  intval($fieldValue);
    }

    protected function parsePriceFieldValue($fieldValue) {
        return  number_format($fieldValue, 2);
    }

    protected function parseDateFieldValue($fieldValue) {
        return  date("Y-m-d", strtotime($fieldValue));
    }

    protected function parseBooleanFieldValue($fieldValue) {
        return  boolval($fieldValue);
    }

    protected function getConfigFieldName($fieldIdentifier) {
        return  $this->fieldsConfig[$fieldIdentifier]['name'];
    }

    /**
     * @param Request $request
     * @return FormModel
     */
    private function createFormViewModelByRequestInput(Request $request) {
        return $this->formHelper->createAndFillFormModelByConfigurationAndInputRequest(
            $this->formConfig,
            $request);
    }

    protected function getFieldItemModelFromConfiguration(array $fieldConfiguration) {
        return $this->formHelper->getFieldItemModelFromConfiguration($fieldConfiguration);
    }


}
