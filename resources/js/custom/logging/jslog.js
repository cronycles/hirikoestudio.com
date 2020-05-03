import JSLogApi from './jslog.api';

export default class JSLog {
    constructor() {
        this.api = new JSLogApi();
    }

    async bindWindowError() {
        _onWindowError(async (err, url, line) => {
            let params = {
                line: line
            };
            let errorString = "Window error - " + err;
            console.error(err);
            await this.logErrorOnServer(errorString, params);
        })
    }

    async info(msg, params) {
        await this.logInfoOnServer(msg, params);
    }

    async error(error, params) {
        console.error(error);
        let errorString = "Error!";
        let errorStack = "";
        if (error) {
            errorString = error.name + " - " + error.message;
            errorStack = error.stack;
        }
        await this.logErrorOnServer(errorString, params, errorStack);
    }

    async logInfoOnServer(msg, params) {
        let data = {
            msg: msg,
        };
        if (params) {
            data.params = params;
        }

        await this.api.logInfo(data);
    }

    async logErrorOnServer(err, params, stack) {

        let data = {
            msg: err,
        };
        if (params) {
            data.params = params;
        }
        if (stack) {
            data.stack = stack;
        }

        data.queryString = document.location.search;
        data.url = document.location.pathname;
        data.referrer = document.referrer;
        data.userAgent = navigator.userAgent;

        await this.api.logError(data);
    }

}

const _onWindowError = callback => {
    window.onerror = function (err, url, line) {
        let suppressErrors = true;
        callback(err, url, line);
        return suppressErrors;
    };
}