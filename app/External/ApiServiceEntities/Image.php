<?php

namespace App\External\ApiServiceEntities;

class Image {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;

    /**
     * @var bool
     */
    public $isSmallViewEnabled;

    public function __construct() {
        $this->isSmallViewEnabled = false;
    }

}
