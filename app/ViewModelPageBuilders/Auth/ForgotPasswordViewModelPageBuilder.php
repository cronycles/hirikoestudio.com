<?php

namespace App\ViewModelPageBuilders\Auth;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModels\Pages\Auth\ForgotPasswordPageViewModel;
use App\ViewModelsServices\Auth\ForgotPasswordViewModelService;

class ForgotPasswordViewModelPageBuilder extends ViewModelPageBuilder {

    /**
     * @var ForgotPasswordViewModelService
     */
    private $viewModelServices;

    public function __construct(
        ForgotPasswordViewModelService $viewModelService) {

        $this->viewModelServices = $viewModelService;
    }

    public function createNewViewModel() {
        return new ForgotPasswordPageViewModel();
    }

    /**
     * @param ForgotPasswordPageViewModel $pageViewModel
     * @param array $params
     * @return ForgotPasswordPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $pageViewModel->formData = $this->viewModelServices->createViewModelFormData();

        return $pageViewModel;
    }

}
