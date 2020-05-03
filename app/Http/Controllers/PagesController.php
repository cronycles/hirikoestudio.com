<?php

namespace App\Http\Controllers;

use App\ViewModelsServices\PageViewModelService;
use Illuminate\Http\Request;

class PagesController extends Controller {

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
}
