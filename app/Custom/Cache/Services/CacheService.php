<?php

namespace App\Custom\Cache\Services;

use App\Custom\Logging\AppLog;
use App\Custom\Logging\Services\LoggingService;
use Illuminate\Support\Facades\Cache;

class CacheService {

    function __construct() {
    }

    /**
     * ritorna la chiave di cache secondo la lista di parametri passati.
     * si usa per creare una cache key in base ai parametri passati
     *
     * @param $defaultCacheKey string
     * @param $paramList array
     * @return string
     */
    public function generateCacheKey($defaultCacheKey, $paramList = []) {
        try {
            $outcome = $defaultCacheKey;
            if ($paramList != null && !empty($paramList)) {
                foreach ($paramList as $param) {
                    if ($param != null) {
                        $outcome = $outcome . "-" . $param;
                    }
                }
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * ritorna un elemento della cache in base alla key.
     * Se non lo trova o chiama la funzione di fallback e salva l'elemento in cache automaticamente
     *
     * @param $cacheKey string
     * @param $seconds int se non si passano i secondi si salverá l'oggetto nella cache per sempre
     * @param $fallbackFunction
     * @return mixed
     */
    public function getOrCallAndSave($cacheKey, $seconds, $fallbackFunction) {
        try {
            if(config('custom.cache.isEnabled')) {
                if ($cacheKey != null) {
                    if ($fallbackFunction != null) {
                        if ($seconds != null) {
                            return Cache::remember($cacheKey, $seconds, $fallbackFunction);
                        }
                        return Cache::rememberForever($cacheKey, $fallbackFunction);
                    } else {
                        AppLog::errorMessage("no fallback function provided");
                        return null;
                    }
                } else {
                    AppLog::errorMessage("no cache key provided");
                    return $fallbackFunction();
                }
            }
            else {
                return $fallbackFunction();
            }
        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }

    }

}
