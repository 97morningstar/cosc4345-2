(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var BlogsSliderHandler = function ($scope, $) {
        $(".news-slider").length > 0 && $(".news-slider").each(function () {
            var t = 1 * $(this).attr("data-show-count"),
                    a = 1 * $(this).attr("data-show-count-md"),
                    i = 1 * $(this).attr("data-show-count-mob"),
                    e = 1 * $(this).attr("data-slick-speed"),
                    o = $.parseJSON($(this).attr("data-slick-autoplay"));
            $(this).slick({
                arrows: !1,
                dots: !0,
                infinite: !0,
                adaptiveHeight: !0,
                slidesToShow: t,
                slidesToScroll: 1,
                swipeToSlide: !0,
                autoplay: o,
                autoplaySpeed: e,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: a
                        }
                    }, {
                        breakpoint: 705,
                        settings: {
                            slidesToShow: i
                        }
                    }]
            });
        });
    };
    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/blogs.default', BlogsSliderHandler);
    });
})(jQuery);