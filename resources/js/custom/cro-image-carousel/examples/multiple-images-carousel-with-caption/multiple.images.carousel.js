require('../js/cro.image.carousel');

namespace.add('multiple.image.carousel', function () {

    function bind() {
        let partnersCarousel = $W.cro.image.carousel;
        partnersCarousel.bind({
            carouselSelector: ".multiple-images__carousel",
            items: 5,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                }
            }
        });
    }

    return {
        bind: bind
    };

}());
