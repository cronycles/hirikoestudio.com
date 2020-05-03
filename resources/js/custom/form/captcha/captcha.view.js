
export default class CaptchaView {
    constructor() {
        //texts
        this.tkey = 'key';
        this.tform = 'form';

         //selectors
        this.captchaSelector = '.jcaptcha';

        //DOM
        this.$captchaFields = $(this.captchaSelector);


    }

    isCaptchaEnabled = (formId) => {
        let outcome = false;
        var captchaField = this.#getCaptchaFieldByFormId(formId);
        if(captchaField && captchaField.length > 0) {
            outcome = true;
        }
        return outcome;
    };

    getKey = (formId) => {
        var captchaField = this.#getCaptchaFieldByFormId(formId);
        const outcome = $(captchaField).data(this.tkey);
        return outcome;
    };

    addTokenToCaptchaInput = (formId, token) => {
        var captchaField = this.#getCaptchaFieldByFormId(formId);
        $(captchaField).val(token);
    };

    #getCaptchaFieldByFormId = (formId) => {
        return this.$captchaFields.filter((index, element) => {
            return $(element).data(this.tform) === formId;
        });
    };

};
