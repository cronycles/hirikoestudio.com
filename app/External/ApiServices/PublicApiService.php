<?php

namespace App\External\ApiServices;

use App\Custom\ImagesUploader\Helpers\ImagesHelper;
use App\Custom\Logging\AppLog;
use App\Custom\Translations\ApiServiceEntities\Translation;
use App\External\ApiServiceEntities\Category;
use App\External\ApiServiceEntities\Project;
use App\External\ApiServiceEntities\User;
use App\External\Repositories\CategoriesRepository;
use App\External\Repositories\ImagesRepository;
use App\External\Repositories\ProjectsRepository;
use App\External\Repositories\UsersRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class PublicApiService {

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * @var ProjectsRepository
     */
    private $projectsRepository;

    /**
     * @var CategoriesRepository
     */
    private $categoriesRepository;

    /**
     * @var ImagesRepository
     */
    private $imagesRepository;

    /**
     * @var ImagesHelper
     */
    private $imageService;

    public function __construct(
        UsersRepository $usersRepository,
        ProjectsRepository $projectsRepository,
        CategoriesRepository $categoriesRepository,
        ImagesRepository $imagesRepository,
        ImagesHelper $imageService) {

        $this->usersRepository = $usersRepository;
        $this->projectsRepository = $projectsRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->imagesRepository = $imagesRepository;
        $this->imageService = $imageService;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId) {
        try {
            $outcome = null;

            if ($userId != null && $userId > 0) {
                /** @var \App\User $dbUser */
                $dbUser = $this->usersRepository->find($userId);
                $outcome = $this->createUserEntityByDbEntity($dbUser);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param $maxNumber int max number of services requested
     * @return Category[]
     */
    public function getCategories($maxNumber = null) {
        try {
            $outcome = [];

            /** @var array $dbCategories */
            $dbCategories = $maxNumber != null
                ? $this->categoriesRepository->all()->take($maxNumber)
                : $this->categoriesRepository->all();

            if ($dbCategories != null && !empty($dbCategories)) {
                /** @var \App\Category $dbCategory */
                foreach ($dbCategories as $dbCategory) {
                    $entity = $this->createCategoryEntityByDbEntity($dbCategory);
                    if ($entity != null) {
                        array_push($outcome, $entity);
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
     * @param $id int id of category requested
     * @return Category
     */
    public function getCategoryById($id) {
        try {
            $outcome = null;

            if ($id != null && $id > 0) {
                /** @var \App\Category $dbCategory */
                $dbCategory = $this->categoriesRepository->find($id);
                $outcome = $this->createCategoryEntityByDbEntity($dbCategory);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    public function storeCategory(Category $categoryEntity) {
        $outcome = false;
        $category = $this->createDbCategoryEntityByServiceEntity($categoryEntity);
        if ($category != null) {
            $outcome = $category->save();
        }
        return $outcome;
    }

    public function updateCategory(Category $categoryEntity) {
        $outcome = false;
        $category = $this->createDbCategoryEntityByServiceEntity($categoryEntity);
        if ($category != null) {
            $outcome = $category->update();
        }
        return $outcome;
    }

    public function deleteCategory(int $id) {
        return $this->categoriesRepository->destroy($id);
    }

    /**
     * @param array[int] $sortedIds
     */
    public function updateCategoriesSort(array $sortedIds) {
        return $this->categoriesRepository->updateSort($sortedIds);
    }

    /**
     * @param $maxNumber int max number of services requested
     * @return Project[]
     */
    public function getProjects($maxNumber = null) {
        try {
            $outcome = [];

            $dbProjects = $maxNumber != null
                ? $this->projectsRepository->all()->take($maxNumber)
                : $this->projectsRepository->all();

            if ($dbProjects != null && !empty($dbProjects)) {
                /** @var \App\Project $dbProject */
                foreach ($dbProjects as $dbProject) {
                    $entity = $this->createProjectEntityByDbEntity($dbProject);
                    if ($entity != null) {
                        array_push($outcome, $entity);
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
     * @param $id int id of project requested
     * @return Project
     */
    public function getProjectById($id) {
        try {
            $outcome = null;

            if ($id != null && $id > 0) {
                /** @var \App\Project $dbProject */
                $dbProject = $this->projectsRepository->find($id);
                $outcome = $this->createProjectEntityByDbEntity($dbProject);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    public function storeProject(Project $projectEntity) {
        $outcome = false;
        $project = $this->createDbProjectEntityByServiceEntity($projectEntity);
        if ($project != null) {
            $outcome = $project->save();
        }
        return $outcome;
    }

    public function updateProject(Project $projectEntity) {
        $outcome = false;
        $project = $this->createDbProjectEntityByServiceEntity($projectEntity);
        if ($project != null) {
            $outcome = $project->update();
        }
        return $outcome;
    }

    public function deleteProject(int $id) {
        return $this->projectsRepository->destroy($id);
    }

    /**
     * @param array[int] $sortedIds
     */
    public function updateProjectsSort(array $sortedIds) {
        return $this->projectsRepository->updateSort($sortedIds);
    }

    public function saveProjectImage(int $projectId, UploadedFile $file) {
        try {
            $outcome = null;

            $fileName = $this->imageService->createNewJpgFileName($file);
            if ($fileName != null && !empty($fileName)) {
                $dbImageEntity = $this->createImageDbEntityByFileName($fileName);
                $imageId = $this->projectsRepository->saveImageToProject($dbImageEntity, $projectId);
                if($imageId > 0 ) {
                    $savedImage = $this->saveImageToDisk($file, $fileName);
                    $outcome = $imageId;
                }
            }

            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            $this->deleteImageFromDisk($fileName);
            return null;
        }
    }

    /**
     * @param UploadedFile $file
     * @param $fileName
     * @return \Intervention\Image\Image|null
     */
    public function saveImageToDisk(UploadedFile $file, $fileName) {
        try {
            $outcome = null;
            if ($file != null || $fileName != null) {
                $image = Image::make($file->getRealPath());
                if ($image != null) {
                    $image = $this->resizeImageIfRequired($image);
                    $this->createPathIfNotExists(config('custom.images.uploadedImagePath'));
                    $filePath = $this->getRealFilePathFromName($fileName);
                    $outcome = $image->save($filePath, 100, 'jpg');
                }
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            $this->deleteImageFromDisk($fileName);
            return $outcome;
        }

    }

    /**
     * @param \App\User|null $dbUser
     * @return User
     */
    private function createUserEntityByDbEntity($dbUser) {
        $outcome = new User();
        if ($dbUser != null) {
            $outcome->id = $dbUser->id;
            $outcome->name = $dbUser->name;
            $outcome->email = $dbUser->email;
        }
        return $outcome;
    }

    /**
     * @param $translatableItem
     * @return Translation[]
     */
    private function createTranslationModels($databaseEntity, string $translatableItemName) {
        $outcome = [];

        $locales = config('custom.languages.locales');
        foreach ($locales as $key => $value) {
            $translation = $databaseEntity->getTranslation($translatableItemName, $key);
            $translationModel = new Translation($key, $translation);
            array_push($outcome, $translationModel);
        }
        return $outcome;
    }

    /**
     * @param \App\Category $dbCategory
     * @return Category
     */
    private function createCategoryEntityByDbEntity(\App\Category $dbCategory) {
        $outcome = new Category();
        if ($dbCategory != null) {
            $outcome->id = $dbCategory->id;
            $outcome->name = $dbCategory->name;
            $outcome->nameTranslations = $this->createTranslationModels($dbCategory, 'name');
        }

        return $outcome;
    }


    /**
     * @param Category $categoryEntity
     * @return \App\Category
     */
    private function createDbCategoryEntityByServiceEntity(Category $categoryEntity) {
        $outcome = null;
        if ($categoryEntity != null) {
            if ($categoryEntity->id > 0) {
                /** @var \App\Category $outcome */
                $outcome = $this->categoriesRepository->find($categoryEntity->id);
            } else {
                /** @var \App\Category $outcome */
                $outcome = new \App\Category();
            }

            if ($outcome != null) {
                foreach ($categoryEntity->nameTranslations as $nameTranslation) {
                    $outcome->setTranslation('name', $nameTranslation->locale, $nameTranslation->value);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param \App\Project $dbProject
     * @return Project
     */
    private function createProjectEntityByDbEntity(\App\Project $dbProject) {
        $outcome = new Project();

        if ($dbProject != null) {
            $outcome->id = $dbProject->id;
            $outcome->title = $dbProject->title;
            $outcome->description = $dbProject->description;
            $outcome->descriptionTranslations = $this->createTranslationModels($dbProject, 'description');
            $category = new Category();
            $category->id = $dbProject->category->id;
            $category->name = $dbProject->category->name;
            $category->orderNumber = $dbProject->category->order_number;
            $outcome->category = $category;
            $outcome->isVisible = $dbProject->show ? true : false;

            $dbImages = $dbProject->images;
            $outcome->images = [];
            /** @var \App\Image $dbImage */
            foreach ($dbImages as $dbImage) {
                if($dbImage != null) {
                    $imageEntity = new \App\External\ApiServiceEntities\Image();
                    $imageEntity->id = $dbImage->id;
                    $imageEntity->url = config('custom.images.uploadedImagesUrl') . "/" . $dbImage->name;
                    array_push($outcome->images, $imageEntity);
                }
            }
        }

        return $outcome;
    }

    /**
     * @param Category $categoryEntity
     * @return \App\Project
     */
    private function createDbProjectEntityByServiceEntity(Project $projectEntity) {
        $outcome = null;
        if ($projectEntity != null) {
            if ($projectEntity->id > 0) {
                /** @var \App\Project $outcome */
                $outcome = $this->projectsRepository->find($projectEntity->id);
            } else {
                /** @var \App\Project $outcome */
                $outcome = new \App\Project();
            }

            if ($outcome != null) {
                $outcome->category_id = $projectEntity->category->id;
                $outcome->title = $projectEntity->title;
                $outcome->show = $projectEntity->isVisible;

                foreach ($projectEntity->descriptionTranslations as $titleTranslation) {
                    $outcome->setTranslation('description', $titleTranslation->locale, $titleTranslation->value);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    private function resizeImageIfRequired($image) {
        $maxImageSize = config('custom.images.upload.maxImagSize');
        if($maxImageSize != null && $maxImageSize > 0) {
            $imageWidth = $image->width();
            $imageHeight = $image->height();

            $newWidth = $maxImageSize;
            $newHeight = $maxImageSize;
            if($imageWidth >= $imageHeight) {
                $newHeight = null;
            }
            else {
                $newWidth = null;
            }
            // prevent possible upsizing
            $image->resize($newWidth, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

        }
        return $image;
    }

    private function createPathIfNotExists($pathToBeCreated) {
        File::isDirectory($pathToBeCreated) or File::makeDirectory($pathToBeCreated, 0777, true, true);
    }

    private function deleteImageFromDisk($fileName) {
        try {
            $outcome = false;
            $filePath = $this->getRealFilePathFromName($fileName);
            if (file_exists($filePath)) {
                $outcome = unlink($filePath);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    private function getRealFilePathFromName($fileName) {
        return config('custom.images.uploadedImagePath') . "/" . $fileName;
    }

    /**
     * @param string $fileName
     * @return \App\Image|null
     */
    private function createImageDbEntityByFileName(string $fileName) {
        $outcome = null;
        if ($fileName != null && !empty($fileName)) {
            /** @var \App\Image $outcome */
            $outcome = new \App\Image();

            if ($outcome != null) {
                $outcome->name = $fileName;
            }
        }
        return $outcome;
    }

    public function deleteProjectImage(int $projectId, int $imageId) {
        try {
            $outcome = false;

            if ($projectId != null && $imageId != null) {
                $imageDbEntity = $this->imagesRepository->find($imageId);
                if($imageDbEntity != null) {
                    $isDeletedFromDb = $this->imagesRepository->destroy($imageId);
                    if($isDeletedFromDb) {
                        $outcome = true;
                        $isDeletedFromDisk = $this->deleteImageFromDisk($imageDbEntity->name);
                        if(!$isDeletedFromDisk) {
                            AppLog::errorMessage("l'immagine " . $imageId . " non si é potuta eliminare dal disco ma si dal DB");
                        }
                    }
                }
            }

            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param int $projectId
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateProjectImagesSort(int $projectId, array $imagesSortedIds) {
        return $this->projectsRepository->updateImagesSort($projectId, $imagesSortedIds);
    }
}
