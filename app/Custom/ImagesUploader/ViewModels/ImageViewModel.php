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

    public function __construct() {
    }

}
