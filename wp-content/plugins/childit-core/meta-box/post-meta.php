<?php

add_filter('rwmb_meta_boxes', 'childit_register_framework_post_meta_box');

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @return void
 */
function childit_register_framework_post_meta_box($meta_boxes) {

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

    $meta_boxes[] = array(
        'id' => 'framework-meta-box-post-format-quote',
        'title' => esc_html__('Post Format Data', 'childit-core'),
        'pages' => array(
            'post',
        ),
        'context' => 'normal',
        'priority' => 'high',
        'tab_style' => 'left',
        'fields' => array(
            array(
                'name' => esc_html__('Quote Text', 'childit-core'),
                'desc' => esc_html__('Insert Quote Text.', 'childit-core'),
                'id' => "{$prefix}-quote",
                'type' => 'textarea',
            ),
    ));

    $meta_boxes[] = array(
        'id' => 'framework-meta-box-post-format-video',
        'title' => esc_html__('Post Format Data', 'childit-core'),
        'pages' => array(
            'post',
        ),
        'context' => 'normal',
        'priority' => 'high',
        'tab_style' => 'left',
        'fields' => array(
            array(
                'name' => esc_html__('Video Markup', 'childit-core'),
                'desc' => esc_html__('Put embed src of video. i.e. youtube, vimeo', 'childit-core'),
                'id' => "{$prefix}-video-markup",
                'type' => 'textarea',
                'cols' => 20,
                'rows' => 3,
            ),
    ));

    $meta_boxes[] = array(
        'id' => 'framework-meta-box-post-format-audio',
        'title' => esc_html__('Post Format Data', 'childit-core'),
        'pages' => array(
            'post',
        ),
        'context' => 'normal',
        'priority' => 'high',
        'tab_style' => 'left',
        'fields' => array(
            array(
                'name' => esc_html__('Audio Markup', 'childit-core'),
                'desc' => esc_html__('Put embed src of video. i.e. youtube, vimeo', 'childit-core'),
                'id' => "{$prefix}-audio-markup",
                'type' => 'textarea',
                'cols' => 20,
                'rows' => 3,
            ),
    ));

    $meta_boxes[] = array(
        'id' => 'framework-meta-box-post-format-link',
        'title' => esc_html__('Post Format Data', 'childit-core'),
        'pages' => array(
            'post',
        ),
        'context' => 'normal',
        'priority' => 'high',
        'tab_style' => 'left',
        'fields' => array(
            array(
                'name' => esc_html__('Link', 'childit-core'),
                'desc' => esc_html__('Works with link post format.', 'childit-core'),
                'id' => "{$prefix}-link",
                'type' => 'text',
            )
    ));

    $meta_boxes[] = array(
        'id' => 'framework-meta-box-post-format-gallery',
        'title' => esc_html__('Post Format Data', 'childit-core'),
        'pages' => array(
            'post',
        ),
        'context' => 'normal',
        'priority' => 'high',
        'tab_style' => 'left',
        'fields' => array(
            array(
                'name' => esc_html__('Upload Gallery Images', 'childit-core'),
                'id' => "{$prefix}-gallery",
                'desc' => '',
                'type' => 'image_advanced',
                'max_file_uploads' => 24,
            ),
    ));

    $meta_boxes[] = array(
        'id' => 'framework-events-post-meta-image',
        'title' => esc_html__('Design Settings', 'childit-core'),
        'pages' => array(
            'staffs',
        ),
        'context' => 'normal',
        'priority' => 'high',
        'tab_style' => 'left',
        'fields' => array(
            array(
                'name' => esc_html__('Designation', 'childit-core'),
                'id' => "{$prefix}-designation",
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Facebook', 'childit-core'),
                'id' => "{$prefix}-facebook",
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Twitter', 'childit-core'),
                'id' => "{$prefix}-twitter",
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Instagram', 'childit-core'),
                'id' => "{$prefix}-instagram",
                'type' => 'text',
            )
    ));

    $meta_boxes[] = array(
        'id' => 'framework-program-post',
        'title' => esc_html__('Custom Post Data', 'childit-core'),
        'pages' => array(
            'our-programs',
        ),
        'context' => 'normal',
        'priority' => 'high',
        'tab_style' => 'left',
        'fields' => array(
            array(
                'name' => esc_html__('Education Age', 'childit-core'),
                'id' => "{$prefix}-age",
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Education Age', 'childit-core'),
                'desc' => esc_html__('Education Age', 'childit-core'),
                'id' => "{$prefix}-old",
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Teachers', 'childit-core'),
                'desc' => esc_html__('Teachers', 'childit-core'),
                'id' => "{$prefix}-teachers",
                'type' => 'textarea',
            ),
            array(
                'name' => esc_html__('Upload Gallery Images', 'childit-core'),
                'id' => "{$prefix}-gallery",
                'type' => 'image_advanced',
                'max_file_uploads' => 20,
            ),
    ));


    $meta_boxes[] = array(
        'id' => 'framework-events-post-meta-image',
        'title' => esc_html__('Design Settings', 'childit-core'),
        'pages' => array(
            'tribe_events',
        ),
        'context' => 'normal',
        'priority' => 'high',
        'tab_style' => 'left',
        'fields' => array(
            array(
                'name' => esc_html__('Event Image', 'childit-core'),
                'id' => "{$prefix}_event_meta_image",
                'desc' => '',
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'name' => esc_html__('Event breadcrumb Image', 'childit-core'),
                'id' => "{$prefix}_event_bg_meta_image",
                'desc' => '',
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
            )
    ));

    return $meta_boxes;
}
