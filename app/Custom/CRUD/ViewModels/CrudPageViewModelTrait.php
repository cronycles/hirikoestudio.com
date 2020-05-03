<?php

namespace App\Custom\CRUD\ViewModels;

use App\Custom\CRUD\ViewModels\CrudLinkViewModel;
use App\Custom\CRUD\ViewModels\CrudTableViewModel;

trait CrudPageViewModelTrait  {

    /**
     * @var CrudLinkViewModel
     */
    public $createLink;

    /**
     * @var CrudLinkViewModel
     */
    public $sortLink;

    /**
     * @var CrudTableViewModel
     */
    public $crudTable;

    public function __construct() {
    }

}
