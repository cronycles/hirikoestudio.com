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

        //Classes
        this.tnoneClass = "none";

        this.$wrapper = $(containerSelector);
        this.$figures = this.$wrapper.find('figure');
    }

    isMobileScreen = () => {
        return $(window).width() <= this.mobileScreenMaxSize;
    };

    areMobileImagesAlreadyShown = () => {
        return this.#getDeviceTypeSetUp() === this.#DEVICE_TYPE.MOBILE;
    };

    setImagesForMobileScreen = () => {
        this.#setDeviceTypeSetUp(this.#DEVICE_TYPE.MOBILE);

        this.$figures.each((index, figure) => {
            let $figure = $(figure);
            let $image = $figure.find('img');
            let isMobile = $image.data(this.tdatamobile);
            if(!isMobile) {
                $figure.remove()
            }
            else {
                $figure.removeClass(this.tnoneClass)
            }
        });
    };

    areDesktopImagesAlreadyShown = () => {
        return this.#getDeviceTypeSetUp() === this.#DEVICE_TYPE.DESKTOP;
    };

    setImagesForNoMobileScreen = () => {
        this.#setDeviceTypeSetUp(this.#DEVICE_TYPE.DESKTOP);

        this.$figures.each((index, figure) => {
            let $figure = $(figure);
            let $image = $figure.find('img');
            let isMobile = $image.data(this.tdatamobile);
            if(isMobile) {
                $figure.remove()
            }
            else {
                $figure.removeClass(this.tnoneClass)
            }
        });
    };

    #getDeviceTypeSetUp() {
        return this.$wrapper.data(this.tdevice);
    }

    #setDeviceTypeSetUp(deviceType) {
        this.$wrapper.data(this.tdevice, deviceType);
    }
}
