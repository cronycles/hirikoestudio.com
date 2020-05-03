<?php

namespace App\Api;

use App\Custom\CRUD\Api\ICrudApi;
use App\Custom\Sorting\Api\ISortingApi;
use App\Entities\CategoryEntity;
use App\External\ApiServiceEntities\Category;
use App\Custom\Translations\ApiServiceEntities\Translation;
use App\Custom\Cache\Services\CacheService;
use App\Services\MappingService;

class CategoriesApi implements ICrudApi, ISortingApi {

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
     * @param int $maxNumber max number of items requested
     * @return CategoryEntity[]
     */
    public function getCategories($maxNumber = null) {
        $cacheKey = $this->cacheService->generateCacheKey(
            config('custom.cache.api.categories.key'),
            [$maxNumber]
        );
        $serviceOffers = $this->cacheService->getOrCallAndSave(
            $cacheKey,
            config('custom.cache.api.categories.seconds'),
            function () use ($maxNumber) {
                return $this->mainApi->getCategories($maxNumber);
            });

        return $this->mappingService->mapCategories($serviceOffers);
    }

    /**
     * @param int $id id of item requested
     * @return CategoryEntity
     */
    public function getCategoryById($id) {
        $cacheKey = $this->cacheService->generateCacheKey(
            config('custom.cache.api.categories.key'),
            [$id]
        );
        $serviceOffers = $this->cacheService->getOrCallAndSave(
            $cacheKey,
            config('custom.cache.api.categories.seconds'),
            function () use ($id) {
                return $this->mainApi->getCategoryById($id);
            });

        return $this->mappingService->mapCategory($serviceOffers);
    }

    /**
     * @param CategoryEntity $categoryEntity
     * @return bool
     */
    public function storeEntity($categoryEntity) {
        $category = $this->createCategoryServiceEntityFromEntity($categoryEntity);
        return $this->mainApi->storeCategory($category);
    }

    /**
     * @param CategoryEntity $categoryEntity
     * @return bool
     */
    public function updateEntity($categoryEntity) {
        $category = $this->createCategoryServiceEntityFromEntity($categoryEntity);
        return $this->mainApi->updateCategory($category);
    }

    /**
     * @param array[int] $sortedIds
     * @return bool
     */
    public function updateSort(array $sortedIds) {

        return $this->mainApi->updateCategoriesSort($sortedIds);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity(int $id) {

        return $this->mainApi->deleteCategory($id);
    }

    private function createCategoryServiceEntityFromEntity(CategoryEntity $categoryEntity) {
        $outcome = null;
        if ($categoryEntity != null && !empty($categoryEntity->nameTranslations)) {
            $outcome = new Category();
            $outcome->id = $categoryEntity->id;

            foreach ($categoryEntity->nameTranslations as $nameTranslation) {
                $translation = new Translation($nameTranslation->locale, $nameTranslation->value);
                array_push($outcome->nameTranslations, $translation);
            }
        }

        return $outcome;
    }

}
