<?php

namespace App\Http\ViewComponents\Footer\Models;

class FooterSocialLinkViewModel  {

    public $url;
    public $text;
    public $iconClass;

    public function __construct($url, $text, $iconClass) {
        $this->url = $url;
        $this->text = $text;
        $this->iconClass = $iconClass;
    }

}
