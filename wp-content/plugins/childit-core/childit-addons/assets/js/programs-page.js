(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var ProgramPageSliderHandler = function ($scope, $) {

        $(".program-big-slider").length > 0 && $(".program-big-slider").each(function () {
            var t = 1 * $(this).attr("data-show-count"),
                    a = 1 * $(this).attr("data-show-count-md"),
                    i = 1 * $(this).attr("data-show-count-mob"),
                    e = $.parseJSON($(this).attr("data-slick-arrow")),
                    o = $(this).attr("data-nav");
            $(this).slick({
                arrows: e,
                infinite: !1,
                adaptiveHeight: !0,
                slidesToShow: t,
                slidesToScroll: 1,
                asNavFor: o,
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
        }),
                $(".program-nav-slider").length > 0 && $(".program-nav-slider").each(function () {
            var t = 1 * $(this).attr("data-show-count"),
                    a = 1 * $(this).attr("data-show-count-md"),
                    i = 1 * $(this).attr("data-show-count-mob"),
                    e = $.parseJSON($(this).attr("data-slick-arrow")),
                    o = $(this).attr("data-nav"),
                    s = 1 * $(this).attr("data-slick-speed"),
                    n = $.parseJSON($(this).attr("data-slick-autoplay"));
            $(this).slick({
                arrows: e,
                infinite: !1,
                adaptiveHeight: !0,
                slidesToShow: t,
                slidesToScroll: 1,
                asNavFor: o,
                focusOnSelect: !0,
                autoplay: n,
                autoplaySpeed: s,
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
        $(".slick-prev").html('<i class="fas fa-angle-left"></i>'), $(".slick-next").html('<i class="fas fa-angle-right"></i>');
    };
    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/programs_page.default', ProgramPageSliderHandler);
    });
})(jQuery);