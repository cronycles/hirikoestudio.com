<?php

namespace App\Custom\Form\Requests;

use App\Custom\Languages\Services\LanguageService;

abstract class TranslatableFieldsRequest extends FieldsRequest {

    /**
     * @var LanguageService
     */
    private $languageService;

    public function __construct(LanguageService $languageService) {
        parent::__construct();

        $this->languageService = $languageService;
    }

    /**
     * @param string $configurationKey
     * @return array
     */
    public function getRulesByConfigurationFields($configurationKey) {
        $outcome = [];

        $fieldsArray = config($configurationKey);

        foreach ($fieldsArray as $field) {
            if (array_key_exists('translatable', $field) && $field['translatable'] == true) {
                $authVisibleLanguages = $this->languageService->getAuthVisibleLanguages();
                foreach ($authVisibleLanguages as $authVisibleLanguage) {
                    $translatableFieldName = $field['name'] . "_" . $authVisibleLanguage->code;
                    $outcome[$translatableFieldName] = $this->processValidations($field['validations']);
                }
            } else {
                $outcome[$field['name']] = $this->processValidations($field['validations']);
            }
        }

        return $outcome;
    }

}
