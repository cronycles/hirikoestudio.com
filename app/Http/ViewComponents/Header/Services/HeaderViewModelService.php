<?php

namespace App\Http\ViewComponents\Header\Services;

use App\Http\ViewComponents\Header\Models\HeaderLogoViewModel;
use App\Services\AuthService;
use App\Custom\Languages\Services\LanguagesService;
use App\Custom\Pages\Services\PagesService;
use App\Http\ViewComponents\Header\Models\HeaderLinkViewModel;
use App\Http\ViewComponents\Header\Models\HeaderViewModel;
use Illuminate\Support\Facades\Route;

class HeaderViewModelService {

    /**
     * @var LanguagesService
     */
    private $languagesService;

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
        LanguagesService $languagesService,
        AuthService $authService) {

        $this->pagesService = $pagesService;
        $this->languagesService = $languagesService;
        $this->authService = $authService;
    }

    public function getModel() {
        $outcome = new HeaderViewModel();
        $outcome->logo = $this->createLogoViewModel();
        $outcome->pageLinks = $this->createPageLinks();
        $outcome->userPageLinks = $this->createUserPageLinks();
        $outcome = $this->createViewModelLanguagesPart($outcome);
        $outcome = $this->createViewModelAdminPart($outcome);

        return $outcome;
    }

    /**
     * @return HeaderLogoViewModel
     */
    private function createLogoViewModel() {
        $outcome = new HeaderLogoViewModel();
        $outcome->imageUrl = config('custom.images.static.logoBlack');
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
            $this->createHomeLinkModel(),
        ];
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createUserPageLinks() {
        $outcome = [
            $this->createLoginLinkModel(),
            $this->createRegisterLink()
        ];
        return $outcome;
    }

    /**
     * @param HeaderViewModel $outcome
     * @return mixed
     */
    private function createViewModelLanguagesPart($outcome) {
        $outcome->isMultilanguageActive = $this->languagesService->isMultilanguageActive();
        if($outcome->isMultilanguageActive) {
            $availableLanguages = $this->languagesService->getAvailableLanguages();
            foreach ($availableLanguages as $availableLanguage) {
                if($availableLanguage->isCurrent) {
                    $outcome->currentLanguage = $availableLanguage->text;
                }
                else {
                    $url = route('lang.switch', $availableLanguage->id);
                    $linkViewModel = new HeaderLinkViewModel($url,$availableLanguage->text, false );
                    array_push($outcome->languageLinks, $linkViewModel);
                }
            }
        }

        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel
     */
    private function createHomeLinkModel() {
        $url = route('index');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.INDEX'));
        $isActive = Route::currentRouteNamed('index*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    /**
     * @param HeaderViewModel $vieModel
     * @return HeaderViewModel
     */
    private function createViewModelAdminPart($vieModel) {
        $vieModel->isUserAuth = $this->authService->isAnyUserAuthenticated();
        if($vieModel->isUserAuth) {
            $userEntity = $this->authService->getAuthUser();
            $vieModel->userName =  '@' . $userEntity->name;
        }
        $vieModel->adminPageLinks = [
            $this->createAuthHomeLink()
        ];
        return $vieModel;

    }

    private function createLoginLinkModel() {
        $url = route('login');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_LOGIN'));
        $isActive = Route::currentRouteNamed('login*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createRegisterLink() {
        $url = route('register');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_REGISTER'));
        $isActive = Route::currentRouteNamed('register*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthHomeLink() {
        $userEntity = $this->authService->getAuthUser();
        $url = route('auth');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_INDEX'));
        $isActive = Route::currentRouteNamed('auth');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function getMenuPageTextFromConfig(int $pageId) {
        $pageEntity = $this->pagesService->getPageById($pageId);
        $outcome = $pageEntity->shortName;
        return $outcome;
    }

}
