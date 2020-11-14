<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CarouselImage
 * @package App
 * @property int $id
 * @property int $order_number
 * @property boolean $is_mobile
 * @property Image $image
 */
class CarouselImage extends Model
{
    protected $fillable = [
        'order_number',
        'is_mobile'
    ];


    public function image() {
        return $this->hasOne('App\Image', "id", "image_id");
    }
}
