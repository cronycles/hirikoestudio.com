<?php

namespace App\Entities;

use App\Custom\Entities\CustomEntity;

class ContactEntity extends CustomEntity {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $telephone;

    /**
     * @var string
     */
    public $message;

    public function __construct() {
    }

}
