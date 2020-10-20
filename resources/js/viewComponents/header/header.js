import HeaderView from "./header.view";
import ScreenHelper from "../../custom/screen/screen.helper";

export default class Header {
    #view;

    constructor() {

        this.#view = new HeaderView();

        this.screenHelper = new ScreenHelper();

        this.invertSlideByScrollPosition();
        this.screenHelper.onScroll(this.invertSlideByScrollPosition);
        this.screenHelper.onResizeEnd(this.invertSlideByScrollPosition);

        this.#view.onBurgerButtonClick(() => {
            if (this.#view.isNavMenuOpened()) {
                this.#view.closeNavMenu();
            } else {
                this.#view.openNavMenu();
            }
        });

        this.#view.onDropDownButtonClick((dropdownButtonSelector) => {
            if (this.#view.isDropDownButtonOpened(dropdownButtonSelector)) {
                this.#view.closeDropDownMenu(dropdownButtonSelector);
            } else {
                this.#view.openDropDownMenu(dropdownButtonSelector);
            }
        });
    }

    invertSlideByScrollPosition = () => {
        if (this.#view.isThereSliderPresent()) {

            if (this.#view.isHeaderScrollHigherThanSlider()) {
                this.#view.removeHeaderInversion();
            } else {
                this.#view.applyHeaderInversion();
            }
        }
    }
}
