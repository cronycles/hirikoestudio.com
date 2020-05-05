import NavbarView from "./navbar.view";

export default class Navbar {
    #view;
    constructor() {

        this.#view = new NavbarView();

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
