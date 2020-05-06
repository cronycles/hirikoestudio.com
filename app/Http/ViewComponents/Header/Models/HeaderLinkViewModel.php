<?php

namespace App\Http\ViewComponents\Header\Models;

class HeaderLinkViewModel {

    public $url;
    public $text;
    public $isActive;

    public function __construct($url, $text, $isActive) {
        $this->url = $url;
        $this->text = $text;
        $this->isActive = $isActive;
    }

}
