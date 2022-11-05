<?php
namespace ChildItAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 *  Main Slider
 *
 *  widget for Main Slider.
 *
 * @since 1.0.0
 */

class Main_Slider extends Widget_Base {

    public $slick_default = array('navigation' => true, 'arrow' => false);

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'main-slider'; 
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Main Slider', 'childit-core');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
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
        return ['main-slider'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
                'section_content', [
            'label' => __('Content', 'childit-core'),
                ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
                'slider_image', [
            'label' => __('Slider image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
                'slider_mask', [
            'label' => __('Show Mask', 'childit-core'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'childit-core'),
            'label_off' => __('Hide', 'childit-core'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $repeater->add_control(
                'slider_icon_image', [
            'label' => __('Slider Icon image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater->add_control(
			'content_bg',
			[
				'label' => __( 'Content Background Image', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

        $repeater->add_control(
                'title_1', [
            'label' => __('Title one', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Looking for a Centre where', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );
        $repeater->add_control(
                'title_2', [
            'label' => __('Title two', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('<span>Your Child</span><br>Will Be Safe?', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $this->add_control(
                'slider_list', [
            'label' => __('Slider List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title_1' => __('Looking for a Centre where', 'childit-core'),
                    'title_2' => __('<span>Your Child</span><br>Will Be Safe?', 'childit-core'),
                ],
                [
                    'title_1' => __('Where Fun Happens!', 'childit-core'),
                    'title_2' => __('<span>Educating</span><br>Your Children', 'childit-core'),
                ],
            ]
                ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
                'slider_options', [
            'label' => __('Slider Settings', 'childit-core'),
                ]
        );

        $this->add_control(
                'dots', [
            'label' => __('Dots', 'childit-core'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'autoplay', [
            'label' => __('Autoplay', 'childit-core'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'autoplay_speed', [
            'label' => __('Autoplay Speed', 'childit-core'),
            'type' => Controls_Manager::NUMBER,
            'default' => 4000,
            'frontend_available' => true,
                ]
        );

        $this->add_control(
                'fade', [
            'label' => __('Fading', 'childit-core'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes'
                ]
        );

        $this->add_control(
                'speed', [
            'label' => __('Speed', 'childit-core'),
            'type' => Controls_Manager::NUMBER,
            'default' => 700,
            'frontend_available' => true,
                ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
                'section_style', [
            'label' => __('Style', 'childit-core'),
            'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
            'title_1_color',
            [
                'label' => __( 'Title 1', 'childit-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-text-cursive' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_2_color',
            [
                'label' => __( 'Title 2', 'childit-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-head' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['dots'] == 'yes') {
            $dots = true;
        } else {
            $dots = false;
        }

        $autoplay_speed = $settings['autoplay_speed'];

        if ($settings['autoplay'] == 'yes') {
            $autoplay = true;
        } else {
            $autoplay = false;
        }

        if ($settings['fade'] == 'yes') {
            $fade = true;
        } else {
            $fade = false;
        }

        $speed = $settings['speed'];

        $slick_atts = array(
            'arrows' => false,
            'dots' => $dots,
            'autoplay' => $autoplay,
            'autoplay_speed' => $autoplay_speed,
            'fade' => $fade,
            'speed' => $speed
        );
        ?>
        <!-- Begin main slier -->
        <div class="main-slider-wrap white-dots">
            <div class="main-slider" data-slick='<?php echo wp_json_encode($slick_atts); ?>'>
                <?php
                if (!empty($settings['slider_list'])) {
                    foreach ($settings['slider_list'] as $item) {
                        $image_alt = get_post_meta($item['slider_image']['id'], '_wp_attachment_image_alt', TRUE);
                        $image_url = ( $item['slider_image']['id'] != '' ) ? wp_get_attachment_url($item['slider_image']['id']) : $item['slider_image']['url'];
                        $slider_icon_image = ( $item['slider_icon_image']['id'] != '' ) ? wp_get_attachment_url($item['slider_icon_image']['id']) : $item['slider_icon_image']['url'];
                        $content_bg = ( $item['content_bg']['id'] != '' ) ? wp_get_attachment_url($item['content_bg']['id']) : $item['content_bg']['url'];
                        ?>
                        <div class="sl-card">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        
                                            <div class="slide-content lazy" data-src="<?php if ($item['content_bg']['url']) { ?>
                                                    <?php echo esc_url($content_bg); 
                                                
                                            } else {
                                             echo esc_url(CHILDIT_IMG_URL . 'main-slider-rect.svg'); } ?>">
                                                <?php if ($item['slider_icon_image']['url']) { ?>
                                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url($slider_icon_image); ?>" alt="<?php esc_html_e('img', 'childit-core'); ?>">
                                                    <?php
                                                }
                                             else {
                                                ?>
                                                <div class="slide-content slider_mask_default">
                                                    <?php if ($item['slider_icon_image']['url']) { ?>
                                                        <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url($slider_icon_image); ?>" alt="<?php esc_html_e('img', 'childit-core'); ?>">
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <p class="content-text-cursive"><?php echo wp_kses_post($item['title_1']); ?></p>
                                                <p class="content-head"><?php echo wp_kses_post($item['title_2']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <picture>
                                    <source type="image/jpeg" srcset="<?php echo esc_url($image_url); ?>">
                                    <img src="<?php echo esc_url($image_url); ?>" class="slider-bg" alt="<?php echo esc_html($image_alt); ?>">
                                </picture>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- End main slier -->
            <?php
        }

    }
    