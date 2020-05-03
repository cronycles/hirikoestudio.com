<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ViewModelsServices\PageViewModelService;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * @var PageViewModelService
     */
    private $pageViewModelService;

    public function __construct(PageViewModelService $pageViewModelService) {
        $this->pageViewModelService = $pageViewModelService;
    }

    public function showLinkRequestForm()
    {
        $model = $this->pageViewModelService->getViewModelByConfigurationKey('custom.pages.auth.forgot-password');
        return view($model->viewPath, compact('model'));
    }
}
