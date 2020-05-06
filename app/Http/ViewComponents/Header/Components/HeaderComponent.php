<?php

namespace App\Http\ViewComponents\Header\Components;

use App\Http\ViewComponents\Header\Services\HeaderViewModelService;
use Illuminate\Contracts\Support\Htmlable;

class HeaderComponent implements Htmlable {
    protected $service;

    public function __construct(HeaderViewModelService $service) {
        $this->service = $service;
    }

    public function toHtml() {
        $model = $this->service->getModel();
        return view('viewComponents.header.header', compact('model'));
    }
}
