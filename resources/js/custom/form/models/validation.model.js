export default class Validation {
    /**
     * @type {number}
     */
    id;

    /**
     * @type {Array.<string>}
     */
    params;

    /**
     * @type {boolean}
     */
    isValid;

    constructor(id, params) {
        this.id = id;
        this.params = params;
        this.isValid = false;
    }
}
