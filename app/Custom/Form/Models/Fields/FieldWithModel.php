<?php

namespace App\Custom\Form\Models\Fields;

abstract class FieldWithModel extends FieldModel {

    /**
     * @var int
     */
    public $selectedId;


    /**
     * @var FieldModel[]
     */
    public $items;

    public function __construct() {
        parent::__construct();
        $this->items = [];
        $this->selectedId = 0;
    }


}
