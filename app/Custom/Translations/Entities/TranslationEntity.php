<?php

namespace App\Custom\Translations\Entities;

class TranslationEntity {

    /**
     * @var string
     */
    public $locale;

    /**
     * @var string
     */
    public $value;

    public function __construct($locale, $value) {
        $this->locale = $locale;
        $this->value = $value;

    }
}
