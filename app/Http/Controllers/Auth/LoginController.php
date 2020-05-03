<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\ViewModelsServices\PageViewModelService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @var PageViewModelService
     */
    private $pageViewModelService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageViewModelService $pageViewModelService)
    {
        $this->middleware('guest')->except('logout');

        $this->pageViewModelService = $pageViewModelService;
    }

    public function showLoginForm()
    {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_LOGIN'));
        return view($model->viewPath, compact('model'));
    }
}
