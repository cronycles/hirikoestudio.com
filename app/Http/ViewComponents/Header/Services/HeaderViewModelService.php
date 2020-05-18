<?php

namespace App\Http\ViewComponents\Header\Services;

use App\Http\ViewComponents\Header\Models\HeaderLogoViewModel;
use App\Services\AuthService;
use App\Custom\Languages\Services\LanguageService;
use App\Custom\Pages\Services\PagesService;
use App\Http\ViewComponents\Header\Models\HeaderLinkViewModel;
use App\Http\ViewComponents\Header\Models\HeaderViewModel;
use Illuminate\Support\Facades\Route;

class HeaderViewModelService {

    /**
     * @var LanguageService
     */
    private $languageService;

    /**
     * @var PagesService
     */
    private $pagesService;

    /**
     * @var AuthService
     */
    private $authService;

    function __construct(
        PagesService $pagesService,
        LanguageService $languageService,
        AuthService $authService) {

        $this->pagesService = $pagesService;
        $this->languageService = $languageService;
        $this->authService = $authService;
    }

    public function getModel() {
        $outcome = new HeaderViewModel();
        $outcome->logo = $this->createLogoViewModel();
        $outcome->pageLinks = $this->createPageLinks();
        $outcome->userPageLinks = $this->createUserPageLinks();
        $outcome = $this->createViewModelLanguagesPart($outcome);
        $outcome = $this->createViewModelAdminPart($outcome);

        $isHomeRoot = Route::currentRouteNamed('index*');
        if ($isHomeRoot) {
            $outcome->hasInvertedColors = true;
        }
        return $outcome;
    }

    /**
     * @return HeaderLogoViewModel
     */
    private function createLogoViewModel() {
        $outcome = new HeaderLogoViewModel();

        $isHomeRoot = Route::currentRouteNamed('index*');
        if ($isHomeRoot) {
            $outcome->imageUrl = config('custom.images.static.logoWhite');
        } else {
            $outcome->imageUrl = config('custom.images.static.logoBlack');
        }
        $outcome->url = route('index');
        $outcome->linkText = config('custom.company.name');
        $outcome->altText = config('custom.company.name');
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createPageLinks() {
        $outcome = [
            $this->createProjectsLinkModel(),
            $this->createContactLinkModel()
        ];
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createUserPageLinks() {
        $outcome = [
            $this->createLoginLinkModel()
        ];
        return $outcome;
    }

    /**
     * @param HeaderViewModel $outcome
     * @return mixed
     */
    private function createViewModelLanguagesPart($outcome) {
        $visibleLanguages = $this->languageService->getVisibleLanguages();
        if (count($visibleLanguages) > 1) {
            foreach ($visibleLanguages as $visibleLanguage) {
                if ($visibleLanguage->isCurrent) {
                    $outcome->currentLanguage = $visibleLanguage->code;
                } else {
                    $url = route('lang.switch', $visibleLanguage->code);
                    $linkViewModel = new HeaderLinkViewModel($url, $visibleLanguage->code, false);
                    array_push($outcome->languageLinks, $linkViewModel);
                }
            }
        }

        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel
     */
    private function createProjectsLinkModel() {
        $url = route('projects');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.PROJECTS'));
        $isActive = Route::currentRouteNamed('projects*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    /**
     * @return HeaderLinkViewModel
     */
    private function createContactLinkModel() {
        $url = route('contact');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.CONTACT'));
        $isActive = Route::currentRouteNamed('contact*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    /**
     * @param HeaderViewModel $vieModel
     * @return HeaderViewModel
     */
    private function createViewModelAdminPart($vieModel) {
        $vieModel->isUserAuth = $this->authService->isAnyUserAuthenticated();
        if ($vieModel->isUserAuth) {
            $userEntity = $this->authService->getAuthUser();
            $vieModel->userName = '@' . $userEntity->name;
        }
        $vieModel->adminPageLinks = [
            $this->createAuthHomeLink(),
            $this->createAuthCategoriesLink(),
            $this->createAuthProjectsLink()
        ];
        return $vieModel;

    }

    private function createLoginLinkModel() {
        $url = route('login');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_LOGIN'));
        $isActive = Route::currentRouteNamed('login*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthHomeLink() {
        $userEntity = $this->authService->getAuthUser();
        $url = route('auth');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_INDEX'));
        $isActive = Route::currentRouteNamed('auth');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthCategoriesLink() {
        $userEntity = $this->authService->getAuthUser();
        $url = route('auth.categories');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_CATEGORIES'));
        $isActive = Route::currentRouteNamed('auth.categor*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthProjectsLink() {
        $userEntity = $this->authService->getAuthUser();
        $url = route('auth.projects');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_PROJECTS'));
        $isActive = Route::currentRouteNamed('auth.project*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function getMenuPageTextFromConfig(int $pageId) {
        $pageEntity = $this->pagesService->getPageById($pageId);
        $outcome = $pageEntity->shortName;
        return $outcome;
    }

}
