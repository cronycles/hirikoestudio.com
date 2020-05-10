import {tns} from 'tiny-slider/src/tiny-slider';
export default class CroFullScreenImagesCarousel {
    constructor(customOptions = {}) {

        let defaultOptions = {
            container: '.cro-fs-images-carousel',
            items: 1,
            slideBy: 'page',
            controls: false,
            nav: false,
            autoplayButtonOutput: false,
            autoplay: true,
            mouseDrag: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: false
        };

        let mergedOptions = {...defaultOptions, ...customOptions };

        var slider = tns(mergedOptions);
    }

}
