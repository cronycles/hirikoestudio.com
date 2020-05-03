import FieldValidatorManager from "./field.validator.manager";
export default class FormValidator {
    #validationFunctions;
    #manager;
    constructor() {
        this.#manager = new FieldValidatorManager();
        this.#validationFunctions = {
            1: this.#manager.validateRequired,
            2: this.#manager.validateAlpha,
            3: this.#manager.validateNumber,
            4: this.#manager.validatePrice,
            5: this.#manager.validateDate,
            6: this.#manager.validateEmail,
        }

    }

    /**
     *
     * @param {Array.<Field>} fields
     * @returns {null}
     */
    validateAllFields = (fields) => {
        try {
            if(fields && fields.length > 0) {
                for(let field of fields) {
                    field = this.validateField(field);
                }
            }
            return fields;
        }catch (e) {
            log.error(e);
            return null;
        }
    };

    /**
     *
     * @param {Field} field
     * @returns {Field}
     */
    validateField = (field) => {
        try {
            if(field) {
                if(field.validations && field.validations.length > 0) {
                    let validations = field.validations;
                    let validValidationCounter = 0;
                    for(let validation of validations) {
                        if(validation != null) {
                            const validationFunction = this.#validationFunctions[validation.id];
                            var isOk = validationFunction(field.value, validation.params);
                            if(isOk) {
                                validation.isValid = true;
                                validValidationCounter++;
                            }
                        }
                    }
                    if(field.validations.length === validValidationCounter) {
                        field.isValid = true;
                    }
                }
                else {
                    field.isValid = true;
                }
            }
            return field;
        }catch (e) {
            log.error(e);
            field.isValid = false;
            return field;
        }
    };
}
