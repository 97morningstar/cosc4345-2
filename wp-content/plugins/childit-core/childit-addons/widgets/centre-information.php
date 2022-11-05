<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;
use Elementor\Utils;
use Elementor\Plugin;
use \Elementor\Repeater;

class Centre_Information extends Widget_Base {

    public function get_name() {
        return 'centre-information';
    }

    public function get_title() {
        return __('Centre Information', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['childit'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['centre-information'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'title_section', [
            'label' => __('Title', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Want to know more about us?', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Centre Information', 'childit-core'),
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'philosophy_section', [
            'label' => __('Tab 1', 'childit-core'),
                ]
        );

        $this->add_control(
                'tab_title_1', [
            'label' => __('Tab Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Our Philosophy', 'childit-core'),
                ]
        );
        $this->add_control(
                'philo_title', [
            'label' => __('Title', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('We believe children learn by building on the knowledge they already have – primarily exhibited through play. Teachers help children learn by creating a rich environment to explore via exciting educational activities.', 'childit-core'),
                ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
                'title_1', [
            'label' => __('Title one', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );
        $repeater->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $this->add_control(
                'item_list', [
            'label' => __('Item List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title_1' => __('Image of the child', 'childit-core'),
                    'content' => __('Teachers can then shape and build on that knowledge by discovering what children already know through observation, one-on-one conversation, clarification, and invitation to explore the world around them.', 'childit-core'),
                ],
                [
                    'title_1' => __('Positive Discipline', 'childit-core'),
                    'content' => __('Spanking or other methods of corporal punishment are never to be used as a means of disciplining students. This no spanking policy extends to parents with their own children while at school or school sponsored events.', 'childit-core'),
                ],
                [
                    'title_1' => __('Environment is important', 'childit-core'),
                    'content' => __('We like to work and play in attractive surroundings so our buildings are clean, relatively tidy, and pleasing to the eye. The outdoor environments are large, have colourful and interesting gardens, and a variety of activities.', 'childit-core'),
                ]
            ]
                ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
                'values_section', [
            'label' => __('Tab 2', 'childit-core'),
                ]
        );

        $this->add_control(
                'tab_title_2', [
            'label' => __('Tab Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Our Values', 'childit-core'),
                ]
        );
        $this->add_control(
                'image', [
            'label' => __('Image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'value_title', [
            'label' => __('Heading', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Positive, Safe Environment – We are committed to providing an uplifting and positive atmosphere for our children and staff; a fun learning experience in a secure, safe, and loving environment.', 'childit-core'),
                ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $this->add_control(
                'value_list', [
            'label' => __('Item List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'content' => '<strong>Leadership</strong> – We are committed to lead; developing, monitoring, and empowering our children and our staff to reach their full potential.'
                ],
                [
                    'content' => '<strong>Excellence</strong> – We are committed to achieve the greatest levels of excellence in childcare, in education and in everything we do; being highly professional, innovative, creative, efficient, and effective.'
                ],
                [
                    'content' => '<strong>Respect</strong> – We are committed to building strong, healthy relationships with each other, our children & their families, along with the community through communication and understanding of the cultures around us.'
                ],
                [
                    'content' => '<strong>Integrity</strong> – We are committed to carry out our mission.'
                ]
            ]
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'teacher_section', [
            'label' => __('Tab 3', 'childit-core'),
                ]
        );

        $this->add_control(
                'tab_title_3', [
            'label' => __('Tab Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Our Teachers', 'childit-core'),
                ]
        );

        $this->add_control(
                'heading_title', [
            'label' => __('Heading', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'placeholder' => __('Type your title here', 'childit-core'),
            'default' => __('We have a focus on recruiting and retaining quality teachers and offer competitive remuneration, good student discipline and relatively small class sizes', 'childit-core'),
                ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
                'image', [
            'label' => __('Image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'title_1', [
            'label' => __('Name', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $repeater->add_control(
                'title_2', [
            'label' => __('Designation', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $repeater->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
                ]
        );

        $repeater->add_control(
                'facebook', [
            'label' => __('Facebook URL', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_url('#')
                ]
        );

        $repeater->add_control(
                'twitter', [
            'label' => __('Twitter URL', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_url('#')
                ]
        );

        $repeater->add_control(
                'instagram', [
            'label' => __('Instagram URL', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_url('#')
                ]
        );
        $repeater->add_control(
			'posx',
			array(
				'label' => __('Horizontal Position', 'plugin-domain'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 1200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}} !important;',
				],
			)
		);
		$repeater->add_control(
			'posy',
			[
				'label' => __('Vertical Position', 'plugin-domain'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_control(
                'tacher_list', [
            'label' => __('Item List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title_1' => __('Lindsay', 'childit-core'),
                    'title_2' => __('Infant Classroom', 'childit-core'),
                    'content' => __('She has never tired of the “ah-ha” moments and the pride that swells in a little one who is learning to do something for the first time.', 'childit-core'),
                ],
                [
                    'title_1' => __('Kate', 'childit-core'),
                    'title_2' => __('Infant Classroom', 'childit-core'),
                    'content' => __('She has never tired of the “ah-ha” moments and the pride that swells in a little one who is learning to do something for the first time.', 'childit-core'),
                ],
                [
                    'title_1' => __('Maria', 'childit-core'),
                    'title_2' => __('Lead Teacher', 'childit-core'),
                    'content' => __('Maria has a Masters degree in Early Childhood Education, a Montessori certification for children ages 3-6.', 'childit-core'),
                ]
            ]
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'section_testimonials', [
            'label' => __('Tab 4', 'childit-core'),
                ]
        );

        $this->add_control(
                'tab_title_4', [
            'label' => __('Tab Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Parents Say', 'childit-core'),
                ]
        );

        $this->add_control(
                'testimonial_heading', [
            'label' => __('Title 1', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('If you have feedback or words of praise that you would like to share, please submit your review at the bottom of this page.', 'childit-core'),
                ]
        );

        $this->add_control(
                'number', [
            'label' => __('Number of Testimonials', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 3
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
                'menu_order' => __('Menu order', 'childit-core')
            ]
                ]
        );

        $this->add_control(
                'order', [
            'label' => __('Order', 'childit-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'desc',
            'options' => [
                'desc' => __('DESC', 'childit-core'),
                'asc' => __('ASC', 'childit-core')
            ]
                ]
        );

        $this->add_control(
                'view_more', [
            'label' => __('View More', 'childit-core'),
            'type' => Controls_Manager::URL,
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
				'selector' => '{{WRAPPER}} .section-header.on-scroll.show-scroll h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .section-header.on-scroll.show-scroll .h-sub',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .centre-tab-content .tab-head',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_tab_typography',
				'label'    => __( 'Content Tab Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .centre-tab-list li a',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_url = ( $settings['image']['id'] != '' ) ? wp_get_attachment_url($settings['image']['id']) : $settings['image']['url'];
        ?>
        <!-- Begin centre-information -->
        <section class="centre-information-section mb-xs-50 mb-sm-60 mb-md-70 mb-lg-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header mb-xs-30 mb-md-31 on-scroll">
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
                        </div>
                        <div class="my-paroller" data-paroller-factor="0.3" data-paroller-type="foreground" data-paroller-direction="vertical">
                            <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png') ?>" class="lazy" data-src="<?php echo esc_url(CHILDIT_IMG_URL . 'cloud.png') ?>" alt="<?php echo esc_attr('img'); ?>">
                        </div>
                        <div class="centre-tabs on-scroll fade-up" data-tab-group>
                            <div class="centre-tabs-controls">
                                <ul class="centre-tab-list" data-tab-head>
                                       <?php
                                        if( !empty($settings['tab_title_1'])){ ?>
                                          <li><a href="#" id="centreTab1" class="active"><?php  echo childit_kses_basic($settings['tab_title_1']); ?></a></li>
                                        <?php }
                                        ?>
                                        <?php
                                        if( !empty($settings['tab_title_2'])){ ?>
                                          <li><a href="#" id="centreTab2"><?php echo childit_kses_basic($settings['tab_title_2']); ?></a></li>
                                        <?php }
                                        ?>
                                        <?php
                                        if( !empty($settings['tab_title_3'])){ ?>
                                          <li><a href="#" id="centreTab3"><?php echo childit_kses_basic($settings['tab_title_3']); ?></a></li>
                                        <?php }
                                        ?>
                                        <?php
                                        if( !empty($settings['tab_title_4'])){ ?>
                                          <li><a href="#" id="centreTab4"><?php echo childit_kses_basic($settings['tab_title_4']); ?></a></li>
                                        <?php }
                                        ?>
                                   
                                </ul>
                            </div>
                            <div class="centre-tabs-wrap" data-tab-content>
                                <div class="centre-tab-content tab-content">
                                    <p class="tab-head">
                                        <?php
                                        echo wp_kses_post($settings['philo_title']);
                                        ?>
                                    </p>
                                    <ol class="order-list-2 adventage-slider" data-show-count='3' data-show-count-md='2' data-show-count-mob='1' data-slick-speed="5000" data-slick-autoplay="true">
                                        <?php
                                        if (!empty($settings['item_list'])) {
                                            foreach ($settings['item_list'] as $item) {
                                                ?>
                                                <li>
                                                    <div class="list-description">
                                                        <h5 class="mb-15"><?php echo wp_kses_post($item['title_1']); ?></h5>
                                                        <p><?php echo wp_kses_post($item['content']); ?></p>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ol>
                                </div>
                                <div class="centre-tab-content tab-content">
                                    <div class="tab-values">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="tab-values__img">
                                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy " data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr('img'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="tab-values__description">
                                                    <p>
                                                        <?php
                                                        echo wp_kses_post($settings['value_title']);
                                                        ?>
                                                    </p>
                                                    <ul>
                                                        <?php
                                                        if (!empty($settings['value_list'])) {
                                                            foreach ($settings['value_list'] as $item) {
                                                                ?>
                                                                <li>
                                                                    <p><?php echo wp_kses_post($item['content']); ?></p>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="centre-tab-content tab-content">
                                    <p class="tab-head"><?php echo wp_kses_post($settings['heading_title']); ?></p>
                                    <div class="teacher-slider" data-show-count='3' data-show-count-md='2' data-show-count-mob='1' data-slick-speed="5000" data-slick-autoplay="true">
                                        <?php
                                        if (!empty($settings['tacher_list'])) {
                                            $i = 1;
                                            foreach ($settings['tacher_list'] as $item) {
                                                $childit_facebook = $item['facebook'];
                                                $childit_twitter = $item['twitter'];
                                                $childit_instagram = $item['instagram'];
                                                $extra_class = '';
                                                if ($i == 1) {
                                                    $extra_class = 'extra__avatar';
                                                } elseif ($i == 3) {
                                                    $extra_class = 'extra__avatar02';
                                                }
                                                ?>
                                                <div class="teacher-slide">
                                                    <div class="teacher-card">
                                                        <div class="teacher-card__info">
                                                            <div class="teacher-card_text">
                                                                <h5><?php echo wp_kses_post($item['title_1']); ?></h5>
                                                                <p class="main-color-font"><?php echo wp_kses_post($item['title_2']); ?></p>
                                                                <p><?php echo wp_kses_post($item['content']); ?></p>
                                                            </div>
                                                            <ul class="soc-link soc-link__bg">
                                                                <?php if (!empty($childit_facebook)) { ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($childit_facebook); ?>">
                                                                            <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'facebook.svg'); ?>' title='<?php echo esc_attr('Facebook') ?>' alt="<?php echo esc_attr('facebook'); ?>">
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($childit_twitter)) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($childit_twitter); ?>">
                                                                            <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'twitter.svg'); ?>' title='<?php echo esc_attr('Twitter') ?>' alt="<?php echo esc_attr('twitter'); ?>">
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($childit_instagram)) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url($childit_instagram); ?>">
                                                                            <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'instagram.svg'); ?>' title='<?php echo esc_attr('Instagram') ?>' alt="<?php echo esc_attr('Instagram'); ?>">
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <picture>
                                                            <source type="image/jpeg" srcset="<?php echo esc_url($item['image']['url']); ?>">
                                                            <img src="<?php echo esc_url($item['image']['url']); ?>" class="teacher-card__avatar <?php echo esc_attr($extra_class); ?> <?php echo 'elementor-repeater-item-' . $item['_id']; ?>" alt="<?php echo esc_attr('avatar'); ?>">
                                                        </picture>
                                                    </div>
                                                </div>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="centre-tab-content tab-content">
                                    <p class="tab-head"><?php echo wp_kses_post($settings['testimonial_heading']); ?></p>
                                    <div class="testimonial-wrap">
                                        <ul class="testimonial-list testimonial-slider justify-content-center" data-show-count='3' data-show-count-md='2' data-show-count-mob='1' data-slick-speed="5000" data-slick-autoplay="true">

                                            <?php
                                            $posts_per_page = $settings['number'];
                                            $order_by = $settings['order_by'];
                                            $order = $settings['order'];
                                            $pg_num = get_query_var('paged') ? get_query_var('paged') : 1;
                                            $args = array(
                                                'post_type' => array('testimonials'),
                                                'post_status' => array('publish'),
                                                'nopaging' => false,
                                                'paged' => $pg_num,
                                                'posts_per_page' => $posts_per_page,
                                                'orderby' => $order_by,
                                                'order' => $order,
                                            );
                                            $query = new \WP_Query($args);
                                            while ($query->have_posts()) {
                                                $query->the_post();
                                                $childit_testi_url = get_the_post_thumbnail_url(get_the_ID());
                                                ?>
                                                <li>
                                                    <div class="testimonial-block">
                                                        <div class="testimonial-img">
                                                            <img src="<?php echo esc_url($childit_testi_url); ?>" alt="<?php esc_attr_e('img', 'childit-core'); ?>">
                                                        </div>
                                                        <div class="testimonial-description">
                                                            <h5><?php the_title(); ?></h5>
                                                            <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time>
                                                            <?php the_content(); ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="d-flex justify-content-center pt-50 w-100">
                                        <a href="<?php echo esc_url($settings['view_more']['url']); ?>" class="read-more"><?php echo __('view more', 'childit-core'); ?> <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M0.505883 5.20577L0.491834 5.2027L6.51423 5.2027L4.62101 7.10009C4.5283 7.19272 4.47745 7.31821 4.47745 7.44992C4.47745 7.58162 4.5283 7.70623 4.62101 7.79909L4.91559 8.09382C5.00823 8.18645 5.13166 8.23767 5.2633 8.23767C5.39501 8.23767 5.51852 8.18682 5.61115 8.09418L8.85649 4.84913C8.94949 4.75613 9.00035 4.63226 8.99998 4.50048C9.00035 4.36796 8.94949 4.24401 8.85649 4.15116L5.61115 0.905818C5.51852 0.813257 5.39508 0.76233 5.2633 0.76233C5.13166 0.76233 5.00823 0.813331 4.91559 0.905818L4.62101 1.20055C4.5283 1.29304 4.47745 1.41655 4.47745 1.54826C4.47745 1.67989 4.5283 1.79689 4.62101 1.88945L6.53559 3.79745L0.499152 3.79745C0.227908 3.79745 -1.94412e-05 4.03123 -1.94175e-05 4.30233L-1.93811e-05 4.71918C-1.93574e-05 4.99028 0.23464 5.20577 0.505883 5.20577Z"/></svg></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}
