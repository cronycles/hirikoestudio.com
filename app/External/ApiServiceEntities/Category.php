<?php

namespace App\External\ApiServiceEntities;

use App\Custom\Translations\ApiServiceEntities\Translation;

class Category {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var Translation[]
     */
    public $nameTranslations;

    public function __construct() {
        $this->nameTranslations = [];
    }

}
