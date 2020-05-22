<?php


namespace App\Custom\Pages\Services;


use App\Custom\Languages\Services\LanguageService;
use App\Custom\Logging\AppLog;
use App\Custom\Pages\Entities\PageEntity;
use App\ViewModelPageBuilders\Auth\AuthIndexViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Categories\AuthCategoriesSortViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Categories\AuthCategoriesViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Categories\AuthCategoryCreateViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Categories\AuthCategoryEditViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\ForgotPasswordViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\LoginViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Projects\AuthProjectCreateViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Projects\AuthProjectEditViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Projects\AuthProjectImagesViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Projects\AuthProjectsSortViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\Projects\AuthProjectsViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\RegisterViewModelPageBuilder;
use App\ViewModelPageBuilders\Auth\ResetPasswordViewModelPageBuilder;
use App\ViewModelPageBuilders\ContactViewModelPageBuilder;
use App\ViewModelPageBuilders\IndexViewModelPageBuilder;
use App\ViewModelPageBuilders\ProjectShowViewModelPageBuilder;
use App\ViewModelPageBuilders\ProjectsViewModelPageBuilder;
use App\ViewModelPageBuilders\UnknownViewModelPageBuilder;

class PagesService {

    private $pageConfigurations = [];

    /**
     * @var LanguageService
     */
    private $languageService;

    public function __construct(
        LanguageService $languageService,
        UnknownViewModelPageBuilder $unknownViewModelPageBuilder,
        IndexViewModelPageBuilder $indexViewModelPageBuilder,
        LoginViewModelPageBuilder $loginViewModelPageBuilder,
        RegisterViewModelPageBuilder $registerViewModelPageBuilder,
        ForgotPasswordViewModelPageBuilder $forgotPasswordViewModelPageBuilder,
        ResetPasswordViewModelPageBuilder $resetPasswordViewModelPageBuilder,
        ProjectsViewModelPageBuilder $projectsViewModelPageBuilder,
        ProjectShowViewModelPageBuilder $projectShowViewModelPageBuilder,
        ContactViewModelPageBuilder $contactViewModelPageBuilder,
        AuthIndexViewModelPageBuilder $authIndexViewModelPageBuilder,
        AuthCategoriesViewModelPageBuilder $authCategoriesViewModelPageBuilder,
        AuthCategoryCreateViewModelPageBuilder $authCategoryCreateViewModelPageBuilder,
        AuthCategoryEditViewModelPageBuilder $authCategoryEditViewModelPageBuilder,
        AuthCategoriesSortViewModelPageBuilder $authCategoriesSortViewModelPageBuilder,
        AuthProjectsViewModelPageBuilder $authProjectsViewModelPageBuilder,
        AuthProjectCreateViewModelPageBuilder $authProjectCreateViewModelPageBuilder,
        AuthProjectEditViewModelPageBuilder $authProjectEditViewModelPageBuilder,
        AuthProjectsSortViewModelPageBuilder $authProjectsSortViewModelPageBuilder,
        AuthProjectImagesViewModelPageBuilder $authProjectImagesViewModelPageBuilder
    ) {

        $this->languageService = $languageService;

        $this->pageConfigurations[config('custom.pages.UNKNOWN')] = [
            'config' => config('pages.unknown'),
            'viewModelPageBuilder' => $unknownViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.INDEX')] = [
            'config' => config('pages.index'),
            'viewModelPageBuilder' => $indexViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.PROJECTS')] = [
            'config' => config('pages.projects'),
            'viewModelPageBuilder' => $projectsViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.PROJECT_SHOW')] = [
            'config' => config('pages.project-show'),
            'viewModelPageBuilder' => $projectShowViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.CONTACT')] = [
            'config' => config('pages.contact'),
            'viewModelPageBuilder' => $contactViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_LOGIN')] = [
            'config' => config('pages.auth.login'),
            'viewModelPageBuilder' => $loginViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.AUTH_REGISTER')] = [
            'config' => config('pages.auth.register'),
            'viewModelPageBuilder' => $registerViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.AUTH_FORGOT_PASSWORD')] = [
            'config' => config('pages.auth.forgot-password'),
            'viewModelPageBuilder' => $forgotPasswordViewModelPageBuilder
        ];
        $this->pageConfigurations[config('custom.pages.AUTH_RESET_PASSWORD')] = [
            'config' => config('pages.auth.reset-password'),
            'viewModelPageBuilder' => $resetPasswordViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_INDEX')] = [
            'config' => config('pages.auth.index'),
            'viewModelPageBuilder' => $authIndexViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_CATEGORIES')] = [
            'config' => config('pages.auth.categories'),
            'viewModelPageBuilder' => $authCategoriesViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_CATEGORY_CREATE')] = [
            'config' => config('pages.auth.category-create'),
            'viewModelPageBuilder' => $authCategoryCreateViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_CATEGORY_EDIT')] = [
            'config' => config('pages.auth.category-edit'),
            'viewModelPageBuilder' => $authCategoryEditViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_CATEGORIES_SORT')] = [
            'config' => config('pages.auth.categories-sort'),
            'viewModelPageBuilder' => $authCategoriesSortViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_PROJECTS')] = [
            'config' => config('pages.auth.projects'),
            'viewModelPageBuilder' => $authProjectsViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_PROJECT_CREATE')] = [
            'config' => config('pages.auth.project-create'),
            'viewModelPageBuilder' => $authProjectCreateViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_PROJECT_EDIT')] = [
            'config' => config('pages.auth.project-edit'),
            'viewModelPageBuilder' => $authProjectEditViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_PROJECTS_SORT')] = [
            'config' => config('pages.auth.projects-sort'),
            'viewModelPageBuilder' => $authProjectsSortViewModelPageBuilder
        ];

        $this->pageConfigurations[config('custom.pages.AUTH_PROJECT_IMAGES')] = [
            'config' => config('pages.auth.project-images'),
            'viewModelPageBuilder' => $authProjectImagesViewModelPageBuilder
        ];

    }

    /**
     * @param int $pageId
     * @return PageEntity
     */
    public function getPageById($pageId) {
        return $this->createPageById($pageId);
    }


    /**
     * @param int $pageId
     * @return PageEntity|null
     */
    private function createPageById($pageId) {
        try {
            $outcome = new PageEntity();
            $pageConfiguration = $this->pageConfigurations[$pageId]['config'];
            $outcome->id = $pageConfiguration['id'];
            $outcome->htmlTitle = !empty($pageConfiguration['htmlTitleKey']) ? __($pageConfiguration['htmlTitleKey']) : __(config('custom.web.htmlTitleKey'));
            $outcome->htmlMetaDescription = !empty($pageConfiguration['htmlMetaDescriptionKey']) ? __($pageConfiguration['htmlMetaDescriptionKey']) : __(config('custom.web.htmlMetaDescriptionKey'));
            $outcome->htmlMetaKeywords = !empty($pageConfiguration['htmlMetaKeywordsKey']) ? __($pageConfiguration['htmlMetaKeywordsKey']) : __(config('custom.web.htmlMetaKeywordsKey'));
            $outcome->title = __($pageConfiguration['titleKey']);
            $outcome->description = __($pageConfiguration['descriptionKey']);
            $outcome->shortName = __($pageConfiguration['shortNameKey']) == $pageConfiguration['shortNameKey'] ? __($pageConfiguration['titleKey']) : __($pageConfiguration['shortNameKey']);
            $outcome->viewPath = $pageConfiguration['viewPath'];
            $outcome->currentLanguage = $this->languageService->getCurrentLanguage();
            $outcome->viewModelPageBuilder = $this->pageConfigurations[$pageId]['viewModelPageBuilder'];
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

}
