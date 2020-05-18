<?php

namespace App\Http\ViewComponents\Header\Models;

class HeaderSocialLinkViewModel extends HeaderLinkViewModel {

    public $iconClass;

    public function __construct($url, $text, $iconClass) {
        parent::__construct($url, $text, false);
        $this->iconClass = $iconClass;
    }

}
