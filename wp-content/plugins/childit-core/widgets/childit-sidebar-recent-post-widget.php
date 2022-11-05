<?php
add_action('widgets_init', 'childit_sidebar_recent_post');

function childit_sidebar_recent_post() {
    register_widget('ChilditRecentPost');
}

class ChilditRecentPost extends WP_Widget {

    private $defaults = array();

    function __construct() {
        $this->defaults = array(
            'title' => esc_html__('Recent Post', 'childit-core'),
            'number' => 3,
        );
        parent::__construct('posts-widget', esc_html__('Childit Sidebar Recent Posts', 'childit-core'));
    }

    function update($new_instance, $old_instance) {
        $defaults = $this->defaults;
        $instance = $old_instance;
        $instance['title'] = esc_attr($new_instance['title']);
        $instance['number'] = intval($new_instance['number']);
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->defaults);
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'childit-core'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>"  value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
        <p>
            <label for="<?php print esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts:', 'childit-core'); ?>
                <input class="widefat" id="<?php print esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo isset($instance['number']) ? esc_attr($instance['number']) : ''; ?>" />
            </label>
        </p>
        <?php
    }

    function widget($args, $instance) {
        $instance = wp_parse_args((array) $instance, $this->defaults);
        extract($args);
        $number = isset($instance['number']) ? $instance['number'] : 3;
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        ?>
        <?php
        $query_args = array(
            'posts_per_page' => $number,
            'no_found_rows' => true,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true
        );
        $query = new WP_Query($query_args);
        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                $childit_featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'childit_blog_post_sidebar_image');
                ?>
                <div class="side-post">
                    <div class="post-image">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url($childit_featured_image_url); ?>" alt="<?php esc_attr_e('Img', 'childit-core'); ?>">
                        </a>
                    </div>
                    <div>
                        <p class="post-meta">
                            <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time>
                        </p>
                        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_query();
            echo $args['after_widget'];
        }
    }

}
