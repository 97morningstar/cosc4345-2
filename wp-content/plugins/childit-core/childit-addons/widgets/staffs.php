<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Staffs extends Widget_Base {

    public function get_name() {
        return 'staffs';
    }

    public function get_title() {
        return __('Staffs', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return ['childit'];
    }

    public function get_script_depends() {
        return ['staffs'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'section_blogs', [
            'label' => __('Staffs', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Get to know our staff', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Dedicated Teachers & Staff', 'childit-core'),
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Our staff are dedicated to enhancing the lives of children with diverse special needs by providing evaluations and other services for children to achieve full and independent lives.', 'childit-core'),
                ]
        );

        $this->add_control(
                'number', [
            'label' => __('Number of Post', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 4,
                ]
        );

        $this->add_control(
                'order_by', [
            'label' => __('Order By', 'childit-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'date',
            'options' => [
                'date' => __('Date', 'childit-core'),
                'ID' => __('ID', 'childit-core'),
                'author' => __('Author', 'childit-core'),
                'title' => __('Title', 'childit-core'),
                'modified' => __('Modified', 'childit-core'),
                'rand' => __('Random', 'childit-core'),
                'comment_count' => __('Comment count', 'childit-core'),
                'menu_order' => __('Menu order', 'childit-core'),
            ],
                ]
        );

        $this->add_control(
                'order', [
            'label' => __('Order', 'childit-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'desc',
            'options' => [
                'desc' => __('DESC', 'childit-core'),
                'asc' => __('ASC', 'childit-core'),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'text_style_section',
			array(
				'label' => __( 'Text Style', 'childit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .section-header .h-sub',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .section-header h2',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        ?>
        <!-- Begin centre-information -->
        <section class="centre-information-section mb-xs-50 mb-sm-60 mb-md-70 mb-lg-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header mb-xs-30 mb-md-31">
                            <p class="h-sub">
                                <?php
                                echo wp_kses_post($settings['title_1']);
                                ?>
                            </p>
                            <h2>
                                <?php
                                echo wp_kses_post($settings['title_2']);
                                ?>
                            </h2>
                            <p>
                                <?php
                                echo wp_kses_post($settings['content']);
                                ?>
                            </p>
                        </div>
                        <div class="centre-tabs" data-tab-group>
                            <div class="centre-tabs-controls">
                                <ul class="centre-tab-list" data-tab-head>
                                    <?php
                                    $taxonomies = get_terms(
                                            array(
                                                'taxonomy' => 'staff',
                                                'parent' => 0,
                                            )
                                    );
                                    if (is_array($taxonomies) && count($taxonomies) > 0) {
                                        foreach ($taxonomies as $key => $category) {
                                            $active = '';
                                            if ($key == 0) {
                                                $active = 'active';
                                            }
                                            ?>
                                            <li><a href="#"
                                                   class="<?php echo esc_attr($active); ?>"><?php echo wp_kses_post($category->name); ?></a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="centre-tabs-wrap" data-tab-content>
                                <?php
                                if (is_array($taxonomies) && count($taxonomies) > 0) {
                                    foreach ($taxonomies as $key => $category) {
                                        $args = array(
                                            'posts_per_page' => $posts_per_page,
                                            'post_type' => 'staffs',
                                            'orderby' => $order_by,
                                            'order' => $order,
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'staff',
                                                    'field' => 'term_id',
                                                    'terms' => $category->term_id,
                                                ),
                                            ),
                                        );
                                        $query = new \WP_Query($args);
                                        ?>
                                        <div class="centre-tab-content tab-content">
                                            <div class="teacher-slider" data-show-count='3' data-show-count-md='2'
                                                 data-show-count-mob='1' data-slick-speed="5000" data-slick-autoplay="true">
                                                     <?php
                                                     if ($query) {
                                                         while ($query->have_posts()) {
                                                             $query->the_post();
                                                             $childit_featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                             $childit_designation = get_post_meta(get_the_ID(), 'childit-designation', true);
                                                             $childit_facebook = get_post_meta(get_the_ID(), 'childit-facebook', true);
                                                             $childit_twitter = get_post_meta(get_the_ID(), 'childit-twitter', true);
                                                             $childit_instagram = get_post_meta(get_the_ID(), 'childit-instagram', true);
                                                             ?>
                                                        <div class="teacher-slide">
                                                            <div class="teacher-card second-style">
                                                                <div class="teacher-card-top">
                                                                    <div class="avatar-circle">
                                                                        <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>"
                                                                             class="teacher-card__avatar lazy"
                                                                             data-src='<?php echo esc_url($childit_featured_image); ?>'
                                                                             alt="<?php echo esc_attr('avatar'); ?>">
                                                                    </div>
                                                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>"
                                                                         class="cloud lazy"
                                                                         data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'cloud.svg'); ?>'
                                                                         alt="<?php echo esc_attr('cloud'); ?>">
                                                                </div>
                                                                <div class="teacher-card__info">
                                                                    <h5><?php echo the_title(); ?></h5>
                                                                    <p class="main-color-font"><?php echo wp_kses_post($childit_designation); ?>
                                                                    </p>
                                                                    <?php
                                                                    the_content();
                                                                    ?>
                                                                    <ul class="soc-link soc-link__bg">
                                                                        <?php if (!empty($childit_facebook)) { ?>
                                                                            <li>
                                                                                <a href="<?php echo esc_url($childit_facebook); ?>">
                                                                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>"
                                                                                         class="lazy"
                                                                                         data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'facebook.svg'); ?>'
                                                                                         title='<?php echo esc_attr('Facebook'); ?>'
                                                                                         alt="<?php echo esc_attr('facebook'); ?>">
                                                                                </a>
                                                                            </li>
                                                                            <?php
                                                                        }
                                                                        if (!empty($childit_twitter)) {
                                                                            ?>
                                                                            <li>
                                                                                <a href="<?php echo esc_url($childit_twitter); ?>">
                                                                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>"
                                                                                         class="lazy"
                                                                                         data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'twitter.svg'); ?>'
                                                                                         title='<?php echo esc_attr('Twitter'); ?>'
                                                                                         alt="<?php echo esc_attr('twitter'); ?>">
                                                                                </a>
                                                                            </li>
                                                                            <?php
                                                                        }
                                                                        if (!empty($childit_instagram)) {
                                                                            ?>
                                                                            <li>
                                                                                <a href="<?php echo esc_url($childit_instagram); ?>">
                                                                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>"
                                                                                         class="lazy"
                                                                                         data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'instagram.svg'); ?>'
                                                                                         title='<?php echo esc_attr('Instagram'); ?>'
                                                                                         alt="<?php echo esc_attr('Instagram'); ?>">
                                                                                </a>
                                                                            </li>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    wp_reset_postdata();
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End centre-information -->
            <?php
        }
    }

}
