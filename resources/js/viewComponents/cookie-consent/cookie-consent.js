import CookieConsentView from "./cookie-consent.view";
import CookieService from "../../custom/cookie/cookie.service";

export default class CookieConsent {
    #view;

    constructor() {

        this.#view = new CookieConsentView();
        this.cookieService = new CookieService();

        if (this.#doIHaveToShowCookieBanner()) {
            this.#view.showCookieBanner();
        }

        this.#view.onAcceptButtonClick(() => {
            this.#view.hideCookieBanner();
            this.#saveUserAcceptedCookies();
        })
    }

    #doIHaveToShowCookieBanner = () => {
        return this.cookieService.getCookie("cookieSeen") != 1;
    };

    #saveUserAcceptedCookies = () => {
        this.cookieService.setCookie("cookieSeen", 1);
    };
}
