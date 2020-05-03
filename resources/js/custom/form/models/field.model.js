export default class Field {
    /**
     * @type {number}
     */
    name;

    /**
     * @type {string|number}
     */
    value;

    /**
     * @type {Array.<Validation>}
     */
    validations;

    /**
     * @type {boolean}
     */
    isValid;

    constructor(name, value, validations) {
        this.name = name;
        this.value = value;
        this.validations = validations;
        this.isValid = false;
    }
}
