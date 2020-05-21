<?php

namespace App\External\ApiServiceEntities;

class Language {

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

    public function __construct() {
    }

}
