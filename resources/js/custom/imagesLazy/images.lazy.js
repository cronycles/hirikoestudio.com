require('jquery-lazy');

export default class ImagesLazy {
    constructor() {
    }

    loadAllLazyImagesIntoThePage() {
        $('.jlimg').Lazy();
    }

}
