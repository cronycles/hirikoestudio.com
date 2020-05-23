<?php

namespace App\Custom\Routes\ViewModelServices;

use App\Custom\Languages\Services\LanguageService;
use App\ViewModels\Pages\RouteUrlViewModel;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class RoutesViewModelService {

    /**
     * @var LanguageService
     */
    private $languageService;


    function __construct(
        LanguageService $languageService) {

        $this->languageService = $languageService;
    }

    /**
     * @return RouteUrlViewModel
     */
    public function getCanonicalRouteUrl() {
        $outcome = new RouteUrlViewModel();
        $outcome->url = url()->current();
        $outcome->rel = "canonical";
        return $outcome;
    }

    /**
     * @return RouteUrlViewModel[]
     */
    public function getHreflangUrls() {
        $outcome = [];
        if ($this->languageService->isMultilanguageActive()) {

            $currentRouteName = Route::currentRouteName();

            $AllPossibleTranslatableRoutesInCurrentLanguage = Lang::get('routes');

            $translatableRouteKey = "";
            foreach ($AllPossibleTranslatableRoutesInCurrentLanguage as $possibleTranslatableRouteInCurrentLanguageKey => $value) {
                if ($possibleTranslatableRouteInCurrentLanguageKey == $currentRouteName) {
                    $translatableRouteKey = $possibleTranslatableRouteInCurrentLanguageKey;
                    break;
                }
            }

            if (!empty($translatableRouteKey)) {
                $visibleLanguages = $this->languageService->getVisibleLanguages();
                foreach ($visibleLanguages as $visibleLanguage) {
                    $alternativeRoute = Lang::get('routes.' . $translatableRouteKey, [], $visibleLanguage->code);
                    if (!empty($alternativeRoute)) {
                        $alternativeFullUrlWithParameterKeys = url('/') . "/" . $visibleLanguage->code . "/" . $alternativeRoute;
                    } else {
                        //questo caso si contempla per la pagina index, cosí gli togliamo lo slash finale
                        $alternativeFullUrlWithParameterKeys = url('/') . "/" . $visibleLanguage->code;
                    }

                    $currentRouteParameters = Route::current()->parameters;
                    $alternativeFullUrl = "";
                    if ($currentRouteParameters != null && !empty($currentRouteParameters)) {
                        foreach ($currentRouteParameters as $currentRouteParameterKey => $currentRouteParameterValue) {
                            $parameterKeyWithGraphs = "{" . $currentRouteParameterKey . "}";
                            $alternativeFullUrl = str_replace($parameterKeyWithGraphs, $currentRouteParameterValue, $alternativeFullUrlWithParameterKeys);
                        }
                    } else {
                        $alternativeFullUrl = $alternativeFullUrlWithParameterKeys;
                    }
                    if (isset($alternativeFullUrl)) {
                        $hrefLang = new RouteUrlViewModel();
                        $hrefLang->rel = "alternate";
                        $hrefLang->url = $alternativeFullUrl;
                        $hrefLang->languageCode = $visibleLanguage->code;
                        array_push($outcome, $hrefLang);
                        if ($visibleLanguage->isCurrent) {
                            $xDefaultHrefLang = clone $hrefLang;
                            $xDefaultHrefLang->languageCode = "x-default";
                            array_push($outcome, $xDefaultHrefLang);
                        }
                    }
                }
            }
        }

        return $outcome;
    }

}
