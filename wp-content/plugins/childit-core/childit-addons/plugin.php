<?php

namespace ChildItAddons;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

     /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {
        // Register widget scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
        // Register widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts() {
        wp_register_script('main-slider', plugins_url('/assets/js/main-slider.js', __FILE__), ['jquery'], time(), true);
        wp_register_script('learn-tab', plugins_url('/assets/js/learn-tab.js', __FILE__), ['jquery'], time(), true);
        wp_register_script('education-slider', plugins_url('/assets/js/education-slier.js', __FILE__), ['jquery'], time(), true);
        wp_register_script('blogs', plugins_url('/assets/js/blogs.js', __FILE__), ['jquery'], time(), true);
        wp_register_script('pricing-packages', plugins_url('/assets/js/pricing-packages.js', __FILE__), ['jquery'], time(), true);
        wp_register_script('centre-information', plugins_url('/assets/js/centre-information.js', __FILE__), ['jquery'], time(), true);
        wp_register_script('vision-mission', plugins_url('/assets/js/vision-mission.js', __FILE__), ['jquery'], time(), true);
        wp_register_script('staffs', plugins_url('/assets/js/staffs.js', __FILE__), ['jquery'], time(), true);
        wp_register_script('programs-page', plugins_url('/assets/js/programs-page.js', __FILE__), ['jquery'], time(), true);

        wp_enqueue_script('main-slider');
        wp_enqueue_script('blogs');
        wp_enqueue_script('education-slider');
        wp_enqueue_script('learn-tab');
        wp_enqueue_script('pricing-packages');
        wp_enqueue_script('centre-information');
        wp_enqueue_script('vision-mission');
        wp_enqueue_script('staffs');
        wp_enqueue_script('programs-page');
    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_widgets_files() {
        require_once( __DIR__ . '/widgets/main-slider.php');
        require_once( __DIR__ . '/widgets/about-us.php' );
        require_once( __DIR__ . '/widgets/programs.php' );
        require_once( __DIR__ . '/widgets/learning.php' );
        require_once( __DIR__ . '/widgets/video-section.php' );
        require_once( __DIR__ . '/widgets/advantage.php' );
        require_once( __DIR__ . '/widgets/foods.php' );
        require_once( __DIR__ . '/widgets/foods-2.php' );
        require_once( __DIR__ . '/widgets/centre-information.php' );
        require_once( __DIR__ . '/widgets/blogs.php' );
        require_once( __DIR__ . '/widgets/about-us-2.php' );
        require_once( __DIR__ . '/widgets/vision-mission.php' );
        require_once( __DIR__ . '/widgets/advantage-2.php' );
        require_once( __DIR__ . '/widgets/count.php' );
        require_once( __DIR__ . '/widgets/contacts.php' );
        require_once( __DIR__ . '/widgets/faq.php' );
        require_once( __DIR__ . '/widgets/parent-info.php' );
        require_once( __DIR__ . '/widgets/pricing-packages.php' );
        require_once( __DIR__ . '/widgets/pricing-tables.php' );
        require_once( __DIR__ . '/widgets/about-us-price.php' );
        require_once( __DIR__ . '/widgets/testimonials.php' );
        require_once( __DIR__ . '/widgets/gallery.php' );
        require_once( __DIR__ . '/widgets/staffs.php' );
        require_once( __DIR__ . '/widgets/page-gallery.php' );
        require_once( __DIR__ . '/widgets/programs-page.php' );
        require_once( __DIR__ . '/widgets/guidance-section.php' );
        require_once( __DIR__ . '/widgets/page-gallery-full.php' );
        require_once( __DIR__ . '/widgets/about-us-3.php' );
    }

    /**
     * Register Widgets
     *
     * Register widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets() {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();
        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Main_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\About_Us());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Programs());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Learning());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Video_Section());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Advantage());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foods());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Centre_Information());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Blogs());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\About_Section());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Vision_Mission());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Advantage2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Count());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Contacts());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Faq());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Parent_Info());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Pricing_Packages());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Pricing_Tables());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Testimonials());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Gallery());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Staffs());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Page_Gallery());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Programs_Page());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Guidance());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Page_Gallery_full());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Foods2());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\About_Us_Price());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\About_Us_Three());
    }


}

// Instantiate Plugin Class
Plugin::instance();
