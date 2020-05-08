<?php

namespace App\ViewModelPageBuilders\Auth;

use App\ViewModels\Pages\Auth\Index\AuthIndexLinkViewModel;
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

        $categoriesLink = new AuthIndexLinkViewModel(route('auth.categories'), __('page-auth-index.list.manage-categories'));
        $projectsLink = new AuthIndexLinkViewModel(route('auth.projects'), __('page-auth-index.list.manage-projects'));

        $pageViewModel->logoutText = __('page-auth-index.logoutText');
        $pageViewModel->logoutUrl = route('logout');

        $pageViewModel->links = [$categoriesLink, $projectsLink];

        return $pageViewModel;
    }

}
