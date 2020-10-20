import {debounce, throttle} from "throttle-debounce";

export default class ScreenHelper {

    constructor() {
        this.mobileScreenMaxSize = 767;
    }

    isMobileScreen() {
        return $(window).width() <= this.mobileScreenMaxSize;
    }

    onScroll(callback) {
        let throttleIt = throttle(200, false, callback);
        $(window).scroll((event) => {
            throttleIt();
        });
    }

    onResizeEnd(callback) {
        let rtime;
        let timeout = false;
        let delta = 200;
        $(window).resize(function() {
            rtime = new Date();
            if (timeout === false) {
                timeout = true;
                setTimeout(resizeend, delta);
            }
        });

        function resizeend() {
            if (new Date() - rtime < delta) {
                setTimeout(resizeend, delta);
            } else {
                timeout = false;
                callback();
            }
        }
    }
}
