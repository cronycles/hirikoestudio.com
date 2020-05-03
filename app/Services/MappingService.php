<?php

namespace App\Services;

use App\Entities\CategoryEntity;
use App\Entities\ImageEntity;
use App\Entities\ProjectEntity;
use App\Entities\UserEntity;
use App\External\ApiServiceEntities\Category;
use App\External\ApiServiceEntities\Image;
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
     * @param Project[]
     * @return ProjectEntity[];
     */
    public function mapProjects($serviceProjects) {
        $outcome = [];
        if ($serviceProjects && !empty($serviceProjects)) {
            foreach ($serviceProjects as $serviceProject) {
                $projectEntity = $this->mapProject($serviceProject);
                if($projectEntity != null) {
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
            $outcome->description = $serviceProject->description;
            $outcome->isVisible = $serviceProject->isVisible;
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
                if($imageEntity != null) {
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
            }
        }
        return $outcome;
    }


}
