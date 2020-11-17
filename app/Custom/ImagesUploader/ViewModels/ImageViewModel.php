<?php

namespace App\Custom\ImagesUploader\ViewModels;

class ImageViewModel {

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

    /**
     * @var bool
     */
    public $isMobile;

    public function __construct() {
        $this->isSmallViewEnabled = false;
        $this->isMobile = false;
    }

}
