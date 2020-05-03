require('../js/cro.image.carousel');

namespace.add('single.image.carousel', function () {

    function bind() {
        let bannersCarousel = $W.cro.image.carousel;
        bannersCarousel.bind({
            carouselSelector: ".single-image__carousel",
            items: 1,
            nav: false,
            imageForScreen: true,
        });
    }

    return {
        bind: bind
    };

}());
