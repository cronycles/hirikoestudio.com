<?php

namespace App\Custom\Languages\Entities;

class LanguageEntity {

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $text;

    /**
     * @var bool
     */
    public $isCurrent;

    public function __construct(string $id, string $text) {
        $this->id = $id;
        $this->text = $text;
        $this->isCurrent = false;
    }
}
