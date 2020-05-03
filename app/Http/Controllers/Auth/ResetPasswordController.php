<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\ViewModelsServices\PageViewModelService;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @var PageViewModelService
     */
    private $pageViewModelService;

    public function __construct(PageViewModelService $pageViewModelService)
    {
        $this->pageViewModelService = $pageViewModelService;
    }

    public function showResetForm(Request $request, $token = null)
    {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_RESET_PASSWORD'), ['token' => $token, 'email' => $request->email]);
        return view($model->viewPath, compact('model'));
    }
}
