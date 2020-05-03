<?php

namespace App\Http\ViewComponents\Navbar\Services;

use App\Services\AuthService;
use App\Custom\Languages\Services\LanguagesService;
use App\Custom\Pages\Services\PagesService;
use App\Http\ViewComponents\Navbar\Models\NavbarLinkViewModel;
use App\Http\ViewComponents\Navbar\Models\NavbarViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NavbarViewModelService {

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
        $outcome = new NavbarViewModel();
        $outcome->pageLinks = $this->createPageLinks();
        $outcome->userPageLinks = $this->createUserPageLinks();
        $outcome = $this->createViewModelLanguagesPart($outcome);
        $outcome = $this->createViewModelAdminPart($outcome);

        return $outcome;
    }

    /**
     * @return NavbarLinkViewModel[]
     */
    private function createPageLinks() {
        $outcome = [
            $this->createHomeLinkModel(),
        ];
        return $outcome;
    }

    /**
     * @return NavbarLinkViewModel[]
     */
    private function createUserPageLinks() {
        $outcome = [
            $this->createLoginLinkModel(),
            $this->createRegisterLink()
        ];
        return $outcome;
    }

    /**
     * @param NavbarViewModel $outcome
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
                    $linkViewModel = new NavbarLinkViewModel($url,$availableLanguage->text, false );
                    array_push($outcome->languageLinks, $linkViewModel);
                }
            }
        }

        return $outcome;
    }

    /**
     * @return NavbarLinkViewModel
     */
    private function createHomeLinkModel() {
        $url = route('index');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.INDEX'));
        $isActive = Route::currentRouteNamed('index*');
        return new NavbarLinkViewModel($url, $text, $isActive);
    }

    /**
     * @param NavbarViewModel $vieModel
     * @return NavbarViewModel
     */
    private function createViewModelAdminPart($vieModel) {
        $vieModel->isUserAuth = $this->authService->isAnyUserAuthenticated();
        if($vieModel->isUserAuth) {
            $userEntity = $this->authService->getAuthUser();
            $vieModel->userName =  $userEntity->name;
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
        return new NavbarLinkViewModel($url, $text, $isActive);
    }

    private function createRegisterLink() {
        $url = route('register');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_REGISTER'));
        $isActive = Route::currentRouteNamed('register*');
        return new NavbarLinkViewModel($url, $text, $isActive);
    }

    private function createAuthHomeLink() {
        $userEntity = $this->authService->getAuthUser();
        $url = route('auth');
        $text = $userEntity ? '@' . $userEntity->name : "";
        $isActive = Route::currentRouteNamed('auth');
        return new NavbarLinkViewModel($url, $text, $isActive);
    }

    private function getMenuPageTextFromConfig(int $pageId) {
        $pageEntity = $this->pagesService->getPageById($pageId);
        $outcome = $pageEntity->shortName;
        return $outcome;
    }

}
