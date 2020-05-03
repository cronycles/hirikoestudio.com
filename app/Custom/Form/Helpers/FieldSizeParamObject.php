<?php

namespace App\Custom\Form\Helpers;

class FieldSizeParamObject {

    /**
     * @var string
     */
    public  $min;

    /**
     * @var string
     */
    public  $max;

    /**
     * @var string
     */
    public  $same;

    /**
     * @var string
     */
    public  $dateEquals;

    /**
     * @var string
     */
    public  $after;

    /**
     * @var string
     */
    public  $before;

    /**
     * FieldSizeParamObject constructor.
     * @param string|null $same
     * @param string|null $min
     * @param string|null $max
     */
    public function __construct($same = null, $min = null, $max = null) {
        $this->same = $same;
        $this->min = $min;
        $this->max = $max;
        $this->dateEquals = null;
        $this->after = null;
        $this->before = null;
    }

}
