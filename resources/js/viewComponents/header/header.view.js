
export default class HeaderView {

    constructor() {
        //Texts
        this.tclick = 'click';
        this.topen = 'open';
        this.tclosed = 'closed';
        this.ticon = 'i';
        this.tnone = "none";

        //Classes
        this.headerInverseClass = "inverted";

        //Selectors
        this.sliderSelector = '.jslider';
        this.headerSelector = '.jheader';
        this.burgerButtonSelector = '.jburgerBtn';
        this.navMenuSelector = '.jnavContainer';
        this.normalLogoSelector = ".jlnorm";
        this.invertedLogoSelector = ".jlinv";

        this.dropdownButtonSelector = '.jdropdownButton';
        this.dropdownContentSelector = ".jdropdownListContainer";

        //DOM
        this.$slider = $(this.sliderSelector);
        this.$header = $(this.headerSelector);
        this.$burgerButton = this.$header.find(this.burgerButtonSelector);
        this.$navMenu = this.$header.find(this.navMenuSelector);
        this.$normalLogo = this.$header.find(this.normalLogoSelector);
        this.$invertedLogo = this.$header.find(this.invertedLogoSelector);

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

    isThereSliderPresent = () => {
        return this.$slider && this.$slider.length > 0;
    }

    isHeaderScrollHigherThanSlider = () => {
        let outcome = false;
        const currentScrollPosition = $(document).scrollTop();
        const sliderHeight = this.$slider.outerHeight();
        if(sliderHeight && currentScrollPosition >= (sliderHeight - 50)){
            outcome = true;
        }
        return outcome;
    };

    removeHeaderInversion = () => {
        this.$header.removeClass(this.headerInverseClass);
        this.$invertedLogo.addClass(this.tnone);
        this.$normalLogo.removeClass(this.tnone);
    };

    applyHeaderInversion = () => {
        this.$header.addClass(this.headerInverseClass);
        this.$invertedLogo.removeClass(this.tnone);
        this.$normalLogo.addClass(this.tnone);
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
