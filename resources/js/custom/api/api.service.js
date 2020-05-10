export default class ApiService {
    constructor() {
    }

    ajaxGet = async (url) => {
        try {
            let response = await axios.get(url);
            return this.#handleResponse(response);
        } catch (e) {
            log.error(e);
            return this.#handleResponse();
        }
    };

    ajaxPost = async (url, body = {}) => {
        try {
            let response = await axios.post(url, body);
            return this.#handleResponse(response);
        } catch (e) {
            log.error(e);
            return this.#handleResponse();
        }
    };

    ajaxDelete = async (url) => {
        try {
            let response = await axios.delete(url);
            return this.#handleResponse(response);

        } catch (e) {
            log.error(e);
            return this.#handleResponse();
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
            return this.#handleResponse();
        }
    };

    /**
     *
     * @param response
     * @returns {{request: *, response: object that contains parameters}}
     */
    #handleResponse = (response = null) => {
        try {
            let outcome = {
                hasErrors: true,
                params: null,
                errors: null,
            };
            if (response != null) {
                if (!$.trim(response)) {
                    response = {}
                }
                let parsedResponse = JSON.stringify(response);
                parsedResponse = JSON.parse(parsedResponse);
                const parsedResponseData = parsedResponse.data;
                outcome.params = parsedResponseData.params;
                outcome.hasErrors = parsedResponseData.hasErrors;
                outcome.errors = parsedResponseData.errors;
            }
            if (response == null || response.status !== 200) {
                outcome.hasErrors = true
            }
            return outcome;
        } catch (e) {
            log.error(e);
            return {
                hasErrors: true,
                params: null,
                errors: null,
            };
        }

    };
}

