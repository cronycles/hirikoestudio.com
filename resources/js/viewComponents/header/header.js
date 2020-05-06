import HeaderView from "./header.view";

export default class Header {
    #view;
    constructor() {

        this.#view = new HeaderView();

        this.#view.onBurgerButtonClick(() => {
            if(this.#view.isNavMenuOpened()) {
                this.#view.closeNavMenu();
            }
            else {
                this.#view.openNavMenu();
            }
        });

        this.#view.onDropDownButtonClick((dropdownButtonSelector) => {
            if(this.#view.isDropDownButtonOpened(dropdownButtonSelector)) {
                this.#view.closeDropDownMenu(dropdownButtonSelector);
            }
            else {
                this.#view.openDropDownMenu(dropdownButtonSelector);
            }
        });
    }
}
