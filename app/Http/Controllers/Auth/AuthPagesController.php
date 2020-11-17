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

    public function categories() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_CATEGORIES'));
        return view($model->viewPath, compact('model'));
    }

    public function homeSlides() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_HOME_SLIDES'));
        return view($model->viewPath, compact('model'));
    }

    public function categoryCreate() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_CATEGORY_CREATE'));
        return view($model->viewPath, compact('model'));
    }

    public function categoryEdit($categoryId) {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_CATEGORY_EDIT'), ['id' => $categoryId]);
        return view($model->viewPath, compact('model'));
    }

    public function categoriesSort() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_CATEGORIES_SORT'));
        return view($model->viewPath, compact('model'));
    }

    public function projects() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_PROJECTS'));
        return view($model->viewPath, compact('model'));
    }

    public function projectCreate() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_PROJECT_CREATE'));
        return view($model->viewPath, compact('model'));
    }

    public function projectEdit($projectId) {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_PROJECT_EDIT'), ['id' => $projectId]);
        return view($model->viewPath, compact('model'));
    }

    public function projectsSort() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_PROJECTS_SORT'));
        return view($model->viewPath, compact('model'));
    }

    public function projectImages($projectId) {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.AUTH_PROJECT_IMAGES'), ['id' => $projectId]);
        return view($model->viewPath, compact('model'));
    }
}
