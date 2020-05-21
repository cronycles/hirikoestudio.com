<?php

namespace App\Custom\Languages\Entities;

class LanguageEntity {

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
