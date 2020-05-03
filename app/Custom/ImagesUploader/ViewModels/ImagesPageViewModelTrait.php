<?php

namespace App\Custom\ImagesUploader\ViewModels;

trait ImagesPageViewModelTrait  {

    /**
     * @var ImagesUploaderViewModel
     */
    public $imageUploader;

    public function __construct() {
        $this->imageUploader = new ImagesUploaderViewModel();
    }

}
