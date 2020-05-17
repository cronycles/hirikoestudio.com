<?php

namespace App\ViewModels\Pages\Index;

use App\ViewModels\Pages\PageViewModel;

class IndexViewModel extends PageViewModel{

    /**
     * @var SlideViewModel[]
     */
    public $slides;

    public function __construct() {
        parent::__construct();

        $this->slides = [];
    }

}
