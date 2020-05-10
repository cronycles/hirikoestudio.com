<?php

$uploadedImagesPath = config('custom.cdnsite.path') . '/upload/images';

$uploadedImagesUrl = config('custom.cdnsite.url') . '/upload/images';
$imagesBaseUrl = config('custom.cdnsite.url') . '/images';

return [
    'uploadedImagePath' => $uploadedImagesPath,
    'uploadedImagesUrl' => $uploadedImagesUrl,

    'imagesBaseUrl' => $imagesBaseUrl,
    'partnersUrl' => $imagesBaseUrl . '/partners',

    'upload' => [
        'maxNumberOfFiles' => 10,
        'maxImagSize' => 1500
    ],

    'static' => [
        'defaultLazyPlaceholder' => $imagesBaseUrl . '/lazy-img-placeholder.png',
        'logoBlack' => $imagesBaseUrl . '/logo_black.svg',
        'logoWhite' => $imagesBaseUrl . '/logo_white.svg',
        'shopWindow' => $imagesBaseUrl . '/shop-ext-contact.jpg',
        'defaultProjectImage' => $imagesBaseUrl . '/defaultProjectImage_560x360.jpg',
        'homeSlide1' => $imagesBaseUrl . '/home-slide1.jpg',
        'homeSlide2' => $imagesBaseUrl . '/home-slide2.jpg',
        'homeSlide3' => $imagesBaseUrl . '/home-slide3.jpg',
    ]
];
