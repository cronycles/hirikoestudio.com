<?php

namespace App\Custom\Sorting\ViewModels;

trait SortingPageViewModelTrait  {

    /**
     * @var SortingViewModel
     */
    public $sorting;

    public function __construct() {
        $this->sorting = new SortingViewModel();
    }

}
