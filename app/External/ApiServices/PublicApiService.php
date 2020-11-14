<?php

namespace App\External\ApiServices;

use App\Custom\ImagesUploader\Helpers\ImagesHelper;
use App\Custom\Logging\AppLog;
use App\Custom\Slug\Helpers\SlugHelper;
use App\Custom\Translations\ApiServiceEntities\Translation;
use App\External\ApiServiceEntities\CarouselImage;
use App\External\ApiServiceEntities\Category;
use App\External\ApiServiceEntities\Language;
use App\External\ApiServiceEntities\Project;
use App\External\ApiServiceEntities\User;
use App\External\Repositories\CarouselImagesRepository;
use App\External\Repositories\CategoriesRepository;
use App\External\Repositories\ImagesRepository;
use App\External\Repositories\LocalesRepository;
use App\External\Repositories\ProjectsRepository;
use App\External\Repositories\UsersRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Image;

class PublicApiService {

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * @var LocalesRepository
     */
    private $localesRepository;

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

    /**
     * @var CarouselImagesRepository
     */
    private $carouselImagesRepository;

    /**
     * @var SlugHelper
     */
    private $slugHelper;

    public function __construct(
        UsersRepository $usersRepository,
        LocalesRepository $localesRepository,
        ProjectsRepository $projectsRepository,
        CategoriesRepository $categoriesRepository,
        CarouselImagesRepository $carouselImagesRepository,
        ImagesRepository $imagesRepository,
        ImagesHelper $imageService,
        SlugHelper $slugHelper) {

        $this->usersRepository = $usersRepository;
        $this->localesRepository = $localesRepository;
        $this->projectsRepository = $projectsRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->carouselImagesRepository = $carouselImagesRepository;
        $this->imagesRepository = $imagesRepository;
        $this->imageService = $imageService;
        $this->slugHelper = $slugHelper;
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
                $outcome = $this->createUserEntityByDbModel($dbUser);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @return Language[]
     */
    public function getLanguages() {
        try {
            $outcome = [];

            /** @var array $dbLocales */
            $dbLocales = $this->localesRepository->all();

            if ($dbLocales != null && !empty($dbLocales)) {
                /** @var \App\Locale $dbLocale */
                foreach ($dbLocales as $dbLocale) {
                    $entity = $this->createLanguageEntityByDbModel($dbLocale);
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
     * @return \App\External\ApiServiceEntities\CarouselImage[]
     */
    public function getCarouselImages() {
        try {
            $outcome = [];

            $dbEntities = $this->carouselImagesRepository->all();

            if ($dbEntities != null && !empty($dbEntities)) {
                /** @var \App\CarouselImage $dbEntities */
                foreach ($dbEntities as $dbEntity) {
                    $entity = $this->createCarouselImageEntityByDbModel($dbEntity);
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
                    $entity = $this->createCategoryEntityByDbModel($dbCategory);
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
                $outcome = $this->createCategoryEntityByDbModel($dbCategory);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    public function storeCategory(Category $categoryEntity) {
        $outcome = false;
        $category = $this->createCategoryDbModelByServiceEntity($categoryEntity);
        if ($category != null) {
            $outcome = $category->save();
        }
        return $outcome;
    }

    public function updateCategory(Category $categoryEntity) {
        $outcome = false;
        $category = $this->createCategoryDbModelByServiceEntity($categoryEntity);
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
                    $entity = $this->createProjectEntityByDbModel($dbProject);
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
                $outcome = $this->createProjectEntityByDbModel($dbProject);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    public function storeProject(Project $projectEntity) {
        $outcome = false;
        $project = $this->createProjectDbModelByServiceEntity($projectEntity);
        if ($project != null) {
            $outcome = $project->save();
        }
        return $outcome;
    }

    public function updateProject(Project $projectEntity) {
        $outcome = false;
        $project = $this->createProjectDbModelByServiceEntity($projectEntity);
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
                $image = Image::make($file->getRealPath());
                if ($image != null) {
                    $dbImageEntity = $this->createImageDbEntity($image, $fileName);
                    $imageId = $this->projectsRepository->saveImageToProject($dbImageEntity, $projectId);
                    if($imageId > 0 ) {
                        $savedImage = $this->saveImageToDisk($image, $fileName);
                        $outcome = $imageId;
                    }
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
     * @param \Intervention\Image\Image $image
     * @param $fileName
     * @return \Intervention\Image\Image|null
     */
    public function saveImageToDisk(\Intervention\Image\Image $image, $fileName) {
        try {
            $outcome = null;
            if ($image != null || $fileName != null) {
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
    private function createUserEntityByDbModel($dbUser) {
        $outcome = new User();
        if ($dbUser != null) {
            $outcome->id = $dbUser->id;
            $outcome->name = $dbUser->name;
            $outcome->email = $dbUser->email;
        }
        return $outcome;
    }

    /**
     * @param \App\Locale|null $dbLocale
     * @return Language
     */
    private function createLanguageEntityByDbModel($dbLocale) {
        $outcome = new Language();
        if ($dbLocale != null) {
            $outcome->code = $dbLocale->code;
            $outcome->cultureCode = $dbLocale->culture_code;
            $outcome->name = $dbLocale->name;
            $outcome->isDefault = $dbLocale->default;
            $outcome->isVisible = $dbLocale->visible;
            $outcome->isAuthVisible = $dbLocale->auth_visible;
        }
        return $outcome;
    }

    /**
     * @return Translation[]
     */
    private function createTranslationEntitiesByDbModel($databaseEntity, string $translatableItemName) {
        $outcome = [];

        $languages = $this->getLanguages();
        foreach ($languages as $language) {
            $translation = $databaseEntity->getTranslation($translatableItemName, $language->code);
            $translationModel = new Translation($language->code, $translation);
            array_push($outcome, $translationModel);
        }
        return $outcome;
    }

    /**
     * @param \App\Category $dbCategory
     * @return Category
     */
    private function createCategoryEntityByDbModel(\App\Category $dbCategory) {
        $outcome = new Category();
        if ($dbCategory != null) {
            $outcome->id = $dbCategory->id;
            $outcome->name = $dbCategory->name;
            $outcome->nameTranslations = $this->createTranslationEntitiesByDbModel($dbCategory, 'name');
        }

        return $outcome;
    }


    /**
     * @param Category $categoryEntity
     * @return \App\Category
     */
    private function createCategoryDbModelByServiceEntity(Category $categoryEntity) {
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
     * @param \App\CarouselImage $dbEntity
     * @return CarouselImage
     */
    private function createCarouselImageEntityByDbModel(\App\CarouselImage $dbEntity) {
        $outcome = new CarouselImage();

        if ($dbEntity != null) {
            $outcome->id = $dbEntity->id;
            $outcome->orderNumber = $dbEntity->order_number;
            $outcome->isMobile = $dbEntity->is_mobile;

            $dbImage = $dbEntity->image;
            if($dbImage != null) {
                $imageEntity = new \App\External\ApiServiceEntities\Image();
                $imageEntity->id = $dbImage->id;
                $imageEntity->name = $dbImage->name;
                $imageEntity->width = $dbImage->width;
                $imageEntity->height = $dbImage->height;
                $imageEntity->url = config('custom.images.uploadedHomeSlidesUrl') . "/" . $dbImage->name;
                $outcome->image = $imageEntity;
            }

        }

        return $outcome;
    }

    /**
     * @param \App\Project $dbProject
     * @return Project
     */
    private function createProjectEntityByDbModel(\App\Project $dbProject) {
        $outcome = new Project();

        if ($dbProject != null) {
            $outcome->id = $dbProject->id;
            $outcome->title = $dbProject->title;
            $outcome->slug = $this->slugHelper->addIdToSlug($dbProject->slug, $dbProject->id);
            $outcome->description = $dbProject->description;
            $outcome->descriptionTranslations = $this->createTranslationEntitiesByDbModel($dbProject, 'description');
            $category = new Category();
            $category->id = $dbProject->category->id;
            $category->name = $dbProject->category->name;
            $category->orderNumber = $dbProject->category->order_number;
            $outcome->category = $category;
            $outcome->isVisible = $dbProject->show ? true : false;
            $outcome->isVisibleInHomepage = $dbProject->show_in_home ? true : false;

            $dbImages = $dbProject->images;
            $outcome->images = [];
            /** @var \App\Image $dbImage */
            foreach ($dbImages as $dbImage) {
                if($dbImage != null) {
                    $imageEntity = new \App\External\ApiServiceEntities\Image();
                    $imageEntity->id = $dbImage->id;
                    $imageEntity->name = $dbImage->name;
                    $imageEntity->width = $dbImage->width;
                    $imageEntity->height = $dbImage->height;
                    $imageEntity->url = config('custom.images.uploadedImagesUrl') . "/" . $dbImage->name;
                    $imageEntity->isSmallViewEnabled = $dbImage->pivot->image_small_view;
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
    private function createProjectDbModelByServiceEntity(Project $projectEntity) {
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
                $outcome->slug = $this->slugHelper->slugifyText($projectEntity->title);
                $outcome->show = $projectEntity->isVisible;
                $outcome->show_in_home = $projectEntity->isVisibleInHomepage;

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
     * @param \Intervention\Image\Image $image
     * @param string $fileName
     * @return \App\Image|null
     */
    private function createImageDbEntity(\Intervention\Image\Image $image, string $fileName) {
        $outcome = null;
        if ($fileName != null && !empty($fileName)) {
            /** @var \App\Image $outcome */
            $outcome = new \App\Image();

            if ($outcome != null) {
                $outcome->name = $fileName;
                $outcome->size = $image->fileSize();
                $outcome->width = $image->width();
                $outcome->height = $image->height();
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

    /**
     * @param int $projectId
     * @param int $imageId
     * @param bool $value
     * @return bool
     */
    public function changeProjectImageSmallView(int $projectId, int $imageId, bool $value = true) {
        return $this->projectsRepository->changeProjectImageSmallView($projectId, $imageId, $value);
    }
}

