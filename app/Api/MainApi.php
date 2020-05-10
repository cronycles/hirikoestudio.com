<?php

namespace App\Api;

use App\External\ApiServiceEntities\Category;
use App\External\ApiServiceEntities\Project;
use App\External\ApiServiceEntities\User;
use App\External\ApiServices\PublicApiService;
use Illuminate\Http\UploadedFile;

class MainApi {

    /**
     * @var PublicApiService
     */
    private $publicApiService;

    public function __construct(
        PublicApiService $publicApiService) {
        $this->publicApiService = $publicApiService;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id) {
        return $this->publicApiService->getUserById($id);
    }

    /**
     * @param int $maxNumber max number of items requested
     * @return Category[]
     */
    public function getCategories($maxNumber = null) {
        return $this->publicApiService->getCategories($maxNumber);
    }

    /**
     * @param int $id id of item requested
     * @return Category
     */
    public function getCategoryById($id) {
        return $this->publicApiService->getCategoryById($id);
    }

    /**
     * @param Category $category
     * @return bool
     */
    public function storeCategory($category) {
        return $this->publicApiService->storeCategory($category);
    }

    /**
     * @param Category $category
     * @return bool
     */
    public function updateCategory($category) {
        return $this->publicApiService->updateCategory($category);
    }

    /**
     * @param array[int] $sortedIds
     * @return bool
     */
    public function updateCategoriesSort(array $sortedIds) {
        return $this->publicApiService->updateCategoriesSort($sortedIds);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id) {
        return $this->publicApiService->deleteCategory($id);
    }

    /**
     * @param int $maxNumber max number of items requested
     * @return Project[]
     */
    public function getProjects($maxNumber = null) {
        return $this->publicApiService->getProjects($maxNumber);
    }

    /**
     * @param int $id id of item requested
     * @return Project
     */
    public function getProjectById($id) {
        return $this->publicApiService->getProjectById($id);
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function storeProject($project) {
        return $this->publicApiService->storeProject($project);
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function updateProject($project) {
        return $this->publicApiService->updateProject($project);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteProject(int $id) {
        return $this->publicApiService->deleteProject($id);
    }

    /**
     * @param array[int] $sortedIds
     * @return bool
     */
    public function updateProjectsSort(array $sortedIds) {
        return $this->publicApiService->updateProjectsSort($sortedIds);
    }

    public function saveProjectImage(int $projectId, UploadedFile $file) {
        return $this->publicApiService->saveProjectImage($projectId, $file);
    }

    /**
     * @param int $projectId
     * @param int $imageId
     * @return bool
     */
    public function deleteProjectImage(int $projectId, int $imageId) {
        return $this->publicApiService->deleteProjectImage($projectId, $imageId);
    }

    /**
     * @param int $projectId
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateProjectImagesSort(int $projectId, array $imagesSortedIds) {
        return $this->publicApiService->updateProjectImagesSort($projectId, $imagesSortedIds);
    }

    /**
     * @param int $projectId
     * @param int $imageId
     * @param bool $value
     * @return bool
     */
    public function changeProjectImageSmallView(int $projectId, int $imageId, bool $value) {
        return $this->publicApiService->changeProjectImageSmallView($projectId, $imageId, $value);
    }

}
