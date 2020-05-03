<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ViewModelsServices\PageViewModelService;
use Illuminate\Http\Request;

class AuthPagesController extends Controller
{
    /**
     * @var PageViewModelService
     */
    private $pageViewModelService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageViewModelService $pageViewModelService) {
        $this->pageViewModelService = $pageViewModelService;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_INDEX'));
        return view($model->viewPath, compact('model'));
    }
}
