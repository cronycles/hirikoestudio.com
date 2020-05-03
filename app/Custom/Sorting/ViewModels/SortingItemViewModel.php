<?php

namespace App\Custom\Sorting\ViewModels;

class SortingItemViewModel {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * SortingItemViewModel constructor.
     * @param int $id
     * @param string $title
     */
    public function __construct(int $id, string $title) {
        $this->id = $id;
        $this->title = $title;
    }

}
