let self = undefined;
export default class ImageCarouselView {
    
    constructor(options) {
        this.deviceTypes = {
            MOBILE: 1,
            DESKTOP: 2
        };

        this.mobileScreenMaxSize = options.mobileScreenMaxSize;

        //texts
        this.tdatamobile = "m";
        this.tdatadesktop = "d";
        this.timg = "img";
        this.tdevice = "device";
        this.tresize = "resize";
        this.tdataSrc = "data-src";

        //selectors
        this.carouselSelector = options.carouselSelector;

        //plugin classes
        this.owlCarouselClass = "owl-carousel";
        this.owlLazyClass = "owl-lazy";

        //DOM
        this.$carouselWrapper = $(this.carouselSelector);
        this.$imageList = this.$carouselWrapper.find(this.timg);

        self = this;
    }

    getCarouselWrapper() {
        return $(this.carouselSelector);
    }

    isMobileScreen() {
        return $(window).width() <= this.mobileScreenMaxSize;
    }

    areMobileImagesAlreadyShown() {
        return this.getDeviceTypeSettedUp() === this.deviceTypes.MOBILE;
    }

    showImagesForMobileScreen() {
        this.setDeviceTypeSettedUp(this.deviceTypes.MOBILE);

        this.$imageList.each((index, image) => {
            let $image = $(image);
            let imageUrl = $image.data(this.tdatamobile);
            this.showImagesByUrls($image, imageUrl)

        });
    }

    areDesktopImagesAlreadyShown() {
        return this.getDeviceTypeSettedUp() === this.deviceTypes.DESKTOP;
    }

    showImagesForNoMobileScreen() {
        this.setDeviceTypeSettedUp(this.deviceTypes.DESKTOP);

        this.$imageList.each((index, image) => {
            let $image = $(image);
            let imageUrl = $image.data(this.tdatadesktop);
            this.showImagesByUrls($image, imageUrl)

        });
    }

    addCarouselPluginClasses() {
        if (!this.$carouselWrapper.hasClass(this.owlCarouselClass)) {
            this.$carouselWrapper.addClass(this.owlCarouselClass);
        }

        this.$imageList.each((index, image) => {
            let $image = $(image);
            if (!$image.hasClass(this.owlLazyClass)) {
                $image.addClass(this.owlLazyClass);
            }

        });

    }

    showSlider() {
        this.$carouselWrapper.show();
    }

    hideSlider() {
        this.$carouselWrapper.hide();
    }

    //#region private functions

    showImagesByUrls($image, imageUrl) {
        $image.attr(this.tdataSrc, imageUrl);
    }

    getDeviceTypeSettedUp() {
        return this.$carouselWrapper.data(this.tdevice);
    }

    setDeviceTypeSettedUp(deviceType) {
        this.$carouselWrapper.data(this.tdevice, deviceType);
    }

    //#endregion private functions

}
