<?php

namespace App\Entities;

use App\Custom\Entities\CustomEntity;
use App\Custom\Translations\Entities\TranslationEntity;

class CategoryEntity extends CustomEntity {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var TranslationEntity[]
     */
    public $nameTranslations;

    public function __construct() {
        $this->nameTranslations = [];
    }

}
