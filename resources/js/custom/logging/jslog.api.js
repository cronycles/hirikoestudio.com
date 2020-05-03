import ApiRoutes from '../api/api.routes';
import ApiService from '../api/api.service';

export default class JSLogApi {
    constructor() {
        this.api = new ApiService();
        this.routes = new ApiRoutes();
    }

    async logInfo(data) {
        return await this.api.ajaxPost(this.routes.logInfo, data);
    }

    async logError(data) {
        return await this.api.ajaxPost(this.routes.logError, data);
    }

}
