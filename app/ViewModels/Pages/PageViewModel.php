<?php

namespace App\ViewModels\Pages;

use App\ViewModels\Language\LanguageViewModel;

class PageViewModel {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $htmlTitle;

    /**
     * @var string
     */
    public $htmlMetaDescription;

    /**
     * @var string
     */
    public $htmlMetaKeywords;

    /**
     * @var string
     */
    public $ogImageUrl;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $viewPath;

    /**
     * @var LanguageViewModel
     */
    public $currentLanguage;

    /**
     * @var BreadcrumbViewModel[]
     */
    public $breadcrumbs;

    /**
     * @var RouteUrlViewModel
     */
    public $canonicalRouteUrl;

    /**
     * @var RouteUrlViewModel[]
     */
    public $hreflangRouteUrls;

    public function __construct() {
        $this->breadcrumbs = [];
        $this->hreflangRouteUrls = [];
    }
}
