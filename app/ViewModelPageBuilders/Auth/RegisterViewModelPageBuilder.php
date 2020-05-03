<?php

namespace App\ViewModelPageBuilders\Auth;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModels\Pages\Auth\RegisterPageViewModel;
use App\ViewModelsServices\Auth\RegisterViewModelService;

class RegisterViewModelPageBuilder extends ViewModelPageBuilder {

    /**
     * @var RegisterViewModelService
     */
    private $viewModelServices;

    public function __construct(
        RegisterViewModelService $viewModelService) {

        $this->viewModelServices = $viewModelService;
    }

    public function createNewViewModel() {
        return new RegisterPageViewModel();
    }

    /**
     * @param RegisterPageViewModel $pageViewModel
     * @param array $params
     * @return RegisterPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $pageViewModel->formData = $this->viewModelServices->createViewModelFormData();

        return $pageViewModel;
    }

}
