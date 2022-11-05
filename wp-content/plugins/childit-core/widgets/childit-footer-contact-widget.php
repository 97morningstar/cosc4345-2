<?php
add_action('widgets_init', 'childit_footer_contact');

function childit_footer_contact() {
    register_widget('ChilditFooterContact');
}

class ChilditFooterContact extends WP_Widget {

    private $defaults = array();

    function __construct() {

        $this->defaults = array(
            'title' => esc_html__('Our Contacts', 'childit-core'),
            'address' => '3261 Anmoore Road Brooklyn, NY 11230',
            'phone' => '800-123-4567, Fax: 718-724-3312',
            'email' => 'officeone@youremail.com',
            'hours' => 'Mon-Fri: 9:00 am – 5:00 pm<br>Sat: 11:00 am – 16:00 pm',
        );
        parent::__construct(
                'childit_contact_box', // Base ID  
                esc_html__('Childit Contact Box', 'childit-core'), // Name  
                array(
            'description' => esc_html__('Footer Contact Box.', 'childit-core')
                )
        );
    }

    function update($new_instance, $old_instance) {
        $defaults = $this->defaults;
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['address'] = $new_instance['address'];
        $instance['phone'] = $new_instance['phone'];
        $instance['email'] = $new_instance['email'];
        $instance['hours'] = $new_instance['hours'];
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->defaults);
        $title = isset($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'childit-core'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>"  value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address', 'childit-core') ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>"><?php echo wp_kses_post($instance['address']); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone', 'childit-core') ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>"><?php echo wp_kses_post($instance['phone']); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email', 'childit-core') ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>"><?php echo wp_kses_post($instance['email']); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('hours')); ?>"><?php esc_html_e('Hours', 'childit-core') ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('hours')); ?>" name="<?php echo esc_attr($this->get_field_name('hours')); ?>"><?php echo wp_kses_post($instance['hours']); ?></textarea>
        </p>
        <?php
    }

    function widget($args, $instance) {
        $instance = wp_parse_args((array) $instance, $this->defaults);
        extract($args);
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        ?>
        <div class="contact-list">
        <?php if ($instance['address']){ ?>
            <a href="#" target="_blank">
                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'map-marker-small.svg'); ?>' alt="<?php esc_attr_e('marker', 'childit-core'); ?>"> <?php echo wp_kses_post($instance['address']); ?></a>            
        <?php }if($instance['phone']){ ?>
                <a href="tel:<?php echo $instance['phone']; ?>">
                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'call.svg'); ?>' alt="<?php esc_attr_e('call', 'childit-core'); ?>"> <?php echo wp_kses_post($instance['phone']); ?></a>
        <?php }if($instance['email']){ ?>
            <a href="mailto:<?php echo $instance['email']; ?>">
                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'envelope.svg'); ?>' alt="<?php esc_attr_e('img', 'childit-core'); ?>"><?php echo wp_kses_post($instance['email']); ?> </a>
        <?php }if($instance['hours']){ ?>
            <p>
                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'clock.svg'); ?>' alt="<?php esc_attr_e('img', 'childit-core'); ?>"><?php echo wp_kses_post($instance['hours']); ?></p>
        <?php } ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

}
