require('jquery-lazy');

export default class ImagesLazy {
    constructor() {
    }

    loadAllLazyImagesIntoThePage() {
        $('.jlimg').Lazy();

        $('.jlimg1000').Lazy({
            effect: 'fadeIn',
            effectTime: 1000,
            threshold: 0
        });
    }

}
