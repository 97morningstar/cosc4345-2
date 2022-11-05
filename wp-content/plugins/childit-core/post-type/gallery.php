<?php

namespace ChildIt\CPT;

Class Gallery {

    public static function register() {
        $instance = new self;
        add_action('init', [$instance, 'registerPostType']);
        add_action('init', [$instance, 'add_custom_taxonomies']);
    }

// Register Custom Post Type
    function registerPostType() {
        $slug_postype_Gallery = 'gallery'; //'Gallery'

        $labels = array(
            'name' => _x('Galleries', 'Post Type General Name', 'childit-core'),
            'singular_name' => _x('Gallery', 'Post Type Singular Name', 'childit-core'),
            'menu_name' => __('Galleries', 'childit-core'),
            'name_admin_bar' => __('Gallery', 'childit-core'),
            'archives' => __('Item Archives', 'childit-core'),
            'parent_item_colon' => __('Parent Item:', 'childit-core'),
            'all_items' => __('All Galleries', 'childit-core'),
            'add_new_item' => __('Add New Gallery', 'childit-core'),
            'add_new' => __('Add New Gallery', 'childit-core'),
            'new_item' => __('New Gallery Item', 'childit-core'),
            'edit_item' => __('Edit Gallery Item', 'childit-core'),
            'update_item' => __('Update Gallery Item', 'childit-core'),
            'view_item' => __('View Gallery Item', 'childit-core'),
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
            'rewrite' => array('slug' => $slug_postype_Gallery),
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title','thumbnail'),

        );

        register_post_type('galleries', $args);
    }


    function add_custom_taxonomies() {

    register_taxonomy('gallery', 'galleries', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x('Gallery Categories', 'childit-core'),
            'singular_name' => _x('Category', 'childit-core'),
            'search_items' => __('Search Categories'),
            'all_items' => __('All Categories'),
            'parent_item' => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item' => __('Edit Category'),
            'update_item' => __('Update Category'),
            'add_new_item' => __('Add New Category'),
            'new_item_name' => __('New Category Name'),
            'menu_name' => __('Gallery  Categories'),
        ),
        'rewrite' => array(
            'slug' => 'gallery',
            'with_front' => false,
            'hierarchical' => true
        )
    ));
}

}
