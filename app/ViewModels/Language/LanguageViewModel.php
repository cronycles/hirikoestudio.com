<?php

namespace App\ViewModels\Language;

class LanguageViewModel {

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $cultureCode;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $isDefault;

    /**
     * @var bool
     */
    public $isEnabled;

    /**
     * @var bool
     */
    public $isVisible;

    /**
     * @var bool
     */
    public $isAuthVisible;

    /**
     * @var bool
     */
    public $isCurrent;

    public function __construct() {
    }
}
