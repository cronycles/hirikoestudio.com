export default class ApiRoutes {
    constructor() {
        this.tapi = "/api";
        this.tapiLog = this.tapi + "/log";
    }

    get logInfo() {
        return this.tapiLog + "/info";
    }

    get logError() {
        return this.tapiLog + "/error";
    }

} 