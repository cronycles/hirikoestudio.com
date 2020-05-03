<?php

namespace App\ViewModels\Categories;

class CategoryViewModel {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $isActive;

    public function __construct() {
        $this->isActive = false;
    }

}



