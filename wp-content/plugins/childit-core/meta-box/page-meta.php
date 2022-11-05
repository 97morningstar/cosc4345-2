<?php

add_filter('rwmb_meta_boxes', 'childit_register_framework_page_meta_box');

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @return void
 */
function childit_register_framework_page_meta_box($meta_boxes) {

    global $wp_registered_sidebars;

    $sidebars = array(
        '0' => esc_html__('Default Widget', 'childit-core')
    );

    foreach ($wp_registered_sidebars as $key => $value) {
        $sidebars[$key] = $value['name'];
    }

    /**
     * prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */
    // Better has an underscore as last sign
    $prefix = 'childit';

 
    $posts_page = get_option('page_for_posts');

    if (!isset($_GET['post']) || intval($_GET['post']) != $posts_page) {

        $meta_boxes[] = array(
            'id' => $prefix . '_page_meta_box',
            'title' => esc_html__('Page Design Settings', 'childit-core'),
            'pages' => array(
                'page',
            ),
            'context' => 'normal',
            'priority' => 'core',
            'fields' => array(
                array(
                    'id' => "{$prefix}_show_page_title",
                    'name' => esc_html__('Show Page Titlebar', 'childit-core'),
                    'desc' => '',
                    'type' => 'radio',
                    'std' => "on",
                    'options' => array('on' => 'Yes', 'off' => 'No'),
                ),
                array(
                    'id' => "{$prefix}_show_breadcrumb",
                    'name' => esc_html__('Show Breadcrumb', 'childit-core'),
                    'desc' => '',
                    'type' => 'radio',
                    'std' => "on",
                    'options' => array('on' => 'Yes', 'off' => 'No'),
                )
            )
        );
    }
    return $meta_boxes;
}