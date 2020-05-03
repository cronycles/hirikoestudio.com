<?php

namespace App\Custom\Languages\Middleware;

use App\Custom\Languages\Services\LanguagesService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait LanguageMiddlewareTrait {

    /**
     * @var LanguagesService
     */
    private $languagesService;

    public function __construct(LanguagesService $languagesService) {
        $this->languagesService = $languagesService;
    }

    public function handle(Request $request, Closure $next) {
        // Check if the first segment matches a language code

        if($this->languagesService->isMultilanguageActive()) {

            $langId = $request->segment(1);

            $languageEntity = $this->languagesService->getLanguageById($langId);

            if ($languageEntity == null) {

                // Store segments in array
                $segments = $request->segments();

                $currentLocale = $request->session()->get('applocale');

                if($currentLocale == null || empty($currentLocale)) {
                    $currentLocale = config('app.fallback_locale');
                }

                // Set the default language code as the first segment
                $segments = Arr::prepend($segments, $currentLocale);

                // Redirect to the correct url
                return redirect()->to(implode('/', $segments));
            }
            else {
                $request->session()->put('applocale', $langId);
            }

        }
        return $next($request);
    }

}
