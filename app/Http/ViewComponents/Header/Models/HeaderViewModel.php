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
    public $socialLinks;

    /**
     * @var HeaderLinkViewModel[]
     */
    public $userPageLinks;

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

    /**
     * @var bool
     */
    public $hasInvertedColors;

    public function __construct() {
        $this->pageLinks = [];
        $this->socialLinks = [];
        $this->userPageLinks = [];
        $this->languageLinks = [];
        $this->adminPageLinks = [];
        $this->isUserAuth = false;
        $this->hasInvertedColors = false;
    }

}
