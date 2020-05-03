<?php

namespace App\ViewModelPageBuilders\Auth;

use App\ViewModels\Pages\Auth\Index\AuthIndexPageViewModel;

class AuthIndexViewModelPageBuilder extends AuthViewModelPageBuilder {

    public function __construct() {
    }

    public function createNewViewModel() {
        return new AuthIndexPageViewModel();
    }

    /**
     * @param AuthIndexPageViewModel $pageViewModel
     * @param array $params
     * @return AuthIndexPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $pageViewModel->logoutText = __('page-auth-index.logoutText');
        $pageViewModel->logoutUrl = route('logout');


        return $pageViewModel;
    }

}
