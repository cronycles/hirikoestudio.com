<?php

namespace App\Custom\ImagesUploader\ViewModels;

class ImagesUploaderViewModel {

    /**
     * Lista di immagini da mostrare
     * @var ImageViewModel[]
     */
    public $images;

    /**
     * Url della api di upload delle immagini
     * @var string
     */
    public $uploadApiUrl;

    /**
     * Url della api di upload dell nuovo ordine delle immagini
     * @var string
     */
    public $updateSortApiUrl;

    /**
     * Numero massimo di files da caricare
     * @var int
     */
    public $maxNumberOfFiles;

    /**
     * with massimo della immagine
     * @var string
     */
    public $maxWidthPx;

    public function __construct() {
        $this->images = [];
    }

}
