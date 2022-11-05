(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var staffsSliderHandler = function ($scope, $) {

        $(".teacher-slider").length > 0 && $(".teacher-slider").each(function () {
            var slideShow = $(this).attr('data-show-count') * 1;
            var slideShowMd = $(this).attr('data-show-count-md') * 1;
            var slideShowMob = $(this).attr('data-show-count-mob') * 1;
            var slideSpeed = $(this).attr('data-slick-speed') * 1;
            var slideAutoplay = $.parseJSON($(this).attr('data-slick-autoplay'));
            $(this).slick({
                arrows: false,
                dots: true,
                infinite: true,
                adaptiveHeight: true,
                slidesToShow: slideShow,
                slidesToScroll: 1,
                autoplay: slideAutoplay,
                autoplaySpeed: slideSpeed,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: slideShowMd
                        }
                    },
                    {
                        breakpoint: 705,
                        settings: {
                            slidesToShow: slideShowMob
                        }
                    }
                ]
            });
        });

    };
    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/staffs.default', staffsSliderHandler);
    });
})(jQuery);