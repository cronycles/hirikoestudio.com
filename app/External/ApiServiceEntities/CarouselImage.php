<?php

namespace App\External\ApiServiceEntities;

use App\Custom\Translations\ApiServiceEntities\Translation;
use App\Entities\CategoryEntity;

class CarouselImage {

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
     * @var Image
     */
    public $image;

}
