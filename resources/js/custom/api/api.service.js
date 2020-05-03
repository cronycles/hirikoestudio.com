export default class ApiService {
    constructor() {
    }

    ajaxGet = async (url) => {
        try {
            let response = await axios.get(url);
            return this.#handleResponse(response);
        } catch (e) {
            log.error(e);
            return null;
        }
    };

    ajaxPost = async (url, body) => {
        try {
            let response = await axios.post(url, body);
            return this.#handleResponse(response);
        } catch (e) {
            log.error(e);
            return null;
        }
    };

    ajaxDelete = async (url) => {
        try {
            let response = await axios.delete(url);
            return this.#handleResponse(response);

        } catch (e) {
            log.error(e);
            return null;
        }
    };

    ajaxPostFileFormData = async (url, body, uploadProgressFunction) => {
        try {
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: (progressEvent) => {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    uploadProgressFunction(percentCompleted)
                }
            };
            let response = await axios.post(url, body, config);
            return this.#handleResponse(response)
        } catch (e) {
            log.error(e);
            return null;
        }
    };

    /**
     *
     * @param response
     * @returns {{request: *, response: object that contains parameters}}
     */
    #handleResponse = (response) => {
        let outcome = {
            hasErrors: false,
            params: null,
            errors: null,
        };
        if (response != null) {
            if (!$.trim(response)) {
                response = {}
            }
            let parsedResponse = JSON.stringify(response);
            parsedResponse = JSON.parse(parsedResponse);
            parsedResponse = parsedResponse.data;
            outcome.hasErrors = parsedResponse.hasErrors;
            outcome.params = parsedResponse.params;
            outcome.errors = parsedResponse.errors;
        }
        return outcome;
    };
}

