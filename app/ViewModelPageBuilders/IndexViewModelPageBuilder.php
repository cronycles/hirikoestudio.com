<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModels\Pages\Index\IndexViewModel;
use App\ViewModels\Pages\Index\SlideViewModel;
use App\ViewModels\Pages\PageViewModel;

class IndexViewModelPageBuilder extends ViewModelPageBuilder {

    public function __construct() {

    }

    public function createNewViewModel() {
        return new IndexViewModel();
    }

    /**
     * @param IndexViewModel $pageViewModel
     * @param array $params
     * @return IndexViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $imageBaseUrl = config('custom.images.static.homeSlidesUrl');
        $numberOfSlidesToShow = config('pages.index.slidesNumber');

        for ($i = 0; $i < $numberOfSlidesToShow; $i++) {
            $slide = new SlideViewModel();
            $slide->imageAltText = config('custom.company.name');
            $slidePartialName = $imageBaseUrl . '/home-slide' . ($i + 1);
            $slide->imageDesktopUrl = $slidePartialName . "-d.jpg";
            $slide->imageMobileUrl = $slidePartialName . "-m.jpg";

            array_push($pageViewModel->slides, $slide);
        }

        return $pageViewModel;
    }

}
