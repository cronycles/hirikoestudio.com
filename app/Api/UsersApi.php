<?php


namespace App\Api;

use App\Custom\Cache\Services\CacheService;
use App\Entities\UserEntity;
use App\Services\MappingService;

class UsersApi {

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
     * @param int $id
     * @return UserEntity
     */
    public function getUserById(int $id) {
        $cacheKey = $this->cacheService->generateCacheKey(
            config('custom.cache.api.users.key'),
            [$id]
        );
        $UserServiceEntity = $this->cacheService->getOrCallAndSave(
            $cacheKey,
            config('custom.cache.api.users.seconds'),
            function () use ($id) {
                return $this->mainApi->getUserById($id);
            });

        return $this->mappingService->mapUser($UserServiceEntity);
    }

}
