(function ($) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var EducationSliderHandler = function ($scope, $) {
        $(".education-slier").length > 0 && $(".education-slier").each(function () {
            $(this).slick();
        });
    };
    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/programs.default', EducationSliderHandler);
    });
})(jQuery);