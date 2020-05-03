import CaptchaView from './captcha.view';

export default class Captcha {
    #view;
    #isReady;
    #didWaitOnce;

    constructor() {
        this.#view = new CaptchaView();
        this.#isReady = false;
        this.#didWaitOnce = false;

        if (typeof grecaptcha !== 'undefined') {
            grecaptcha.ready(() => {
                this.#isReady = true;
            });
        }
    }

    isEnabled = (formId) => {
        return this.#view.isCaptchaEnabled(formId);
    };

    executeCaptcha = async (formId) => {
        try {
            if (this.#isReady) {
                return await this.#executeRecaptcha(formId);
            }
            else {
                if (!this.#didWaitOnce) {
                    this.#didWaitOnce = true;
                    return setTimeout(() => {
                        return this.#executeRecaptcha(formId);
                    }, 5000);
                }
            }
        }catch (e) {
            log.error(e);
            return false;
        }

    };

    #executeRecaptcha = async (formId) => {
        try {
            const key = this.#view.getKey(formId);
            const token = await grecaptcha.execute(key, {action: formId});
            this.#view.addTokenToCaptchaInput(formId, token);
            return true;
        }catch (e) {
            log.error(e);
            return false;
        }

    }




};
