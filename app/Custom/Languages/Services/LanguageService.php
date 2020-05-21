<?php

namespace App\Custom\Languages\Services;

use App\Api\LanguageApi;
use App\Custom\Languages\Entities\LanguageEntity;
use App\Custom\Logging\AppLog;

class LanguageService {

    /**
     * @var LanguageApi
     */
    private $api;

    /**
     * @var bool
     */
    private $isMultilanguageActive;

    public function __construct(
        LanguageApi $api) {
        $this->api = $api;

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
    public function getAllLanguages() {
        $outcome = [];

        $languages = $this->api->getLanguages();
        foreach ($languages as $language) {
            $language = $this->processLanguage($language);
            array_push($outcome, $language);
        }

        return $outcome;
    }

    /**
     * @return LanguageEntity[]
     */
    public function getVisibleLanguages() {
        $outcome = [];
        if ($this->isMultilanguageActive()) {
            $languages = $this->api->getLanguages();
            foreach ($languages as $language) {
                if ($language->isVisible) {
                    $language = $this->processLanguage($language);
                    array_push($outcome, $language);
                }
            }
        } else {
            array_push($outcome, $this->getCurrentLanguage());
        }
        return $outcome;
    }

    /**
     * @return LanguageEntity[]
     */
    public function getAuthVisibleLanguages() {
        $outcome = [];
        if ($this->isMultilanguageActive()) {
            $languages = $this->api->getLanguages();
            foreach ($languages as $language) {
                if ($language->isAuthVisible) {
                    $language = $this->processLanguage($language);
                    array_push($outcome, $language);
                }
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

        $languages = $this->api->getLanguages();
        $currentLanguageCode = $this->getCurrentLanguageCode();
        foreach ($languages as $language) {
            if ($language->code == $currentLanguageCode) {
                $outcome = $language;
                break;
            }
        }
        return $outcome;
    }

    /**
     * @param string $languageCode
     * @return string|null
     */
    public function setCurrentLanguage(string $languageCode) {
        try {
            $outcome = null;

            $language = $this->getVisibleLanguageByCode($languageCode);
            if ($language != null) {
                session(['applocale' => $languageCode]);
                $outcome = $languageCode;
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }

    }

    /**
     * @return string|null
     */
    public function setFallbackLanguage() {
        try {
            $outcome = null;

            $currentLocale = session('applocale');

            if ($currentLocale == null || empty($currentLocale)) {
                $currentLocale = config('app.fallback_locale');
            }
            app()->setLocale($currentLocale);
            return $this->setCurrentLanguage($currentLocale);

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }

    }

    /**
     * @param string $languageCode
     * @return LanguageEntity|null
     */
    public function getVisibleLanguageByCode($languageCode) {
        $outcome = null;
        $availableLanguages = $this->getVisibleLanguages();
        foreach ($availableLanguages as $availableLanguage) {
            if ($availableLanguage->code == $languageCode) {
                $outcome = $availableLanguage;
                break;
            }
        }
        return $outcome;
    }

    /**
     * @return string|null
     */
    private function getCurrentLanguageCode() {
        return app()->getLocale();
    }

    private function processLanguage(LanguageEntity $languageEntity): LanguageEntity {
        $languageEntity->isCurrent = $languageEntity->code == $this->getCurrentLanguageCode();
        return $languageEntity;
    }

}
