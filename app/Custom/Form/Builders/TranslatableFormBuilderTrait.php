<?php

namespace App\Custom\Form\Builders;

use App\Custom\Languages\Services\LanguagesService;
use App\Custom\Translations\Entities\TranslationEntity;

trait TranslatableFormBuilderTrait {

    /**
     * @var LanguagesService
     */
    private $languagesService;

    public function __construct(LanguagesService $languagesService) {
        $this->languagesService = $languagesService;
    }

    protected function parseTranslatableFieldValue(string $fieldValue) {
        $outcome = [];
        $languages = $this->languagesService->getAvailableLanguages();
        foreach ($languages as $language) {
            $translationEntity = new TranslationEntity($language->id, $fieldValue);
            array_push($outcome, $translationEntity);
        }

        return $outcome;

    }
}
