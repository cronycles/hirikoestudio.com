<?php

namespace App\ViewModelsServices;

use App\Custom\Languages\Services\LanguagesService;
use App\Custom\Logging\AppLog;
use App\Custom\Pages\Entities\PageEntity;
use App\Custom\Pages\Services\PagesService;
use App\ViewModels\Pages\PageViewModel;

class PageViewModelService {

    /**
     * @var PagesService
     */
    private $pagesService;

    /**
     * @var BreadcrumbViewModelService
     */
    private $breadcrumbViewModelService;

    /**
     * @var LanguagesService
     */
    private $languagesService;


    function __construct(
        LanguagesService $languagesService,
        PagesService $pagesService,
        BreadcrumbViewModelService $breadcrumbViewModelService) {

        $this->languagesService = $languagesService;
        $this->pagesService = $pagesService;
        $this->breadcrumbViewModelService = $breadcrumbViewModelService;
    }

    /**
     * @param int $pageId
     * @param array $params
     * @return PageViewModel|null
     */
    public function getViewModelByPageId ($pageId, $params = []) {
        $pageEntity = $this->pagesService->getPageById($pageId);

        $viewModelPageBuilder = $pageEntity->viewModelPageBuilder;

        /** @var PageViewModel $viewModel */
        $viewModel = $viewModelPageBuilder->createNewViewModel();

        $viewModel = $this->setInitialDataForPage($viewModel, $pageEntity);

        return $viewModelPageBuilder->fillPageViewModel($viewModel, $params);
    }

    /**
     * @param PageViewModel $pageViewModel
     * @param PageEntity $pageEntity
     * @return PageViewModel|null
     */
    private function setInitialDataForPage(PageViewModel $pageViewModel,  PageEntity $pageEntity) {
        try {
            $pageViewModel->id = $pageEntity->id;
            $pageViewModel->htmlTitle = $pageEntity->htmlTitle;
            $pageViewModel->htmlMetaDescription = $pageEntity->htmlMetaDescription;
            $pageViewModel->htmlMetaKeywords = $pageEntity->htmlMetaKeywords;
            $pageViewModel->ogImageUrl = config('custom.images.static.socialsDefaultLogo');
            $pageViewModel->title = $pageEntity->title;
            $pageViewModel->description = $pageEntity->description;
            $pageViewModel->viewPath = $pageEntity->viewPath;
            $pageViewModel->currentLanguageId = $pageEntity->currentLanguageId;
            $pageViewModel->breadcrumbs = $this->breadcrumbViewModelService->getBreadcrumbByPageId($pageEntity->id);

            return $pageViewModel;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

}
