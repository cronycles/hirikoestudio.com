<?php

namespace App\Http\ViewComponents\Navbar\Components;

use App\Http\ViewComponents\Navbar\Services\NavbarViewModelService;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\View;

class NavbarComponent implements Htmlable {
    protected $service;

    public function __construct(NavbarViewModelService $service) {
        $this->service = $service;
    }

    public function toHtml() {
        $model = $this->service->getModel();
        return view('viewComponents.navbar.index', compact('model'));
    }
}
