<?php

namespace App\Api;

use App\Custom\CRUD\Api\ICrudApi;
use App\Custom\ImagesUploader\Api\IImagesUploaderApi;
use App\Custom\Sorting\Api\ISortingApi;
use App\Custom\Translations\ApiServiceEntities\Translation;
use App\Entities\ProjectEntity;
use App\External\ApiServiceEntities\Project;
use App\Custom\Cache\Services\CacheService;
use App\Services\MappingService;
use Illuminate\Http\UploadedFile;

class ProjectsApi implements ICrudApi, ISortingApi, IImagesUploaderApi {

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
     * @return ProjectEntity[]
     */
    public function getProjects($maxNumber = null) {
        $cacheKey = $this->cacheService->generateCacheKey(
            config('custom.cache.api.projects.key'),
            [$maxNumber]
        );
        $serviceProjects = $this->cacheService->getOrCallAndSave(
            $cacheKey,
            config('custom.cache.api.projects.seconds'),
            function () use ($maxNumber) {
                return $this->mainApi->getProjects($maxNumber);
            });

        return $this->mappingService->mapProjects($serviceProjects);
    }

    /**
     * @param int $id id of item requested
     * @return ProjectEntity
     */
    public function getProjectById($id) {
        $cacheKey = $this->cacheService->generateCacheKey(
            config('custom.cache.api.projects.key'),
            [$id]
        );
        $serviceOffers = $this->cacheService->getOrCallAndSave(
            $cacheKey,
            config('custom.cache.api.projects.seconds'),
            function () use ($id) {
                return $this->mainApi->getProjectById($id);
            });

        return $this->mappingService->mapProject($serviceOffers);
    }

    /**
     * @param ProjectEntity $projectEntity
     * @return bool
     */
    public function storeEntity($projectEntity) {
        $project = $this->createProjectServiceEntityFromEntity($projectEntity);
        $outcome = $this->mainApi->storeProject($project);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param ProjectEntity $projectEntity
     * @return bool
     */
    public function updateEntity($projectEntity) {
        $project = $this->createProjectServiceEntityFromEntity($projectEntity);
        $outcome = $this->mainApi->updateProject($project);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity(int $id) {
        $outcome = $this->mainApi->deleteProject($id);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param array[int] $sortedIds
     * @return bool
     */
    public function updateSort(array $sortedIds) {
        $outcome = $this->mainApi->updateProjectsSort($sortedIds);
        $this->cacheService->clearCache();
        return $outcome;
    }

    public function saveImage(int $projectId, UploadedFile $file) {
        $outcome = $this->mainApi->saveProjectImage($projectId, $file);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param int $projectId
     * @param int $imageId
     * @return bool
     */
    public function deleteImage(int $projectId, int $imageId) {
        $outcome = $this->mainApi->deleteProjectImage($projectId, $imageId);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param int $projectId
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateImagesSort(int $projectId, array $imagesSortedIds) {
        $outcome = $this->mainApi->updateProjectImagesSort($projectId, $imagesSortedIds);
        $this->cacheService->clearCache();
        return $outcome;
    }

    /**
     * @param int $projectId
     * @param int $imageId
     * @param bool $value
     * @return bool
     */
    public function changeSmallView(int $projectId, int $imageId, bool $value = true) {
        $outcome = $this->mainApi->changeProjectImageSmallView($projectId, $imageId, $value);
        $this->cacheService->clearCache();
        return $outcome;
    }

    private function createProjectServiceEntityFromEntity(ProjectEntity $projectEntity) {
        $outcome = null;
        if ($projectEntity != null) {
            $outcome = new Project();
            $outcome->id = $projectEntity->id;
            $outcome->category = $projectEntity->category;
            $outcome->title = $projectEntity->title;
            $outcome->isVisible = $projectEntity->isVisible;
            $outcome->isVisibleInHomepage = $projectEntity->isVisibleInHomepage;

            if (!empty($projectEntity->descriptionTranslations)) {
                foreach ($projectEntity->descriptionTranslations as $titleTranslation) {
                    $translation = new Translation($titleTranslation->locale, $titleTranslation->value);
                    array_push($outcome->descriptionTranslations, $translation);
                }

            }
        }

        return $outcome;
    }


}
