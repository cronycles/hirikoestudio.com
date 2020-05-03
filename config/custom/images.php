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
        'logo94x94Url' => $imagesBaseUrl . '/logo94x94.svg',
        'logoGreeen94x94Url' => $imagesBaseUrl . '/logoGreen94x94.svg',
        'defaultLazyPlaceholder' => $imagesBaseUrl . '/lazy-img-placeholder.png',
        'defaultImageUrl' => $imagesBaseUrl . '/defaultImage_570x370.png',
        'luigiECarloUrl' => $imagesBaseUrl . '/luigi-carlo.jpg',
        'footerMapUrl' => $imagesBaseUrl . '/footer_map_570x400.jpg',
    ]
];
