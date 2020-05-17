<?php

namespace App\Http\Controllers;

use App\Custom\Slug\Controllers\SlugController;
use App\ViewModelsServices\PageViewModelService;
use Illuminate\Http\Request;

class PagesController extends SlugController {

    /**
     * @var PageViewModelService
     */
    private $pageViewModelService;

    public function __construct(PageViewModelService $pageViewModelService) {
        $this->pageViewModelService = $pageViewModelService;
    }

    public function index() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.INDEX'));
        return view($model->viewPath, compact('model'));
    }

    public function contact() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.CONTACT'));
        return view($model->viewPath, compact('model'));
    }

    public function projects() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.PROJECTS'));
        return view($model->viewPath, compact('model'));
    }

    public function projectShow($slug) {
        $id = $this->getIdFromSlug($slug);
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.PROJECT_SHOW'), ['id' => $id]);
        return view($model->viewPath, compact('model'));
    }


}
