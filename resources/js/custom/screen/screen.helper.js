export default class ScreenHelper {

    #mobileScreenMaxSize;

    constructor() {
        #mobileScreenMaxSize = 767;
    }

    isMobileScreen() {
        return $(window).width() <= this.mobileScreenMaxSize;
    }
}
