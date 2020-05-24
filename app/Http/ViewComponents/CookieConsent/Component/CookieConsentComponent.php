<?php

namespace App\Http\ViewComponents\CookieConsent\Component;

use App\Http\ViewComponents\CookieConsent\Services\CookieConsentViewModelService;
use Illuminate\Contracts\Support\Htmlable;

class CookieConsentComponent implements Htmlable {
    protected $service;

    public function __construct(CookieConsentViewModelService $service) {
        $this->service = $service;
    }

    public function toHtml() {
        $model = $this->service->getModel();
        return view('viewComponents.cookie-consent.index', compact('model'));
    }
}
