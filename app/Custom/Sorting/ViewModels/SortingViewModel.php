<?php

namespace App\Custom\Sorting\ViewModels;

class SortingViewModel {

    /**
     * @var array(SortingItemViewModel)
     */
    public $items;

    /**
     * @var string
     */
    public $updateUrl;

    public function __construct() {
        $this->items = [];
    }

}
