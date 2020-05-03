<?php

namespace App\Custom\CRUD\ViewModels;

class CrudTableItemViewModel {

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $editText;

    /**
     * @var string
     */
    public $editUrl;

    /**
     * @var string
     */
    public $deleteText;

    /**
     * @var string
     */
    public $deleteUrl;

    /**
     * @var string
     */
    public $imagesText;

    /**
     * @var string
     */
    public $imagesUrl;

    public function __construct() {
        $this->editText = __('crud-table.item.defaultEditText');
        $this->deleteText = __('crud-table.item.defaultDeleteText');
        $this->deleteText = __('crud-table.item.defaultImagesText');
    }
}
