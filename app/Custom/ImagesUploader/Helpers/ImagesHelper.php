<?php

namespace App\Custom\ImagesUploader\Helpers;

use Illuminate\Http\UploadedFile;

class ImagesHelper {

    public function __construct() {
    }

    public function createNewJpgFileName(UploadedFile $file) {
        $name = md5_file($file);
        $name = time() . $name;
        return $name . ".jpg";
    }
}
