(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var PricingPackagesHandler = function ($scope, $) {
        $(".pricing-packages-slider").length > 0 && $(".pricing-packages-slider").each(function () {
            var t = 1 * $(this).attr("data-show-count"),
                    a = 1 * $(this).attr("data-show-count-md"),
                    i = 1 * $(this).attr("data-show-count-mob"),
                    e = 1 * $(this).attr("data-slick-speed"),
                    o = $.parseJSON($(this).attr("data-slick-autoplay"));
            $(this).slick({
                arrows: false,
                dots: true,
                infinite: false,
                adaptiveHeight: true,
                autoplay:true,
                autoplaySpeed: 3000,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });
    };
    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/pricing_packages.default', PricingPackagesHandler);
    });
})(jQuery);