<?php

namespace App\Custom\Languages\Middleware;

use App\Custom\Languages\Services\LanguageService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait LanguageMiddlewareTrait {

    /**
     * @var LanguageService
     */
    private $languageService;

    public function __construct(LanguageService $languageService) {
        $this->languageService = $languageService;
    }

    public function handle(Request $request, Closure $next) {
        // Check if the first segment matches a language code

        if ($this->languageService->isMultilanguageActive()) {

            $langId = $request->segment(1);

            if ($langId == null) {
                $fallbackLanguageCode = $this->setFallbackLanguage();
                return $this->createLanguageFallbackRedirect($request, $fallbackLanguageCode);

            } else {
                $languageCode = $this->languageService->setCurrentLanguage($langId);
                if ($languageCode == null) {
                    $fallbackLanguageCode = $this->setFallbackLanguage();
                    return $this->createLanguageFallbackRedirect($request, $fallbackLanguageCode);
                }
            }

        }
        else {
            $this->setFallbackLanguage();
        }
        return $next($request);
    }

    private function setFallbackLanguage() {
        $outcome = null;
        $outcome = $this->languageService->setFallbackLanguage();
        return $outcome;
    }

    private function createLanguageFallbackRedirect(Request $request, $fallbackLanguageCode) {
        // Store segments in array
        $segments = $request->segments();

        // Set the default language code as the first segment
        $segments = Arr::prepend($segments, $fallbackLanguageCode);

        // Redirect to the correct url
        return redirect()->to(implode('/', $segments));
    }

}
