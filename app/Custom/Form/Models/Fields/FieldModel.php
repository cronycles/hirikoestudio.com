<?php

namespace App\Custom\Form\Models\Fields;

abstract class FieldModel {

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $localeCode;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $errorText;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $validations;

    /**
     * FieldViewModel constructor.
     */
    public function __construct() {
        $this->value = "";
    }


}
