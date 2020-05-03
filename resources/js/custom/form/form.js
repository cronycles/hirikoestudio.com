import Wysiwyg from "./wysiwyg";
import FormValidator from "./form.validator";
import FormView from "./form.view";
import Captcha from "./captcha/captcha";


export default class Form {
    #formValidator;
    #view;
    #captcha;
    constructor() {
        this.#view = new FormView();
        new Wysiwyg();
        this. #captcha = new Captcha();
        this.#formValidator = new FormValidator();

        this.#view.onFormSubmit(async (formId) => {
            try {
                this.#view.resetFormErrors();
                this.#view.setFormInLoadingMode(formId);
                let isValid = this.#validateForm(formId);
                if(!isValid) {
                    this.#view.setFormInEditMode(formId);
                }
                else {
                    if(this.#captcha.isEnabled(formId)) {
                        isValid = await this.#captcha.executeCaptcha(formId);
                        if(!isValid) {
                            this.#view.showGenericFormError();
                        }
                    }
                }
                if(isValid) {
                    this.#view.continueFormSubmit(formId);
                }
                else {
                    this.#view.setFormInEditMode(formId);
                }
            }catch(e) {
                log.error(e);
                this.#view.setFormInEditMode(formId);
                return true;
            }

        });

        this.#view.onFieldFocus(this.#view.resetFieldErrors);
        this.#view.onFieldFocusOut((formId, fieldName) => {
            this.#view.resetFormErrors();
            this.#validateField(formId, fieldName)
        });
    }

    /**
     * @param {string} formId
     * @param {string} fieldName
     * @returns {boolean}
     */
    #validateField = (formId, fieldName) => {
        try {
            let field = this.#view.getFieldWithHisValidations(formId, fieldName);
            field = this.#formValidator.validateField(field);

            if(field == null || !field.isValid) {
                this.#view.showErrorOnFormField(formId, field);
                return false;
            }
            return true;
        }catch (e) {
            log.error(e);
            return false;
        }
    };

    /**
     * @param {string} formId
     * @returns {boolean}
     */
    #validateForm = (formId) => {
        try {
            let fields = this.#view.getAllFieldsWithTheirValidations(formId);
            fields = this.#formValidator.validateAllFields(fields);
            let invalidFields = this.#getAllInvalidFields(fields);
            if(invalidFields && invalidFields.length > 0) {
                this.#view.showErrorsOnFormFields(formId, invalidFields);
                return false;
            }
            return true;
        }catch (e) {
            log.error(e);
            return false;
        }
    };

    /**
     * @param {Array.<Field>} fields
     * @returns {Array.<Field>} fields
     */
    #getAllInvalidFields = (fields) => {
        let outcome = [];

        if(fields && fields.length > 0) {
            outcome = fields.filter(field => field.isValid === false);
        }
        return outcome;
    };

}
