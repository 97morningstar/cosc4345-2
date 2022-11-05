<?php

defined('ABSPATH') or exit;

/**
 * HFE_Admin setup
 *
 * @since 1.0
 */
class SMARTHF_Admin {

    /**
     * Instance of SMARTHF_Admin
     *
     * @var SMARTHF_Admin
     */
    private static $_instance = null;

    /**
     * Instance of SMARTHF_Admin
     *
     * @return SMARTHF_Admin Instance of SMARTHF_Admin
     */
    public static function instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'smart_header_footer_posttype'));
        add_action('admin_menu', array($this, 'register_admin_menu'), 50);
        add_filter('rwmb_meta_boxes', array($this, 'smart_register_metabox'));
        add_action('template_redirect', array($this, 'block_template_frontend'));
        add_filter('single_template', array($this, 'load_canvas_template'));
    }

    /**
     * Register Post type for header footer templates
     */
    public function smart_header_footer_posttype() {

        $labels = array(
            'name' => __('Header Footers Template', 'childit-core'),
            'singular_name' => __('Elementor Header Footer', 'childit-core'),
            'menu_name' => __('Header Footers Template', 'childit-core'),
            'name_admin_bar' => __('Elementor Header Footer', 'childit-core'),
            'add_new' => __('Add New', 'childit-core'),
            'add_new_item' => __('Add New Header Footer', 'childit-core'),
            'new_item' => __('New Header Footers Template', 'childit-core'),
            'edit_item' => __('Edit Header Footers Template', 'childit-core'),
            'view_item' => __('View Header Footers Template', 'childit-core'),
            'all_items' => __('All Elementor Header Footers', 'childit-core'),
            'search_items' => __('Search Header Footers Templates', 'childit-core'),
            'parent_item_colon' => __('Parent Header Footers Templates:', 'childit-core'),
            'not_found' => __('No Header Footers Templates found.', 'childit-core'),
            'not_found_in_trash' => __('No Header Footers Templates found in Trash.', 'childit-core'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'show_in_nav_menus' => false,
            'exclude_from_search' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-editor-kitchensink',
            'supports' => array('title', 'thumbnail', 'elementor'),
        );

        register_post_type('smart-hf', $args);
    }

    public function register_admin_menu() {
        add_submenu_page(
                'themes.php', __('Header Footer Builder', 'childit-core'), __('Header Footer Builder', 'childit-core'), 'edit_pages', 'edit.php?post_type=smart-hf'
        );
    }

    public function smart_register_metabox() {

        /**
         * prefix of meta keys (optional)
         * Use underscore (_) at the beginning to make keys hidden
         * Alt.: You also can make prefix empty to disable it
         */
        // Better has an underscore as last sign
        $prefix = 'smart-hf';
        $meta_boxes[] = array(
            'id' => 'framework-header-footer-post',
            'title' => esc_html__('Elementor Header Footer options', 'childit-core'),
            'pages' => array(
                'smart-hf',
            ),
            'context' => 'normal',
            'priority' => 'high',
            'tab_style' => 'left',
            'fields' => array(
                array(
                    'name' => esc_html__('Type of Template', 'childit-core'),
                    'id' => "{$prefix}-smart-hf",
                    'type' => 'select',
                    'options' => array(
                        '' => 'Select Option',
                        'header' => 'Header',
                        'footer' => 'Footer',
                        'custom' => 'Custom Block',
                    ),
                ),
        ));
        return $meta_boxes;
    }

    public function template_location($template_type) {
        $template_type = ucfirst(str_replace('type_', '', $template_type));
        return $template_type;
    }

    public function block_template_frontend() {
        if (is_singular('smart-hf') && !current_user_can('edit_posts')) {
            wp_redirect(site_url(), 301);
            die;
        }
    }

    function load_canvas_template($single_template) {
        global $post;
        if ('smart-hf' == $post->post_type) {
            $elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';
            if (file_exists($elementor_2_0_canvas)) {
                return $elementor_2_0_canvas;
            } else {
                return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
            }
        }
        return $single_template;
    }

}

/**
 * Load the Plugin Class.
 */
function smarthfe_init() {
    new SMARTHF_Admin();
}

add_action('plugins_loaded', 'smarthfe_init');

//new SMARTHF_Admin();