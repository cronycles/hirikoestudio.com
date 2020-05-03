import PageAuthLogin from "./auth/login";
import PageAuthIndex from "./auth";
import PageAuthRegister from "./auth/register";
import PageAuthForgotPassword from "./auth/forgot.password";
import PageAuthResetPassword from "./auth/reset.password";

export default class PageFactory {
    constructor() {
        this.pages = [
            {id: 1001, className: PageAuthLogin},
            {id: 1002, className: PageAuthRegister},
            {id: 1003, className: PageAuthForgotPassword},
            {id: 1004, className: PageAuthResetPassword},
            {id: 1010, className: PageAuthIndex}
        ]
    }

    bindCurrentPageModule() {
        try {
            const currentPageId = this.#getCurrentPageId();

            if (currentPageId) {
                this.pages.map(page => {
                    if (page && page.id == currentPageId) {
                        const pageClassName = page.className;
                        new pageClassName();
                    }
                })
            }
            else {
                log.error("currentPageName not found");
            }
        } catch (e) {
            log.error(e);
        }

    }

    #getCurrentPageId = () => {
        let outcome = null;
        const $page = $(".jpage");
        if ($page) {
            outcome = $page.data('p');
        }
        return outcome;
    };

}
