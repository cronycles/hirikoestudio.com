<?php

namespace App\ViewModels\Pages;

class BreadcrumbViewModel {

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $url;

    /**
     * BreadcrumbViewModel constructor.
     * @param $name
     * @param $url
     */
    public function __construct($name, $url) {
        $this->name = $name;
        $this->url = $url;
    }

}
