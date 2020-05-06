<?php

namespace App\Http\ViewComponents\Header\Models;

class HeaderViewModel {

    /**
     * @var HeaderLogoViewModel
     */
    public $logo;

    /**
     * @var HeaderLinkViewModel[]
     */
    public $pageLinks;

    /**
     * @var HeaderLinkViewModel[]
     */
    public $userPageLinks;

    /**
     * @var bool
     */
    public $isMultilanguageActive;

    /**
     * @var HeaderLinkViewModel[]
     */
    public $languageLinks;

    /**
     * @var string
     */
    public $currentLanguage;

    /**
     * @var bool
     */
    public $isUserAuth;

    /**
     * @var HeaderLinkViewModel[]
     */
    public $adminPageLinks;

    /**
     * @var string
     */
    public $userName;

    public function __construct() {
        $this->pageLinks = [];
        $this->userPageLinks = [];
        $this->languageLinks = [];
        $this->adminPageLinks = [];
        $this->isUserAuth = false;
        $this->isMultilanguageActive = false;
    }

}
