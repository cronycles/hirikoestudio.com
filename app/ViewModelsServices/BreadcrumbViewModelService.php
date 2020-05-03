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
                case config('custom.pages.AUTH_LOGIN'):
                $outcome = $this->getHomePageBreadcrumb();
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
    public function getHomePageBreadcrumb() {
        try {
            return [
                new BreadcrumbViewModel(
                    $this->getPageTextById(config('custom.pages.INDEX')),
                    route('index') )
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
