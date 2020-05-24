<?php

namespace App\Http\ViewComponents\CookieConsent\Services;

use App\Http\ViewComponents\CookieConsent\Models\CookieConsentViewModel;

class CookieConsentViewModelService {

    public function __construct() {
    }

    public function getModel() {
        $outcome = new CookieConsentViewModel();
        $outcome->text = __('cookie-consent.text');
        $outcome->acceptButtonText = __('cookie-consent.acceptButtonText');
        $outcome->seeMoreText = __('cookie-consent.seeMoreText');
        $outcome->seeMoreLink = route('cookie');

        return $outcome;
    }
}
