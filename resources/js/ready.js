import PageFactory from './pages/page.factory';
import LazyFactory from './custom/scriptsLazy/lazy.factory';
import ImagesLazy from './custom/imagesLazy/images.lazy';
import Notifications from "./custom/httpMessages/notifications";

$(function () {
    let lazyFactory = new LazyFactory();
    lazyFactory.loadLazyScripts();
    log.bindWindowError();
    let pageFactory = new PageFactory();
    pageFactory.bindCurrentPageModule();
    let imagesLoading = new ImagesLazy();
    imagesLoading.loadAllLazyImagesIntoThePage();
    new Notifications();
});
