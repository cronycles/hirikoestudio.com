export default class ScreenHelper {

    constructor() {
        this.mobileScreenMaxSize = 767;
    }

    isMobileScreen() {
        return $(window).width() <= this.mobileScreenMaxSize;
    }
}
