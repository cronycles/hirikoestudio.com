<?php

namespace App\Custom\Form\Helpers;

use App\Custom\Form\Models\Fields\HiddenFieldModel;
use App\Custom\Languages\Services\LanguageService;
use App\Custom\Logging\AppLog;
use App\Custom\Form\Models\Fields\CheckboxArrayFieldModel;
use App\Custom\Form\Models\Fields\CheckboxItemFieldModel;
use App\Custom\Form\Models\Fields\DateFieldModel;
use App\Custom\Form\Models\Fields\EmailFieldModel;
use App\Custom\Form\Models\Fields\FieldModel;
use App\Custom\Form\Models\Fields\PasswordFieldModel;
use App\Custom\Form\Models\Fields\PriceFieldModel;
use App\Custom\Form\Models\Fields\SelectboxFieldModel;
use App\Custom\Form\Models\Fields\SelectboxItemFieldModel;
use App\Custom\Form\Models\Fields\TextAreaFieldModel;
use App\Custom\Form\Models\Fields\TextFieldModel;
use App\Custom\Form\Models\Fields\WysiwygAreaFieldModel;
use App\Custom\Translations\Entities\TranslationEntity;

class FieldsHelper {

    /**
     * @var LanguageService
     */
    private $languageService;

    /**
     * @var FieldsConfigurationHelper
     */
    private $fieldsConfigurationHelper;

    function __construct(
        FieldsConfigurationHelper $fieldsConfigurationHelper,
        LanguageService $languageService) {

        $this->fieldsConfigurationHelper = $fieldsConfigurationHelper;
        $this->languageService = $languageService;
    }

    /**
     * @param array $formConfiguration
     * @return FieldModel[]
     */
    public function createEmptyFieldsByConfiguration(array $formConfiguration) {
        $outcome = [];
        $fieldsConfiguration = $formConfiguration['fields'];
        foreach ($fieldsConfiguration as $fieldConfiguration) {
            $fieldViewModel = $this->getFieldModelByConfiguration($fieldConfiguration);
            array_push($outcome, $fieldViewModel);
        }

        return $outcome;
    }

    /**
     * @param array $configuration
     * @param \Illuminate\Http\Request $request
     * @return FieldModel[]
     */
    public function createAndFillFieldsByConfigurationAndInputRequest(array $formConfiguration, \Illuminate\Http\Request $request) {
        $outcome = [];
        $fieldsConfiguration = $formConfiguration['fields'];
        foreach ($fieldsConfiguration as $fieldConfiguration) {
            $fieldViewModel = $this->getFieldModelByConfiguration($fieldConfiguration);
            $fieldViewModel->value = $request->input($fieldConfiguration['name']);
            array_push($outcome, $fieldViewModel);
        }

        return $outcome;
    }

    /**
     * @param array $fieldConfiguration
     * @param string $value
     * @return FieldModel
     */
    private function getFieldModelByConfiguration($fieldConfiguration) {
        try {
            $outcome = null;

            $fieldType = $fieldConfiguration['type'];

            switch ($fieldType) {
                case config('custom.form.field-types.TEXT'):
                    $outcome = $this->getModelForText($fieldConfiguration);
                    break;
                case config('custom.form.field-types.WYSIWYG'):
                    $outcome = $this->getModelForWysiwyg($fieldConfiguration);
                    break;
                case config('custom.form.field-types.TEXT_AREA'):
                    $outcome = $this->getModelForTextArea($fieldConfiguration);
                    break;
                case config('custom.form.field-types.EMAIL'):
                    $outcome = $this->getModelForEmail($fieldConfiguration);
                    break;
                case config('custom.form.field-types.PASSWORD'):
                    $outcome = $this->getModelForPassword($fieldConfiguration);
                    break;
                case config('custom.form.field-types.CHECKBOX'):
                    $outcome = $this->getModelForCheckbox($fieldConfiguration);
                    break;
                case config('custom.form.field-types.PRICE'):
                    $outcome = $this->getModelForPrice($fieldConfiguration);
                    break;
                case config('custom.form.field-types.DATE'):
                    $outcome = $this->getModelForDate($fieldConfiguration);
                    break;
                case config('custom.form.field-types.CHECKBOX_ARRAY'):
                    $outcome = $this->getModelForCheckboxArray($fieldConfiguration);
                    break;
                case config('custom.form.field-types.SELECTBOX'):
                    $outcome = $this->getModelForSelectbox($fieldConfiguration);
                    break;
                case config('custom.form.field-types.HIDDEN'):
                    $outcome = $this->getModelForHidden($fieldConfiguration);
                    break;
            }

            $outcome = $this->fillCommonAttributes($outcome, $fieldConfiguration);

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param array $fieldConfiguration
     * @return CheckboxItemFieldModel|SelectboxItemFieldModel|null
     */
    public function getFieldItemModelFromConfiguration(array $fieldConfiguration) {
        try {
            $outcome = null;

            $fieldType = $fieldConfiguration['type'];

            switch ($fieldType) {
                case config('custom.form.field-types.CHECKBOX_ARRAY'):
                    $outcome = $this->getModelForCheckboxArrayItem();
                    break;
                case config('custom.form.field-types.SELECTBOX'):
                    $outcome = $this->getModelForSelectboxItem();
                    break;
            }

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param string $fieldValue
     * @return TranslationEntity[]
     */
    public function parseTranslatableFieldValue(string $fieldValue) {
        $outcome = [];
        $languages = $this->languageService->getAllLanguages();
        foreach ($languages as $language) {
            $translationEntity = new TranslationEntity($language->code, $fieldValue);
            array_push($outcome, $translationEntity);
        }

        return $outcome;

    }

    /**
     * @param array $configuration
     * @param string $labelText
     * @param string $value
     * @return CheckboxItemFieldModel
     */
    private function getModelForCheckboxArrayItem() {
        try {
            $outcome = new CheckboxItemFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new CheckboxItemFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @param string $labelText
     * @param string $value
     * @return SelectboxItemFieldModel
     */
    private function getModelForSelectboxItem() {
        try {
            $outcome = new SelectboxItemFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new SelectboxItemFieldModel();
        }
    }

    /**
     * @param FieldModel $fieldViewModel
     * @param array $fieldConfiguration
     * @param string $fieldValue
     * @return FieldModel
     */
    private function fillCommonAttributes($fieldViewModel, $fieldConfiguration) {
        $fieldViewModel->name = $fieldConfiguration['name'];
        $fieldViewModel->type = $fieldConfiguration['type'];
        $fieldViewModel->text = __($fieldConfiguration['textKey']);
        $fieldViewModel->value = $this->getFieldDefaultValue($fieldConfiguration);

        $fieldViewModel->errorText = $this->fieldsConfigurationHelper->getErrorTextFromConfiguration($fieldConfiguration);
        $fieldViewModel->validations = $this->fieldsConfigurationHelper->getValidationFromConfiguration($fieldConfiguration);

        return $fieldViewModel;
    }

    /**
     * @param array $fieldConfiguration
     * @param string $fieldValue
     * @return string
     */
    private function getFieldDefaultValue ($fieldConfiguration) {
        $outcome = "";
        if(array_key_exists("default",$fieldConfiguration)){
            $configurationDefaultValue = $fieldConfiguration['default'];
            if($configurationDefaultValue !== null && !empty($configurationDefaultValue)) {
                $outcome = $configurationDefaultValue;
            }
        }
        return $outcome;
    }

    /**
     * @param array $configuration
     * @return TextFieldModel
     */
    private function getModelForText($configuration) {
        try {
            $outcome = new TextFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new TextFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return WysiwygAreaFieldModel
     */
    private function getModelForWysiwyg($configuration) {
        try {
            $outcome = new WysiwygAreaFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new WysiwygAreaFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return TextAreaFieldModel
     */
    private function getModelForTextArea($configuration) {
        try {
            $outcome = new TextAreaFieldModel();
            $outcome->rows = $configuration['rows'];
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new TextAreaFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return EmailFieldModel
     */
    private function getModelForEmail($configuration) {
        try {
            $outcome = new EmailFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new EmailFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return PasswordFieldModel
     */
    private function getModelForPassword($configuration) {
        try {
            $outcome = new PasswordFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new PasswordFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return CheckboxItemFieldModel
     */
    private function getModelForCheckbox($configuration) {
        try {
            $outcome = new CheckboxItemFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new CheckboxItemFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return CheckboxArrayFieldModel
     */
    private function getModelForCheckboxArray($configuration) {
        try {
            $outcome = new CheckboxArrayFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new CheckboxArrayFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return SelectboxFieldModel
     */
    private function getModelForSelectbox($configuration) {
        try {
            $outcome = new SelectboxFieldModel();
            $outcome->zeroValueText = __($configuration['zeroValueKey']);
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new SelectboxFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return PriceFieldModel
     */
    private function getModelForPrice($configuration) {
        try {
            $outcome = new PriceFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new PriceFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return DateFieldModel
     */
    private function getModelForDate($configuration) {
        try {
            $outcome = new DateFieldModel();

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new DateFieldModel();
        }
    }

    /**
     * @param array $configuration
     * @return HiddenFieldModel
     */
    private function getModelForHidden($configuration) {
        try {
            $outcome = new HiddenFieldModel();
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return new HiddenFieldModel();
        }
    }

}
