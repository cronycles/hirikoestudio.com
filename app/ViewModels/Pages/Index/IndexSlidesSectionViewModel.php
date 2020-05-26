<?php

namespace App\ViewModels\Pages\Index;

class IndexSlidesSectionViewModel {

    /**
     * @var SlideViewModel[]
     */
    public $slides;

    public function __construct() {
        $this->slides = [];

    }

}
