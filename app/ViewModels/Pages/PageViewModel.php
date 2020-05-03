<?php

namespace App\ViewModels\Pages;

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
     * @var string
     */
    public $currentLanguageId;

    /**
     * @var BreadcrumbViewModel[]
     */
    public $breadcrumbs;

    public function __construct() {
        $this->breadcrumbs = [];
    }
}
