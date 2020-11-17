<?php

namespace App\Api;

use App\Custom\ImagesUploader\Api\IImagesUploaderApi;
use App\Entities\CarouselImageEntity;
use App\Custom\Cache\Services\CacheService;
use App\Services\MappingService;
use Illuminate\Http\UploadedFile;

class CarouselImagesApi implements IImagesUploaderApi {

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
     * @return CarouselImageEntity[]
     */
    public function getCarouselImages() {
        $cacheKey = $this->cacheService->generateCacheKey(
            config('custom.cache.api.slides.key')
        );
        $serviceEntities = $this->cacheService->getOrCallAndSave(
            $cacheKey,
            config('custom.cache.api.slides.seconds'),
            function () {
                return $this->mainApi->getCarouselImages();
            });

        return $this->mappingService->mapCarouselImages($serviceEntities);
    }

    public function saveImage(UploadedFile $file, int $entityId = null) {
        $outcome = $this->mainApi->saveHomeSlidesImage($file);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param int $imageId
     * @param int|null $entityId
     * @return bool
     */
    public function deleteImage(int $imageId, int $entityId = null) {
        $outcome = $this->mainApi->deleteHomeSlidesImage($imageId);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param int|null $entityId
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateImagesSort(array $imagesSortedIds, int $entityId = null) {
        $outcome = $this->mainApi->updateHomeSlidesImagesSort($imagesSortedIds);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param int $imageId
     * @param bool $value
     * @param int|null $entityId
     * @return bool
     */
    public function changeSmallView(int $imageId, bool $value = true, int $entityId = null) {
        return false;
    }

    /**
     * @param int $imageId
     * @param bool $value
     * @param int|null $entityId
     * @return bool
     */
    public function changeIsMobileProperty(int $imageId, bool $value = true, int $entityId = null) {
        $outcome = $this->mainApi->changeHomeSlidesIsMobileProperty($imageId, $value);
        $this->cacheService->clearCache();
        return $outcome;
    }
}
