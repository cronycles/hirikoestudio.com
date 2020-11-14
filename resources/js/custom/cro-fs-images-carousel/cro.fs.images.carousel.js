import {tns} from 'tiny-slider/src/tiny-slider';
import CroDeviceImagesHelper from "../cro-device-images-helper/cro.device.images.helper";
export default class CroFullScreenImagesCarousel {
    #container;
    constructor(customOptions = {}) {

        let defaultOptions = {
            container: '.cro-fs-images-carousel',
            items: 1,
            slideBy: 'page',
            mode: 'gallery',
            speed: "1000",
            controls: false,
            nav: false,
            autoplayButtonOutput: false,
            autoplay: true,
            mouseDrag: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: false,
            lazyload: true,
        };

        let mergedOptions = {...defaultOptions, ...customOptions };

        this.#container = mergedOptions.container;

        const croDeviceImagesHelper = new CroDeviceImagesHelper(this.#container);
        croDeviceImagesHelper.setImagesBasedOnScreen();

        var slider = tns(mergedOptions);
    }

}
