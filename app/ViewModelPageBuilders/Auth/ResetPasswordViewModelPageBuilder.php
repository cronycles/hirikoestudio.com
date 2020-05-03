<?php

namespace App\ViewModelPageBuilders\Auth;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModels\Pages\Auth\ResetPasswordPageViewModel;
use App\ViewModelsServices\Auth\ResetPasswordViewModelService;

class ResetPasswordViewModelPageBuilder extends ViewModelPageBuilder {

    /**
     * @var ResetPasswordViewModelService
     */
    private $viewModelServices;

    public function __construct(
        ResetPasswordViewModelService $viewModelService) {

        $this->viewModelServices = $viewModelService;
    }

    public function createNewViewModel() {
        return new ResetPasswordPageViewModel();
    }

    /**
     * @param ResetPasswordPageViewModel $pageViewModel
     * @param array $params
     * @return ResetPasswordPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $token = $params['token'];
        $email = $params['email'];

        $pageViewModel->formData = $this->viewModelServices->createViewModelFormData($token, $email);

        return $pageViewModel;
    }

}
