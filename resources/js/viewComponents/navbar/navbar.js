
export default class Navbar {
    constructor() {
        $('.jburger').click(function() {
            const $navList = $(".jnavList");
            if($navList.hasClass('opened')) {
                $navList.width('0');
                $navList.removeClass('opened');
                const $jburgerBars = $('.jburger').find('.jburgerBars');
                const closedClass = $jburgerBars.data('closed');
                const openedClass = $jburgerBars.data('opened');
                $jburgerBars.removeClass(openedClass);
                $jburgerBars.addClass(closedClass);

            }
            else {
                $navList.width('100%');
                $navList.addClass('opened');
                const $jburgerBars = $('.jburger').find('.jburgerBars');
                const openedClass = $jburgerBars.data('opened');
                const closedClass = $jburgerBars.data('closed');
                $jburgerBars.removeClass(closedClass);
                $jburgerBars.addClass(openedClass);

            }

        });

        $('.jdropdown').click(function() {
            const $dropdown = $(this);
            const $dropdownContent = $dropdown.find(".jdropdownContent");
            if($dropdownContent.hasClass('opened')) {
                $dropdownContent.hide();
                $dropdownContent.removeClass('opened');
                const $jcaret = $dropdown.find('.jcaret');
                const closedClass = $jcaret.data('closed');
                const openedClass = $jcaret.data('opened');
                $jcaret.removeClass(openedClass);
                $jcaret.addClass(closedClass);
            }
            else {
                $dropdownContent.show();
                $dropdownContent.addClass('opened');
                const $jcaret = $dropdown.find('.jcaret');
                const openedClass = $jcaret.data('opened');
                const closedClass = $jcaret.data('closed');
                $jcaret.removeClass(closedClass);
                $jcaret.addClass(openedClass);
            }

        });
    }
}
