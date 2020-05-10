<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasTranslations;

    public $translatable = ['description'];

    protected $fillable = [
        'title',
        'description',
        'order_number',
        'show',
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function images() {
        return $this->belongsToMany('App\Image')
            ->withPivot('image_order', 'image_small_view')
            ->withTimestamps()
            ->orderBy('pivot_image_order', 'asc');
    }
}
