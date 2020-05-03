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

    public function __construct() {
    }

}
