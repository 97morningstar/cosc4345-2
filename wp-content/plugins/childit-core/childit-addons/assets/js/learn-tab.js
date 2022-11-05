(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var LearningTabHandler = function ($scope, $) {

        $scope.find('.learning-item').each(function () {
            $("[data-learn-tab]").length > 0 && ($("[data-learn-tab]").on("mouseover", function () {
                var t = $(this),
                        a = t.attr("data-learn-tab"),
                        i = $(a),
                        e = i.closest(".tab-element-content"),
                        o = t.closest(".circle-container");
                e.find(".for-tab").removeClass("active"), o.find("[data-learn-tab]").removeClass("active"), t.addClass("active"), i.addClass("active"), e.find(".for-tab.start").hide()
            }), $("[data-learn-tab]").on("mouseleave", function () {
                var t = $(this),
                        a = t.attr("data-learn-tab"),
                        i = $(a),
                        e = i.closest(".tab-element-content");
                t.closest(".circle-container");
                t.removeClass("active"), i.removeClass("active"), e.find(".for-tab.start").show()
            }));


        $(".learning-elements-wrap").length > 0 && $(".learning-elements-wrap").each(function() {
            var t = $(this).width()
            $(this).css("height", t);
            var a = $(".learning-elements-wrap .learning-item");
            if ($(window).width() > 991)
            for (var i = 0; i < a.length; i++) {
                var e = 360 / a.length,
                    o = e * i;
                $(a[i]).css("transform", "rotate(" + o + "deg) translate(0, -" + (t / 2 - 40) + "px) rotate(-" + o + "deg)")
            } else
                for (var i = 0; i < a.length; i++) {
                    var e = 360 / a.length,
                        o = e * i;
                    $(a[i]).css("transform", "rotate(" + o + "deg) translate(0, -" + (t / 2 - 15) + "px) rotate(-" + o + "deg)")
                }
        })
        }
        );
    };
    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/learning.default', LearningTabHandler);
    });
})(jQuery);