<?php

namespace App\Entities;

use App\Custom\Entities\CustomEntity;

class ImageEntity extends CustomEntity {

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
