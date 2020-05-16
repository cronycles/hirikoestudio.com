<?php

namespace App\ViewModelsServices;

use App\Custom\Languages\Entities\LanguageEntity;
use App\Custom\Languages\Services\LanguageService;
use App\Custom\Logging\AppLog;
use App\Custom\Pages\Entities\PageEntity;
use App\Custom\Pages\Services\PagesService;
use App\ViewModels\Language\LanguageViewModel;
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
     * @var LanguageService
     */
    private $languageService;


    function __construct(
        LanguageService $languageService,
        PagesService $pagesService,
        BreadcrumbViewModelService $breadcrumbViewModelService) {

        $this->languageService = $languageService;
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
            $pageViewModel->currentLanguage = $this->createLanguageViewModelByEntity($pageEntity->currentLanguage);
            $pageViewModel->breadcrumbs = $this->breadcrumbViewModelService->getBreadcrumbByPageId($pageEntity->id);

            return $pageViewModel;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param LanguageEntity $languageEntity
     */
    private function createLanguageViewModelByEntity(LanguageEntity $languageEntity) {
        $outcome = new LanguageViewModel();
        if ($languageEntity != null) {
            $outcome->code = $languageEntity->code;
            $outcome->cultureCode = $languageEntity->cultureCode;
            $outcome->name = $languageEntity->name;
            $outcome->isDefault = $languageEntity->isDefault;
            $outcome->isEnabled = $languageEntity->isEnabled;
            $outcome->isVisible = $languageEntity->isVisible;
            $outcome->isAuthVisible = $languageEntity->isAuthVisible;
            $outcome->isCurrent = $languageEntity->isCurrent;
        }
        return $outcome;
    }

}
