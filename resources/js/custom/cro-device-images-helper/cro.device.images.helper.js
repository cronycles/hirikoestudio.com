import CroDeviceImagesHelperView from "./cro.device.images.helper.view";

export default class CroDeviceImagesHelper {

    #view;
    constructor(containerSelector) {
        this.#view = new CroDeviceImagesHelperView(containerSelector);
    }

    setImagesBasedOnScreen() {
        if (this.#view.isMobileScreen()) {
            if (!this.#view.areMobileImagesAlreadyShown()) {
                this.#view.setImagesForMobileScreen();
            }
        } else {
            if (!this.#view.areDesktopImagesAlreadyShown()) {
                this.#view.setImagesForNoMobileScreen();
            }
        }
    }

}
