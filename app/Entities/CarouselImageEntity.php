<?php

namespace App\Entities;

use App\Custom\Entities\CustomEntity;

class CarouselImageEntity extends CustomEntity {

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $orderNumber;

    /**
     * @var boolean
     */
    public $isMobile;

    /**
     * @var ImageEntity
     */
    public $image;

}
