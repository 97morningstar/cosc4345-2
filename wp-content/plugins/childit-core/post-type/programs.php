<?php

namespace ChildIt\CPT;

Class Programs {

    public static function register() {
        $instance = new self;
        add_action('init', [$instance, 'registerPostType']);
    }

// Register Custom Post Type
    function registerPostType() {
        $slug_postype_program = 'program'; //'program'

        $labels = array(
            'name' => _x('Programs', 'Post Type General Name', 'childit-core'),
            'singular_name' => _x('Program', 'Post Type Singular Name', 'childit-core'),
            'menu_name' => __('Programs', 'childit-core'),
            'name_admin_bar' => __('Program', 'childit-core'),
            'archives' => __('Item Archives', 'childit-core'),
            'parent_item_colon' => __('Parent Item:', 'childit-core'),
            'all_items' => __('All Programs', 'childit-core'),
            'add_new_item' => __('Add New Program', 'childit-core'),
            'add_new' => __('Add New Program', 'childit-core'),
            'new_item' => __('New Program Item', 'childit-core'),
            'edit_item' => __('Edit Program Item', 'childit-core'),
            'update_item' => __('Update Program Item', 'childit-core'),
            'view_item' => __('View Program Item', 'childit-core'),
            'search_items' => __('Search Item', 'childit-core'),
            'not_found' => __('Not found', 'childit-core'),
            'not_found_in_trash' => __('Not found in Trash', 'childit-core'),
            'featured_image' => __('Featured Image', 'childit-core'),
            'set_featured_image' => __('Set featured image', 'childit-core'),
            'remove_featured_image' => __('Remove featured image', 'childit-core'),
            'use_featured_image' => __('Use as featured image', 'childit-core'),
            'insert_into_item' => __('Insert into item', 'childit-core'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'childit-core'),
            'items_list' => __('Items list', 'childit-core'),
            'items_list_navigation' => __('Items list navigation', 'childit-core'),
            'filter_items_list' => __('Filter items list', 'childit-core'),
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Description.', 'childit-core'),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $slug_postype_program),
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        );

        register_post_type('our-programs', $args);
    }

}
