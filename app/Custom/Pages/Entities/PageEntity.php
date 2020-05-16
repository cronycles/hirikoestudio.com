<?php


namespace App\Custom\Pages\Entities;


use App\Custom\Languages\Entities\LanguageEntity;
use App\Custom\Pages\Builders\ViewModelPageBuilder;

class PageEntity {

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
    public $shortName;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $viewPath;

    /**
     * @var LanguageEntity
     */
    public $currentLanguage;

    /**
     * @var ViewModelPageBuilder
     */
    public $viewModelPageBuilder;

}
