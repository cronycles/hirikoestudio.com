<?php

namespace App\Custom\Form\Models\Fields;

class SelectboxFieldModel extends FieldWithModel {

    /**
     * @var string
     */
    public $zeroValueText;

    public function __construct() {
        parent::__construct();
    }

}
