<?php

namespace App\Entities;

use App\Custom\Entities\CustomEntity;

class UserEntity extends CustomEntity {

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var bool
     */
    public $remember;

    public function __construct() {
    }

}
