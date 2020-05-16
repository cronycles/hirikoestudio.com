import Field from "./models/field.model";
import Validation from "./models/validation.model";

export default class FormView {
    constructor() {

        //Texts
        this.tsubmit = "submit";
        this.tval = "val";
        this.tid = "id";
        this.tname = "name";
        this.tnone = "none";
        this.tfocusIn = "focusin";
        this.tfocusOut = "focusout";
        this.tform = "form";
        this.treset = "reset";

        //Classes
        this.fieldErrorClass = "form__field--error";
        this.fieldSubClass = 'jfieldSub';
        this.wysiwygClass = 'jwysiwygInput';

        //Selectors
        this.formButtonSelector = ".jformSend";
        this.fieldSelector = '.jfield';
        this.genericErrorSelector = '.jsFormErr';
        this.fieldSubSelector = `.${this.fieldSubClass}`;

        //DOM
        this.$forms = $(this.tform);
    }

    resetFormIfAskedByServer = () => {
        try {
            this.$forms.map((index, form) => {
                const $form = $(form);
                const dataReset = $form.data(this.treset);
                if (dataReset) {
                    $form.find(this.fieldSelector).val('');
                }
            });
        } catch (e) {
            log.error(e);
        }
    };

    onFormSubmit = (callback) => {
        this.$forms.off(this.tsubmit).on(this.tsubmit, (element) => {
            const $form = $(element.currentTarget);
            callback($form.attr(this.tid));
            return false;
        });
    };

    setFormInLoadingMode = (formId) => {
        const $form = this.#getJqueryFormById(formId);
        const formButton = $form.find(this.formButtonSelector);
        const width = formButton.outerWidth();
        const height = formButton.outerHeight();
        const $formButton = $(formButton);
        $formButton.attr("disabled", true);
        $formButton.css("width", width);
        $formButton.css("height", height);
        $formButton.text("");
        $formButton.addClass("loading__spinner")
    };

    setFormInEditMode = (formId) => {
        const $form = this.#getJqueryFormById(formId);
        const formButton = $form.find(this.formButtonSelector);
        const $formButton = $(formButton);
        $formButton.attr("disabled", false);
        const buttonText = $formButton.data("txt");
        $formButton.removeClass("loading__spinner");
        $formButton.text(buttonText);

    };

    /**
     *
     * @param {string} formId
     * @returns {Array.<Field>}
     */
    getAllFieldsWithTheirValidations = (formId) => {
        try {
            let outcome = [];
            const $form = this.#getJqueryFormById(formId);
            const domFields = $form.find(this.fieldSelector);
            if (domFields && domFields.length > 0) {
                for (const domField of domFields) {
                    let $field = $(domField);
                    let field = this.#createNewFieldModelByJqueryObject($field);
                    outcome.push(field);
                }
            }
            return outcome;
        } catch (e) {
            log.error(e);
            return [];
        }
    };

    /**
     * @param {string} formId
     * @param {Array.<Field>} fields
     */
    showErrorsOnFormFields = (formId, fields) => {
        try {
            if (formId && fields && fields.length > 0) {
                for (const field of fields) {
                    this.showErrorOnFormField(formId, field);
                }
            }
        } catch (e) {
            log.error(e);
        }
    };

    /**
     * @param {string} formId
     * @param {Field} field
     */
    showErrorOnFormField = (formId, field) => {
        const fieldName = field.name;
        let $field = this.#findJqueryFormFieldByName(formId, fieldName);
        if ($field.is(":hidden")) {
            $field = $field.nextAll(this.fieldSubSelector);
        }
        $field.addClass(this.fieldErrorClass);
        this.#showFieldErrorText(formId, fieldName);
    };

    onFieldFocus = (callback) => {
        this.$forms.on(this.tfocusIn, this.fieldSelector, (element) => {
            const $field = $(element.currentTarget);
            const $form = $field.closest(this.tform);
            callback($form.attr(this.tid), $field.attr(this.tname));
        });

        this.$forms.on(this.tfocusIn, this.fieldSubSelector, (element) => {
            const $fieldSub = $(element.currentTarget);
            const $field = this.#findJqueryFormFieldByJqueryFieldSub($fieldSub);
            const $form = $field.closest(this.tform);
            callback($form.attr(this.tid), $field.attr(this.tname));
        });
    };

    onFieldFocusOut = (callback) => {
        this.$forms.on(this.tfocusOut, this.fieldSelector, (element) => {
            const $field = $(element.currentTarget);
            const $form = $field.closest(this.tform);
            callback($form.attr(this.tid), $field.attr(this.tname));
        });

        this.$forms.on(this.tfocusOut, this.fieldSubSelector, (element) => {
            const $fieldSub = $(element.currentTarget);
            const $field = this.#findJqueryFormFieldByJqueryFieldSub($fieldSub);
            const $form = $field.closest(this.tform);
            callback($form.attr(this.tid), $field.attr(this.tname));
        });
    };

    continueFormSubmit = (formId) => {
        const $form = this.#getJqueryFormById(formId);
        $form.off(this.tsubmit).submit();
    };


    getFieldWithHisValidations = (formId, fieldName) => {
        try {
            const $field = this.#findJqueryFormFieldByName(formId, fieldName);
            return this.#createNewFieldModelByJqueryObject($field);
        } catch (e) {
            log.error(e);
            return null;
        }

    };

    showGenericFormError = () => {
        $(this.genericErrorSelector).removeClass(this.tnone);
    };

    resetFormErrors = () => {
        $(this.genericErrorSelector).addClass(this.tnone);
    };

    /**
     * @param {string} formId
     * @param {string} fieldName
     */
    resetFieldErrors = (formId, fieldName) => {
        let $field = this.#findJqueryFormFieldByName(formId, fieldName);
        if ($field.is(":hidden")) {
            $field = $field.nextAll(this.fieldSubSelector);
        }
        $field.removeClass(this.fieldErrorClass);
        this.#hideFieldErrorText(formId, fieldName);
    };

    /**
     *
     * @param {string} formId
     * @param {string} fieldName
     * @returns {jQuery}
     */
    #findJqueryFormFieldByName = (formId, fieldName) => {
        const $form = this.#getJqueryFormById(formId);
        return $form.find(`.jfield[name="${fieldName}"]`);
    };

    /**
     /**
     *
     * @param {string} formId
     * @param {string} fieldName
     */
    #showFieldErrorText = (formId, fieldName) => {
        const $fieldErrorText = this.#getFieldErrorTextJqueryObject(formId, fieldName);
        $fieldErrorText.removeClass(this.tnone);
    };

    /**
     *
     * @param {string} formId
     * @param {string} fieldName
     */
    #getFieldErrorTextJqueryObject = (formId, fieldName) => {
        const $form = this.#getJqueryFormById(formId);
        return $form.find(`.jerrText[data-f="${fieldName}"]`);
    };

    #getJqueryFormById = (formId) => {
        return $("#" + formId);
    };

    /**
     * @param {jQuery} $field
     * @returns {Field}
     */
    #createNewFieldModelByJqueryObject($field) {
        try {
            let outcome = null;
            if ($field) {
                const fieldName = $field.attr(this.tname);
                let fieldValue = $field.val();
                if ($field.hasClass(this.wysiwygClass)) {
                    fieldValue = $(fieldValue).text();
                }
                const validationsArray = $field.data(this.tval);
                let validations = [];
                if (validationsArray) {
                    for (let validationObject of validationsArray) {
                        let validation = new Validation(validationObject.id, validationObject.params);
                        validations.push(validation);
                    }
                }
                outcome = new Field(fieldName, fieldValue, validations);

            }
            return outcome;
        } catch (e) {
            log.error(e);
            return null;
        }
    }


    /**
     *
     * @param {jQuery} $fieldSub
     * @returns {jQuery}
     */
    #findJqueryFormFieldByJqueryFieldSub = ($fieldSub) => {
        if (!$fieldSub.hasClass(this.fieldSubClass)) {
            $fieldSub = $fieldSub.closest(this.fieldSubSelector);
        }
        const $form = $fieldSub.closest(this.tform);
        const fieldName = $fieldSub.data(this.tname);
        return this.#findJqueryFormFieldByName($form.attr(this.tid), fieldName);
    };


    /**
     *
     * @param {string} formId
     * @param {string} fieldName
     */
    #hideFieldErrorText = (formId, fieldName) => {
        const $fieldErrorText = this.#getFieldErrorTextJqueryObject(formId, fieldName);
        $fieldErrorText.addClass(this.tnone);
    };


}



