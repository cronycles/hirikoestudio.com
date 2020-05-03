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

    public function __construct() {
        parent::__construct();

    }

}
