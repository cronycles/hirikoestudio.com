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
        return $this->mainApi->storeProject($project);
    }

    /**
     * @param ProjectEntity $projectEntity
     * @return bool
     */
    public function updateEntity($projectEntity) {
        $project = $this->createProjectServiceEntityFromEntity($projectEntity);
        return $this->mainApi->updateProject($project);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity(int $id) {

        return $this->mainApi->deleteProject($id);
    }

    /**
     * @param array[int] $sortedIds
     * @return bool
     */
    public function updateSort(array $sortedIds) {

        return $this->mainApi->updateProjectsSort($sortedIds);
    }

    public function saveImage(int $projectId, UploadedFile $file) {
        return $this->mainApi->saveProjectImage($projectId, $file);
    }

    /**
     * @param int $projectId
     * @param int $imageId
     * @return bool
     */
    public function deleteImage(int $projectId, int $imageId) {
        return $this->mainApi->deleteProjectImage($projectId, $imageId);
    }

    /**
     * @param int $projectId
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateImagesSort(int $projectId, array $imagesSortedIds) {

        return $this->mainApi->updateProjectImagesSort($projectId, $imagesSortedIds);
    }

    private function createProjectServiceEntityFromEntity(ProjectEntity $projectEntity) {
        $outcome = null;
        if ($projectEntity != null) {
            $outcome = new Project();
            $outcome->id = $projectEntity->id;
            $outcome->category = $projectEntity->category;
            $outcome->isVisible = $projectEntity->isVisible;

            if (!empty($projectEntity->titleTranslations)) {
                foreach ($projectEntity->titleTranslations as $titleTranslation) {
                    $translation = new Translation($titleTranslation->locale, $titleTranslation->value);
                    array_push($outcome->titleTranslations, $translation);
                }

            }

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
