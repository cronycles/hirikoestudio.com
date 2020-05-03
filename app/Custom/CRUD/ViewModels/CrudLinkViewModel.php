<?php

namespace App\Custom\CRUD\ViewModels;

class CrudLinkViewModel{

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $url;

    public function __construct(string $urlLink, string $textLink) {
        $this->url = $urlLink;
        $this->text = $textLink;
    }
}
