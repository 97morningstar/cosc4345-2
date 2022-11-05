(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var centreInformationSliderHandler = function ($scope, $) {

        $(".testimonial-slider").length > 0 && $(".testimonial-slider").each(function () {
            var slideShow = $(this).attr('data-show-count') * 1;
            var slideShowMd = $(this).attr('data-show-count-md') * 1;
            var slideShowMob = $(this).attr('data-show-count-mob') * 1;
            var slideSpeed = $(this).attr('data-slick-speed') * 1;
            var slideAutoplay = $.parseJSON($(this).attr('data-slick-autoplay'));
            $(this).slick({
                arrows: false,
                dots: true,
                infinite: false,
                adaptiveHeight: true,
                slidesToShow: slideShow,
                slidesToScroll: 1,
                swipeToSlide: true,
                autoplay: slideAutoplay,
                autoplaySpeed: slideSpeed,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: slideShowMd,
                        }
                    },
                    {
                        breakpoint: 705,
                        settings: {
                            slidesToShow: slideShowMob,
                        }
                    }
                ]
            });
        });

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


        $(".adventage-slider").length > 0 && $(".adventage-slider").each(function () {
            var t = 1 * $(this).attr("data-show-count"),
                    a = 1 * $(this).attr("data-show-count-md"),
                    i = 1 * $(this).attr("data-show-count-mob"),
                    e = 1 * $(this).attr("data-slick-speed"),
                    o = $.parseJSON($(this).attr("data-slick-autoplay"));
            $(this).slick({
                arrows: !1,
                dots: !0,
                infinite: !1,
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
            })
        });
    };
    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/centre-information.default', centreInformationSliderHandler);
    });
})(jQuery);