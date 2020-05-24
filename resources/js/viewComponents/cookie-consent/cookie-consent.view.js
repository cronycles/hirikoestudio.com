export default class CookieConsentView {
    constructor() {
        //Texts
        this.tclick = 'click';
        this.topen = 'open';
        this.tclosed = 'closed';
        this.ticon = 'i';

        //Selectors
        this.cookieConsentSelector = '.jcookieConsent';
        this.cookieAcceptButtonSelector = '.jcookieAccept';

        //DOM
        this.$cookieConsent = $(this.cookieConsentSelector);
        this.$cookieAcceptButton = this.$cookieConsent.find(this.cookieAcceptButtonSelector);

    }

    onAcceptButtonClick = (callback) => {
        this.$cookieAcceptButton.off(this.tclick).on(this.tclick, () => {
            callback();
            return false;
        })
    };

    showCookieBanner = () => {
        this.$cookieConsent.delay(1000).fadeIn();
    };

    hideCookieBanner = () => {
        this.$cookieConsent.hide();
    };
}
