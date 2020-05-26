<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class Project
 * @package App
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $order_number
 * @property boolean $show
 * @property boolean $show_in_home
 * @property Category $category
 * @property Image[] $images
 */
class Project extends Model
{
    use HasTranslations;

    public $translatable = ['description'];

    protected $fillable = [
        'title',
        'slug',
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
