<?php

namespace App\Http\ViewComponents\Footer\Component;

use App\Http\ViewComponents\Footer\Services\FooterViewModelService;
use Illuminate\Contracts\Support\Htmlable;

class FooterComponent implements Htmlable {
    protected $service;

    public function __construct(FooterViewModelService $service) {
        $this->service = $service;
    }

    public function toHtml() {
        $model = $this->service->getModel();
        return view('viewComponents.footer._footer', compact('model'));
    }
}
