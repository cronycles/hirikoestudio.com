<?php

namespace App\Http\ViewComponents\Footer\Models;

class FooterViewModel {

    /**
     * @var LogoViewModel
     */
    public $logo;

    /**
     * @var ContactsViewModel
     */
    public $contacts;

    /**
     * @var FooterSocialLinkViewModel[]
     */
    public $socials;

    /**
     * @var SubFooterViewModel
     */
    public $sub;
}
