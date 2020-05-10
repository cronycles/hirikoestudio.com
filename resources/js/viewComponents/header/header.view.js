
export default class HeaderView {

    constructor() {
        //Texts
        this.tclick = 'click';
        this.topen = 'open';
        this.tclosed = 'closed';
        this.ticon = 'i';

        //Selectors
        this.headerSelector = '.jheader';
        this.burgerButtonSelector = '.jburgerBtn';
        this.navMenuSelector = '.jnavContainer';

        this.dropdownButtonSelector = '.jdropdownButton';
        this.dropdownContentSelector = ".jdropdownListContainer";

        //DOM
        this.$header = $(this.headerSelector);
        this.$burgerButton = this.$header.find(this.burgerButtonSelector);
        this.$navMenu = this.$header.find(this.navMenuSelector);

        this.$dropdownButtons = this.$header.find(this.dropdownButtonSelector);

    }

    onBurgerButtonClick = (callback) => {
        this.$burgerButton.off(this.tclick).on(this.tclick, (e) =>{
            callback();
            return false;
        });
    };

    isNavMenuOpened = () => {
        return this.$navMenu.hasClass(this.topen);
    };

    closeNavMenu = () => {
        this.$navMenu.width('0');
        this.$navMenu.removeClass(this.topen);
        this.#setBurgerButtonMenuClosedIcon();
    };

    openNavMenu = () => {
        this.$navMenu.width('100%');
        this.$navMenu.addClass(this.topen);
        this.#setBurgerButtonMenuOpenIcon();
    };

    onDropDownButtonClick = (callback) => {
        this.$dropdownButtons.off(this.tclick).on(this.tclick, (e) =>{
            const dropdownButtonSelector = e.currentTarget;
            callback(dropdownButtonSelector);
            return false;
        });
    };

    isDropDownButtonOpened = (dropdownButtonSelector) => {
        const $dropdownContent = $(dropdownButtonSelector).next(this.dropdownContentSelector);
        return $dropdownContent.hasClass(this.topen);
    };

    closeDropDownMenu = (dropdownButtonSelector) => {
        const $dropdownContent = $(dropdownButtonSelector).next(this.dropdownContentSelector);
        $dropdownContent.hide();
        $dropdownContent.removeClass(this.topen);
        this.#setDropdownClosedIcon(dropdownButtonSelector);
    };

    openDropDownMenu = (dropdownButtonSelector) => {
        const $dropdownContent = $(dropdownButtonSelector).next(this.dropdownContentSelector);
        $dropdownContent.show();
        $dropdownContent.addClass(this.topen);
        this.#setDropdownOpenIcon(dropdownButtonSelector);
    };

    #setBurgerButtonMenuClosedIcon() {
        const $icon = this.$burgerButton.find(this.ticon);
        $icon.removeClass($icon.data(this.topen));
        $icon.addClass($icon.data(this.tclosed));
    }

    #setBurgerButtonMenuOpenIcon() {
        const $icon = this.$burgerButton.find(this.ticon);
        $icon.removeClass($icon.data(this.tclosed));
        $icon.addClass($icon.data(this.topen));
    }

    #setDropdownClosedIcon(dropdownButtonSelector) {
        const $dropdownButton = $(dropdownButtonSelector);
        const $icon = $dropdownButton.find(this.ticon);
        $icon.removeClass($icon.data(this.topen));
        $icon.addClass($icon.data(this.tclosed));
    }

    #setDropdownOpenIcon(dropdownButtonSelector) {
        const $dropdownButton = $(dropdownButtonSelector);
        const $icon = $dropdownButton.find(this.ticon);
        $icon.removeClass($icon.data(this.tclosed));
        $icon.addClass($icon.data(this.topen));
    }


}
