require('owl.carousel/dist/owl.carousel.min');

import imageCarouselOptions from './cro.image.carousel.options';
import ImageCarouselView from './cro.image.carousel.view';
import { debounce } from 'throttle-debounce';

export default class ImageCarousel {
    constructor(userOptions) {
        this.options = this.initializeOptions(userOptions, imageCarouselOptions);
       

        this.owlCarouselEventInitialized = 'initialized.owl.carousel';
        this.owlCarouselEventResized = 'resized.owl.carousel';
        this.owlCarouselEventDestroy = 'destroy.owl.carousel';

        this.view = new ImageCarouselView(this.options);

        this.initializeCarousel(this.options);
    }

    initializeOptions(userOptions, defaultOptions) {
        let outcome = defaultOptions;

        $.extend(outcome, userOptions);

        return outcome;
    }

    initializeCarousel(options) {
        this.view.hideSlider();
        this.setImagesBasedOnScreenSize(options);

        let $carouselWrapper = this.view.getCarouselWrapper();

        this.initializeOwlCarouselPlugin($carouselWrapper, options);
    }

    initializeOwlCarouselPlugin($carouselWrapper, options) {

        this.view.addCarouselPluginClasses();

        $carouselWrapper.on(this.owlCarouselEventInitialized, (event) => {
            this.view.showSlider();
        });

        $carouselWrapper.owlCarousel(options);

        $carouselWrapper.on("drag.owl.carousel", (event) => {
            $carouselWrapper.trigger('stop.owl.autoplay');
        });

        $carouselWrapper.on(this.owlCarouselEventResized, debounce(options.debounceTime, () => {
            if (this.doesPluginBeReset(options)) {
                this.resetOwlCarouselPlugin($carouselWrapper, options);
            }
        }))


    }

    resetOwlCarouselPlugin($carouselWrapper, options) {
        this.view.hideSlider();
        $carouselWrapper.trigger(this.owlCarouselEventDestroy);
        this.setImagesBasedOnScreenSize(options);
        this.initializeOwlCarouselPlugin($carouselWrapper, options);
    }

    doesPluginBeReset(options) {
        let outcome = false;

        if (options.imageForScreen) {
            if (this.view.isMobileScreen()) {
                if (!this.view.areMobileImagesAlreadyShown()) {
                    outcome = true;
                }
            }
            else {
                if (!this.view.areDesktopImagesAlreadyShown()) {
                    outcome = true;
                }
            }
        }

        return outcome;
    }

    setImagesBasedOnScreenSize(options) {
        if (options.imageForScreen) {
            if (this.view.isMobileScreen()) {
                if (!this.view.areMobileImagesAlreadyShown()) {
                    this.view.showImagesForMobileScreen();
                }
            }
            else {
                if (!this.view.areDesktopImagesAlreadyShown()) {
                    this.view.showImagesForNoMobileScreen();
                }
            }
        }
    }
}
