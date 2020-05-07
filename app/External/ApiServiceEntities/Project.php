<?php

namespace App\External\ApiServiceEntities;

use App\Custom\Translations\ApiServiceEntities\Translation;
use App\Entities\CategoryEntity;

class Project {

    /**
     * @var int
     */
    public $id;

    /**
     * @var CategoryEntity
     */
    public $category;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var Translation[]
     */
    public $descriptionTranslations;

    /**
     * @var bool
     */
    public $isVisible;

    /**
     * @var Image[]
     */
    public $images;

    public function __construct() {
        $this->images = [];
        $this->descriptionTranslations = [];
        $this->category = new CategoryEntity();
    }

}
