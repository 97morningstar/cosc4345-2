<?php
// Silence is golden.
add_action(
        'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category(
            'childit', [
        'title' => __('ChildIt', 'childit-core'),
        'icon' => 'fa fa-plug',
            ], 1
    );
}
);

function childit_post_thumbnail_image($size = 'full') {
    $childit_featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'childit_galleries_home');
    ?>
    <picture>
        <source type="image/jpeg" srcset="<?php echo esc_url($childit_featured_image_url); ?>">
        <img src="<?php echo esc_url($childit_featured_image_url); ?>" alt="<?php esc_attr_e('Img', 'childit'); ?>">
    </picture>
    <?php
}




/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param  string $string
 * @return string
 */
function childit_kses_basic( $string = '' ) {
    return wp_kses( $string, childit_get_allowed_html_tags( 'basic' ) );
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param  string $string
 * @return string
 */
function childit_kses_intermediate( $string = '' ) {
    return wp_kses( $string, childit_get_allowed_html_tags( 'intermediate' ) );
}

function childit_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
    ];

    if ( $level === 'intermediate' ) {
        $allowed_html['a'] = [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ];
    }

    return $allowed_html;
}