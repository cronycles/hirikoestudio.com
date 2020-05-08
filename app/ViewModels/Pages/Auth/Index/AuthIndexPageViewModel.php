<?php

namespace App\ViewModels\Pages\Auth\Index;

use App\ViewModels\Pages\Auth\AuthPageViewModel;

class AuthIndexPageViewModel extends AuthPageViewModel {

    /**
     * @var string
     */
    public $logoutUrl;

    /**
     * @var string
     */
    public $logoutText;

    /**
     * @var AuthIndexLinkViewModel[]
     */
    public $links;

    public function __construct() {
        parent::__construct();
        $this->links = [];
    }

}
