<?php

namespace App\ViewModelsServices;

use App\Custom\Logging\AppLog;
use App\Custom\Pages\Services\PagesService;
use App\ViewModels\Pages\BreadcrumbViewModel;

class BreadcrumbViewModelService {

    /**
     * @var PagesService
     */
    private $pagesService;

    function __construct(PagesService $pagesService) {

        $this->pagesService = $pagesService;
    }

    /**
     * @param string $pageId
     * @return BreadcrumbViewModel[]
     */
    public function getBreadcrumbByPageId($pageId) {
        try {
            $outcome = [];
            switch ($pageId) {
                case config('custom.pages.PROJECTS'):
                case config('custom.pages.CONTACT'):
                case config('custom.pages.AUTH_LOGIN'):
                    $outcome = $this->getHomePageBreadcrumb();
                    break;
                case config('custom.pages.PROJECT_SHOW'):
                    $outcome = $this->getProjectsPageBreadcrumb();
                    break;
                case config('custom.pages.AUTH_CATEGORIES'):
                case config('custom.pages.AUTH_OFFERS'):
                case config('custom.pages.AUTH_PROJECTS'):
                    $outcome = $this->getAuthHomePageBreadcrumb();
                    break;
                case config('custom.pages.AUTH_CATEGORY_CREATE'):
                case config('custom.pages.AUTH_CATEGORY_EDIT'):
                case config('custom.pages.AUTH_CATEGORIES_SORT'):
                    $outcome = $this->getAuthCategoriesPageBreadcrumb();
                    break;
                case config('custom.pages.AUTH_PROJECT_CREATE'):
                case config('custom.pages.AUTH_PROJECT_EDIT'):
                case config('custom.pages.AUTH_PROJECTS_SORT'):
                case config('custom.pages.AUTH_PROJECT_IMAGES'):
                    $outcome = $this->getAuthProjectsPageBreadcrumb();
                    break;
                case config('custom.pages.AUTH_HOME_SLIDES'):
                    $outcome = $this->getAuthHomeSlidesPageBreadcrumb();
                    break;
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    /**
     * @return BreadcrumbViewModel[]
     */
    private function getHomePageBreadcrumb() {
        try {
            return [
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.INDEX')),
                    route('index'))
            ];

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    /**
     * @return BreadcrumbViewModel[]
     */
    private function getProjectsPageBreadcrumb() {
        try {
            return [
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.INDEX')),
                    route('index')),
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.PROJECTS')),
                    route('projects'))
            ];

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    /**
     * @return BreadcrumbViewModel[]
     */
    private function getAuthHomePageBreadcrumb() {
        try {
            return [
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.AUTH_INDEX')),
                    route('auth')),
            ];

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    /**
     * @return BreadcrumbViewModel[]
     */
    private function getAuthCategoriesPageBreadcrumb() {
        try {
            return [
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.AUTH_INDEX')),
                    route('auth')),
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.AUTH_CATEGORIES')),
                    route('auth.categories')),
            ];

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    /**
     * @return BreadcrumbViewModel[]
     */
    private function getAuthProjectsPageBreadcrumb() {
        try {
            return [
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.AUTH_INDEX')),
                    route('auth')),
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.AUTH_PROJECTS')),
                    route('auth.projects')),
            ];

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    /**
     * @return BreadcrumbViewModel[]
     */
    private function getAuthHomeSlidesPageBreadcrumb() {
        try {
            return [
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.AUTH_INDEX')),
                    route('auth'))
            ];

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    private function getPageTextById(int $pageId) {
        $pageEntity = $this->pagesService->getPageById($pageId);
        $outcome = $pageEntity->shortName;
        return $outcome;
    }

}
