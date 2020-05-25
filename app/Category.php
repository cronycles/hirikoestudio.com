<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class Category
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property int $order_number
 */
class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name'
    ];

}
