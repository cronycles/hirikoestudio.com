<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Locale extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name'
    ];

}
