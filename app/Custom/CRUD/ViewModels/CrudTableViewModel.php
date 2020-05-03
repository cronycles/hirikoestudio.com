<?php

namespace App\Custom\CRUD\ViewModels;

class CrudTableViewModel {

    /**
     * @var string
     */
    public $nameTitle;

    /**
     * @var string
     */
    public $editTitle;

    /**
     * @var string
     */
    public $imagesTitle;

    /**
     * @var string
     */
    public $deleteTitle;

    /**
     * @var boolean
     */
    public $isEditingEnabled;

    /**
     * @var boolean
     */
    public $isImagesEditingEnabled;

    /**
     * @var boolean
     */
    public $isDeletingEnabled;

    /**
     * @var CrudTableItemViewModel[]
     */
    public $items;


    public function __construct() {
        $this->items = [];
        $this->nameTitle = __('crud-table.defaultNameTitle');
        $this->editTitle = __('crud-table.defaultEditTitle');
        $this->imagesTitle = __('crud-table.defaultImagesTitle');
        $this->deleteTitle = __('crud-table.defaultDeleteTitle');

        $this->isEditingEnabled = false;
        $this->isImagesEditingEnabled = false;
        $this->isDeletingEnabled = false;
    }
}
