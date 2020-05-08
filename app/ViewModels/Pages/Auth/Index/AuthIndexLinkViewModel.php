<?php

namespace App\ViewModels\Pages\Auth\Index;

class AuthIndexLinkViewModel {

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $text;

    public function __construct($url, $text) {
        $this->url = $url;
        $this->text = $text;

    }

}
