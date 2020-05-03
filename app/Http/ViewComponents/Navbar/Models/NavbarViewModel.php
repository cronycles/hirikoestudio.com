<?php

namespace App\Http\ViewComponents\Navbar\Models;

class NavbarViewModel {

    /**
     * @var NavbarLinkViewModel[]
     */
    public $pageLinks;

    /**
     * @var NavbarLinkViewModel[]
     */
    public $userPageLinks;

    /**
     * @var bool
     */
    public $isMultilanguageActive;

    /**
     * @var NavbarLinkViewModel[]
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
     * @var NavbarLinkViewModel[]
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
