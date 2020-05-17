export default class CroDeviceImagesHelperView {

    #DEVICE_TYPE;

    constructor(containerSelector) {
        this.mobileScreenMaxSize = 767;

        this.#DEVICE_TYPE = {
            MOBILE: 1,
            DESKTOP: 2
        };

        //Texts
        this.tdevice = "device";
        this.tdatamobile = "m";
        this.tdatadesktop = "d";
        this.tdataSrc = "data-src";

        this.$wrapper = $(containerSelector);
        this.$images = this.$wrapper.find('img');
    }

    isMobileScreen = () => {
        return $(window).width() <= this.mobileScreenMaxSize;
    };

    areMobileImagesAlreadyShown = () => {
        return this.#getDeviceTypeSetUp() === this.#DEVICE_TYPE.MOBILE;
    };

    setImagesForMobileScreen = () => {
        this.#setDeviceTypeSetUp(this.#DEVICE_TYPE.MOBILE);

        this.$images.each((index, image) => {
            let $image = $(image);
            let imageUrl = $image.data(this.tdatamobile);
            this.#setImagesByUrls($image, imageUrl)

        });
    };

    areDesktopImagesAlreadyShown = () => {
        return this.#getDeviceTypeSetUp() === this.#DEVICE_TYPE.DESKTOP;
    };

    setImagesForNoMobileScreen = () => {
        this.#setDeviceTypeSetUp(this.#DEVICE_TYPE.DESKTOP);

        this.$images.each((index, image) => {
            let $image = $(image);
            let imageUrl = $image.data(this.tdatadesktop);
            this.#setImagesByUrls($image, imageUrl)

        });
    };

    #getDeviceTypeSetUp() {
        return this.$wrapper.data(this.tdevice);
    }

    #setDeviceTypeSetUp(deviceType) {
        this.$wrapper.data(this.tdevice, deviceType);
    }

    #setImagesByUrls($image, imageUrl) {
        $image.attr(this.tdataSrc, imageUrl);
    }
}
