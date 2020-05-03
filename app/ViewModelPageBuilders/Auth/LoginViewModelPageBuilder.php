<?php

namespace App\ViewModelPageBuilders\Auth;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModels\Pages\Auth\LoginPageViewModel;
use App\ViewModelsServices\Auth\LoginViewModelService;

class LoginViewModelPageBuilder extends ViewModelPageBuilder {

    /**
     * @var LoginViewModelService
     */
    private $viewModelServices;

    public function __construct(
        LoginViewModelService $viewModelService) {

        $this->viewModelServices = $viewModelService;
    }

    public function createNewViewModel() {
        return new LoginPageViewModel();
    }

    /**
     * @param LoginPageViewModel $pageViewModel
     * @param array $params
     * @return LoginPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $pageViewModel->forgotPasswordText = __('page-auth-login.forgot-password');
        $pageViewModel->forgotPasswordUrl = route('password.request');

        $pageViewModel->formData = $this->viewModelServices->createViewModelFormData();

        return $pageViewModel;
    }

}
