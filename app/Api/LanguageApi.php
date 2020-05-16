<?php

namespace App\Api;

use App\Custom\Languages\Entities\LanguageEntity;
use App\Custom\Cache\Services\CacheService;
use App\Services\MappingService;

class LanguageApi{

    /**
     * @var MainApi
     */
    private $mainApi;

    /**
     * @var MappingService
     */
    private $mappingService;

    /**
     * @var CacheService
     */
    private $cacheService;

    public function __construct(
        MainApi $mainApi,
        CacheService $cacheService,
        MappingService $mappingService) {
        $this->mainApi = $mainApi;
        $this->cacheService = $cacheService;
        $this->mappingService = $mappingService;
    }

    /**
     * @return LanguageEntity[]
     */
    public function getLanguages() {
        $cacheKey = $this->cacheService->generateCacheKey(
            config('custom.cache.api.languages.key')
        );
        $serviceOffers = $this->cacheService->getOrCallAndSave(
            $cacheKey,
            config('custom.cache.api.languages.seconds'),
            function () {
                return $this->mainApi->getLanguages();
            });

        return $this->mappingService->mapLanguages($serviceOffers);
    }
}
