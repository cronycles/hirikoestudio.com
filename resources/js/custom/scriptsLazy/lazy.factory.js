export default class LazyFactory {
    constructor() {
        this.clientServerSelector = "#cl-srv";
    }

    loadLazyScripts() {
        let clSrvConfig = this.getClientServerConfig();
        if (clSrvConfig) {
            this.lazyJS(clSrvConfig.lazyJs);
        }
    }

    getClientServerConfig() {
        let clSrvConfig = $(this.clientServerSelector);
        if (clSrvConfig) {
            return {
                lazyJs: clSrvConfig.data("lj")
            }
        }
        else {
            return null;
        }
    }

    lazyJS(url) {
        if (url) {
            let script = document.createElement('script');
            script.src = url;
            document.getElementsByTagName('head')[0].appendChild(script);
        }
    }


}