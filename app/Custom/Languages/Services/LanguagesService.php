<?php

namespace App\Custom\Languages\Services;

use App\Custom\Languages\Entities\LanguageEntity;

class LanguagesService {

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $allApplicationLanguages;

    /**
     * @var string
     */
    private $currentLanguageId;

    /**
     * @var bool
     */
    private $isMultilanguageActive;

    public function __construct() {
        $this->allApplicationLanguages = config('custom.languages.locales');
        $this->currentLanguageId = app()->getLocale();
        $this->isMultilanguageActive = config('custom.languages.isActiveMultilang');
    }

    /**
     * @return bool
     */
    public function isMultilanguageActive() {
        return $this->isMultilanguageActive;
    }

    /**
     * @return LanguageEntity[]
     */
    public function getAvailableLanguages() {
        $outcome = [];
        if ($this->isMultilanguageActive()) {
            foreach ($this->allApplicationLanguages as $id => $languageText) {
                $language = new LanguageEntity($id, $languageText);
                $language->isCurrent = $id == $this->currentLanguageId;

                array_push($outcome, $language);

            }
        } else {
            array_push($outcome, $this->getCurrentLanguage());
        }
        return $outcome;
    }

    /**
     * @return LanguageEntity|null
     */
    public function getCurrentLanguage() {
        $outcome = null;
        foreach ($this->allApplicationLanguages as $id => $languageText) {
            if ($id == $this->currentLanguageId) {
                $outcome = new LanguageEntity($id, $languageText);
                break;
            }
        }
        return $outcome;
    }

    /**
     * @param string $languageId
     * @return LanguageEntity|null
     */
    public function getLanguageById($languageId) {
        $outcome = null;
        $availableLanguages = $this->getAvailableLanguages();
        foreach ($availableLanguages as $availableLanguage) {
            if ($availableLanguage->id == $languageId) {
                $outcome = $availableLanguage;
                break;
            }
        }
        return $outcome;
    }


}
