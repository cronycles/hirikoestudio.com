export default class FieldValidatorManager {

    /**
     * valida se l'attributo è required, quindi non vuoto
     *
     * @param {string|number} fieldValue
     * @param {Array.<string>} params
     */
    validateRequired = (fieldValue, params = []) => {
        try {
            let outcome = false;
            const isFieldFilled = typeof(fieldValue) != "undefined" && fieldValue != null && fieldValue.length > 0;
            if(isFieldFilled === true) {
                if(params && params.length > 0) {
                    const exactNumber = params[0];
                    const minNumber = params[1];
                    const maxNumber = params[2];

                    outcome = this.#validateNumberOfChars(fieldValue, [exactNumber, minNumber, maxNumber]);
                }
                else {
                    outcome = true;
                }
            }
            return outcome;
        } catch(e) {
            log.error(e);
            return false;
        }

    };

    /**
     * valida se l'attributo è un numero
     * i parametri (tutti non obbligatori) sono:
     * 1- numero esatto (il valore dev'essere uguale). Se questo parametro è pieno, non si considerano gli altri 2 parametri
     * 2- minimo numero (il valore dev'essere maggiore o uguale a questo numero)
     * 3- massimo numero (il valore dev'essere minore o uguale a questo numero)
     * @param {string|number} fieldValue
     * @param {Array.<string>} params
     */
    validateNumber = (fieldValue, params = []) => {
        let outcome = false;
        if(isNaN(fieldValue)) {
            return false;
        }
        if(params.length === 0) {
            return true;
        }
        const exactNumber = params[0];
        const minNumber = params[1];
        const maxNumber = params[2];

        if(exactNumber) {
            return this.#isValueEqualsThan(fieldValue, exactNumber)
        }

        let minOrMaxCondition = null;
        if(minNumber) {
            minOrMaxCondition = this.#isValueGreaterOrEqualsThan(fieldValue, minNumber);
        }
        if(minOrMaxCondition === false) {
            return false;
        }

        if(maxNumber) {
            minOrMaxCondition = this.#isValueLowerOrEqualThan(fieldValue, maxNumber);
        }
        if(minOrMaxCondition === null || minOrMaxCondition === true) {
            outcome = true;
        }

        return outcome;
    };

    /**
     * valida se l'attributo è una stringa di solo caratteri a-zA-Z o di solo alfanumerici
     * i parametri sono:
     * 1- si es true permette solo alfanumerico, se es false o null permette solo caratteri a-zA-Z
     * 2- numero esatto di caratteri permessi. Se questo parametro è pieno, non si considerano gli altri 2 parametri
     * 3- minimo numero di caratteri permessi
     * 4- massimo numero di caratteri permessi
     * @param {string|number} fieldValue
     * @param {Array.<string>} params
     */
    validateAlpha = (fieldValue, params = []) => {
        let outcome = false;
        if(fieldValue) {
            const onlyCharsRegexPart = 'a-zA-Z';
            const alphaNumericRegexPart = '\\w+';
            let basicRegex = '^([^-\\s][{part1}]*)$';

            let part1 = onlyCharsRegexPart;

            const permitsAlphaNumericChars = params[0];
            const exactNumberOfChars = params[1];
            const minNumberOfChars = params[2];
            const maxNumberOfChars = params[3];

            const isNumberOfCharsValid = this.#validateNumberOfChars(fieldValue, [exactNumberOfChars, minNumberOfChars, maxNumberOfChars]);

            if(isNumberOfCharsValid) {
                if(permitsAlphaNumericChars) {
                    part1 = alphaNumericRegexPart;
                }

                let testingRegex = basicRegex.replace("{part1}", part1);

                const regExp = new RegExp(testingRegex,"i");
                outcome = regExp.test(fieldValue);
            }
        }
        return outcome;
    };

    /**
     * valida se l'attributo è un prezzo
     * i parametri (tutti non obbligatori) sono:
     * 1- prezzo esatto (il valore dev'essere uguale). Se questo parametro è pieno, non si considerano gli altri 2 parametri
     * 2- minimo prezzo (il valore dev'essere maggiore o uguale a questo prezzo)
     * 3- massimo prezzo (il valore dev'essere minore o uguale a questo prezzo)
     * @param {string|number} fieldValue
     * @param {Array.<string>} params
     */
    validatePrice = (fieldValue, params = []) => {
        let outcome = false;
        if(fieldValue) {
            let basicRegex = '^[0-9]{1,}([,.][0-9]{1,2})?$';

            const exactPrice = params[0];
            const minPrice = params[1];
            const maxPrice = params[2];

            const regExp = new RegExp(basicRegex,"i");

            if(regExp.test(fieldValue)) {
                const fieldNumber = fieldValue.replace(",", ".");
                const exactNumber = exactPrice ? exactPrice.toString().replace(",", ".") : exactPrice;
                const minNumber = minPrice ? minPrice.toString().replace(",", ".") : minPrice;
                const maxNumber = maxPrice ? maxPrice.toString().replace(",", ".") : maxPrice;
                outcome = this.validateNumber(fieldNumber, params = [exactNumber, minNumber, maxNumber]);
            }
        }
        return outcome;
    };

    /**
     * valida se l'attributo è un numero
     * i parametri (tutti non obbligatori) sono:
     * 1- data esatta (il valore dev'essere uguale). Se questo parametro è pieno, non si considerano gli altri 2 parametri
     * 2- minima data (il valore dev'essere maggiore o uguale a questa data)
     * 3- massima data (il valore dev'essere minore o uguale a questa data)
     * @param {string|number} fieldValue
     * @param {Array.<string>} params
     */
    validateDate = (fieldValue, params = []) => {
        let outcome = false;
        if(fieldValue) {
            //formato data yyyy-mm-dd
            let testingRegex = /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/i;

            const isValidDate = testingRegex.test(fieldValue);

            if(!isValidDate) {
                return false;
            }
            else {
                const filedDate = new Date(fieldValue);

                const exactDateString = params[0];
                const minDateString = params[1];
                const maxDateString = params[2];

                if(exactDateString) {
                    if(testingRegex.test(exactDateString)){
                        const exactDate = new Date(exactDateString);
                        return this.#isValueEqualsThan(filedDate.getTime(), exactDate.getTime())
                    }
                    return false;
                }

                let minOrMaxCondition = null;
                if(minDateString) {
                    if(testingRegex.test(minDateString)) {
                        const minDate = new Date(minDateString);
                        minOrMaxCondition = this.#isValueGreaterOrEqualsThan(filedDate.getTime(), minDate.getTime());
                    }
                    else {
                        minOrMaxCondition = false;
                    }
                }
                if(minOrMaxCondition === false) {
                    return false;
                }

                if(maxDateString) {
                    if(testingRegex.test(maxDateString)) {
                        const maxDate = new Date(maxDateString);
                        minOrMaxCondition = this.#isValueLowerOrEqualThan(filedDate.getTime(), maxDate.getTime());
                    }
                    else {
                        minOrMaxCondition = false;
                    }
                }
                if(minOrMaxCondition === null || minOrMaxCondition === true) {
                    outcome = true;
                }
            }
        }
        return outcome;
    };

    /**
     * valida se l'attributo è un numero
     * i parametri (tutti non obbligatori) sono:
     * 1- email esatta (il valore dev'essere uguale).
     * @param {string|number} fieldValue
     * @param {Array.<string>} params
     */
    validateEmail = (fieldValue, params = []) => {
        let outcome = false;
        if(fieldValue){
            //formato data yyyy-mm-dd
            let testingRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/i;

            if(testingRegex.test(fieldValue)) {
                const exactEmail = params[0];
                if(exactEmail) {
                    if(testingRegex.test(exactEmail)){
                        return this.#isValueEqualsThan(fieldValue, exactEmail)
                    }
                }
                else {
                    outcome = true;
                }
            }
        }

        return outcome;
    };


    /**
     *
     * @param {string|number} valueToBeTested
     * @param {string|number} value
     */
    #isValueEqualsThan = (valueToBeTested, value) => {
        try {
            let outcome = false;
            if(valueToBeTested && value) {
                const floatValueToBeTested = parseFloat(valueToBeTested);
                const floatValue = parseFloat(value);
                outcome = floatValueToBeTested === floatValue;
            }
            return outcome;
        }catch(e) {
            log.error(e);
            return false;
        }

    };


    /**
     *
     * @param {string|number} valueToBeTested
     * @param {string|number} minValue
     */
    #isValueGreaterOrEqualsThan = (valueToBeTested, minValue) => {
        try {
            let outcome = false;
            if(valueToBeTested && minValue) {
                const floatValueToBeTested = parseFloat(valueToBeTested);
                const floatMinValue = parseFloat(minValue);
                outcome = floatValueToBeTested >= floatMinValue;
            }
            return outcome;
        }catch(e) {
            log.error(e);
            return false;
        }

    };

    /**
     * il numero di caratteri del field.
     * i parametri (almeno uno deve essere obbligatorio) sono:
     * 1- numero esatto di caratteri permessi. Se questo parametro è pieno, non si considerano gli altri 2 parametri
     * 2- minimo numero di caratteri permessi
     * 3- massimo numero di caratteri permessi
     *
     * @param {string|number} fieldValue
     * @param {Array.<string>} params
     */
    #validateNumberOfChars = (fieldValue, params = []) => {
        let outcome = false;

        if(params.length === 0) {
            return false;
        }

        if(fieldValue) {
            const exactNumberOfChars = params[0];
            const minNumberOfCharsPermitted = params[1];
            const maxNumberOfCharsPermitted = params[2];

            if(exactNumberOfChars) {
                return this.#isValueEqualsThan(fieldValue.length, exactNumberOfChars)
            }

            let greaterOrLowerCondition = null;
            if(minNumberOfCharsPermitted) {
                greaterOrLowerCondition = this.#isValueGreaterOrEqualsThan(fieldValue.length, minNumberOfCharsPermitted);
            }
            if(greaterOrLowerCondition === false) {
                return false;
            }

            if(maxNumberOfCharsPermitted) {
                greaterOrLowerCondition = this.#isValueLowerOrEqualThan(fieldValue.length, maxNumberOfCharsPermitted);
            }
            if(greaterOrLowerCondition === null || greaterOrLowerCondition === true) {
                outcome = true;
            }
        }

        return outcome;
    };

    /**
     *
     * @param {string|number} valueToBeTested
     * @param {string|number} maxValue
     */
    #isValueLowerOrEqualThan = (valueToBeTested, maxValue) => {
        try {
            let outcome = false;
            if(valueToBeTested && maxValue) {
                const floatValueToBeTested = parseFloat(valueToBeTested);
                const floatMaxValue = parseFloat(maxValue);
                outcome = floatValueToBeTested <= floatMaxValue;
            }
            return outcome;
        }catch(e) {
            log.error(e);
            return false;
        }

    };
}
