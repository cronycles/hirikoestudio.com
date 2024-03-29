<?php

namespace App\Services;

use App\Custom\Languages\Entities\LanguageEntity;
use App\Custom\Translations\ApiServiceEntities\Translation;
use App\Custom\Translations\Entities\TranslationEntity;
use App\Entities\CarouselImageEntity;
use App\Entities\CategoryEntity;
use App\Entities\ImageEntity;
use App\Entities\ProjectEntity;
use App\Entities\UserEntity;
use App\External\ApiServiceEntities\CarouselImage;
use App\External\ApiServiceEntities\Category;
use App\External\ApiServiceEntities\Image;
use App\External\ApiServiceEntities\Language;
use App\External\ApiServiceEntities\Project;
use App\External\ApiServiceEntities\User;

class MappingService {

    public function __construct() {
    }

    /**
     * @param User
     * @return UserEntity
     */
    public function mapUser(User $serviceUser) {
        $outcome = null;
        if ($serviceUser != null) {
            $outcome = new UserEntity();
            $outcome->id = $serviceUser->id;
            $outcome->name = $serviceUser->name;
            $outcome->email = $serviceUser->email;
        }
        return $outcome;
    }

    /**
     * @param Language[]
     * @return LanguageEntity[];
     */
    public function mapLanguages($serviceLanguages) {
        $outcome = [];
        if ($serviceLanguages && !empty($serviceLanguages)) {
            foreach ($serviceLanguages as $serviceLanguage) {
                $languageEntity = $this->mapLanguage($serviceLanguage);
                if ($languageEntity != null) {
                    array_push($outcome, $languageEntity);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param Language
     * @return LanguageEntity
     */
    public function mapLanguage($serviceLanguage) {
        $outcome = new LanguageEntity();
        /** @var Language $serviceLanguage */
        if ($serviceLanguage != null) {
            $outcome->code = $serviceLanguage->code;
            $outcome->cultureCode = $serviceLanguage->cultureCode;
            $outcome->name = $serviceLanguage->name;
            $outcome->isDefault = $serviceLanguage->isDefault;
            $outcome->isVisible = $serviceLanguage->isVisible;
            $outcome->isAuthVisible = $serviceLanguage->isAuthVisible;
        }
        return $outcome;
    }

    /**
     * @param CarouselImage[]
     * @return CarouselImageEntity[];
     */
    public function mapCarouselImages($serviceEntities) {
        $outcome = [];
        if ($serviceEntities && !empty($serviceEntities)) {
            foreach ($serviceEntities as $serviceEntity) {
                $entity = $this->mapCarouselImage($serviceEntity);
                if ($entity != null) {
                    array_push($outcome, $entity);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param CarouselImage
     * @return CarouselImageEntity
     */
    public function mapCarouselImage($serviceEntity) {
        $outcome = new CarouselImageEntity();
        /** @var CarouselImage $serviceEntity */
        if ($serviceEntity != null) {
            $outcome->id = $serviceEntity->id;
            $outcome->orderNumber = $serviceEntity->orderNumber;
            $outcome->isMobile = $serviceEntity->isMobile;
            $outcome->image = $this->mapImage($serviceEntity->image);
        }
        return $outcome;
    }

    /**
     * @param Project[]
     * @return ProjectEntity[];
     */
    public function mapProjects($serviceProjects) {
        $outcome = [];
        if ($serviceProjects && !empty($serviceProjects)) {
            foreach ($serviceProjects as $serviceProject) {
                $projectEntity = $this->mapProject($serviceProject);
                if ($projectEntity != null) {
                    array_push($outcome, $projectEntity);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param Project
     * @return ProjectEntity
     */
    public function mapProject($serviceProject) {
        $outcome = new ProjectEntity();
        /** @var Project $serviceProject */
        if ($serviceProject != null) {
            $outcome->id = $serviceProject->id;
            $outcome->category = $this->mapCategory($serviceProject->category);
            $outcome->title = $serviceProject->title;
            $outcome->slug = $serviceProject->slug;
            $outcome->description = $serviceProject->description;
            $outcome->descriptionTranslations = $this->createTranslationEntities($serviceProject->descriptionTranslations);
            $outcome->isVisible = $serviceProject->isVisible;
            $outcome->isVisibleInHomepage = $serviceProject->isVisibleInHomepage;
            $outcome->images = $this->mapImages($serviceProject->images);
        }
        return $outcome;
    }

    /**
     * @param Image
     * @return ImageEntity[];
     */
    private function mapImages($serviceImages) {
        $outcome = [];
        if ($serviceImages && !empty($serviceImages)) {
            foreach ($serviceImages as $serviceImage) {
                $imageEntity = $this->mapImage($serviceImage);
                if ($imageEntity != null) {
                    array_push($outcome, $imageEntity);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param Image
     * @return ImageEntity
     */
    public function mapImage($serviceImage) {
        $outcome = new ImageEntity();
        /** @var Image $serviceImage */
        if ($serviceImage != null) {
            $outcome->id = $serviceImage->id;
            $outcome->url = $serviceImage->url;
            $outcome->name = $serviceImage->name;
            $outcome->width = $serviceImage->width;
            $outcome->height = $serviceImage->height;
            $outcome->isSmallViewEnabled = $serviceImage->isSmallViewEnabled;
        }
        return $outcome;
    }

    /**
     * @param Category[]
     * @return CategoryEntity[];
     */
    public function mapCategories($serviceCategories) {
        $outcome = [];
        if ($serviceCategories && !empty($serviceCategories)) {
            foreach ($serviceCategories as $serviceCategory) {
                $categoryEntity = $this->mapCategory($serviceCategory);
                if ($categoryEntity != null) {
                    array_push($outcome, $categoryEntity);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param Category
     * @return CategoryEntity;
     */
    public function mapCategory($serviceCategory) {
        $outcome = new CategoryEntity();
        if ($serviceCategory != null) {
            /** @var Category $serviceCategory */
            if ($serviceCategory != null) {
                $outcome->id = $serviceCategory->id;
                $outcome->name = $serviceCategory->name;
                $outcome->nameTranslations = $this->createTranslationEntities($serviceCategory->nameTranslations);
            }
        }
        return $outcome;
    }

    /**
     * @param Translation[] $serviceEntities
     * @return TranslationEntity[]
     */
    private function createTranslationEntities($serviceEntities) {
        $outcome = [];

        foreach ($serviceEntities as $serviceEntity) {
            $translationEntity = new TranslationEntity($serviceEntity->locale, $serviceEntity->value);
            array_push($outcome, $translationEntity);
        }
        return $outcome;
    }


}
