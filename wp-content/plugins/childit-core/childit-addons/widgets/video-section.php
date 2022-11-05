<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Video_Section extends Widget_Base {

    public function get_name() {
        return 'video_section';
    }

    public function get_title() {
        return esc_html__('Video Section', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'bg_image_section', [
            'label' => __('BG Image', 'childit-core'),
                ]
        );

        $this->add_control(
                'bg_image', [
            'label' => __('BG Image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => [
                'active' => true,
            ],
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_section', [
            'label' => esc_html__('Content', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => esc_html__('Title 1', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('We Create a Nurturing Environment <span class="main-color-font dib">for Each Child</span>', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => esc_html__('Title 2', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Thought open ended play based experiences children flourish, and grow to love their school, taking pride in belonging to a community', 'childit-core'),
                ]
        );

        $this->add_control(
                'content', [
            'label' => esc_html__('Content', 'childit-core'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => __('We provide a warm and encouraging atmosphere that enhances self-concept, instills basic moral values, encourages social interaction, and enriches awareness of the natural and cultural world. We’re a warm and loving community of preschoolers, teachers, and parents who inspire imagination, creativity, and play for every learner.', 'childit-core'),
                ]
        );

       $this->add_control(
            'show_button',
            [
                'label' => __( 'Show Button', 'plugin-domain' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'your-plugin' ),
                'label_off' => __( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
                'button_text', [
            'label' => esc_html__('Button Text', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('read more', 'childit-core')
                ]
        );

        $this->add_control(
                'action_link', [
            'label' => esc_html__('Action Button', 'childit-core'),
            'type' => Controls_Manager::URL,
            'default' => [
                'url' => 'https://www.youtube.com/watch?v=NkfKechADow',
                'is_external' => '',
            ],
            'show_external' => true,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'image_section', [
            'label' => esc_html__('Image', 'childit-core'),
                ]
        );

        $this->add_control(
                'image', [
            'label' => esc_html__('Image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => [
                'active' => true,
            ],
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->add_control(
                'size', [
            'label' => esc_html__('Select Size', 'childit-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'full',
            'options' => [
                'full' => esc_html__('Full', 'childit-core'),
                'custom' => esc_html__('Custom', 'childit-core')
            ],
                ]
        );

        $this->add_control(
                'width', [
            'label' => esc_html__('Width', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'condition' => [
                'size' => 'custom',
            ],
                ]
        );

        $this->add_control(
                'height', [
            'label' => esc_html__('Height', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'condition' => [
                'size' => 'custom',
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
				'selector' => '{{WRAPPER}} .video-section .show-scroll h2',
			)
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .video-section .show-scroll p',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $attachment_size = array();
        $has_custom_size = FALSE;
        if (!empty($settings['width']) && !empty($settings['height'])) {
            $has_custom_size = true;
            $attachment_size[0] = (int) $settings['width'];
            $attachment_size[1] = (int) $settings['height'];
        }

        if (!$has_custom_size) {
            $attachment_size = 'full';
        }

        $url = '#';
        $target = '';
        if (!empty($settings['action_link'])) {
            $link = $settings['action_link'];
            $url = $link['url'];
            $target = $link['is_external'] ? 'target="_blank"' : '';
        }

        if (is_array($attachment_size)) {
            $instance = ['image_size' => 'custom', 'image_custom_dimension' => ['width' => (int) $settings['width'], 'height' => (int) $settings['height']]];
            $image_url = Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'image', $instance);
        } else {
            if (!empty($settings['image']['id'])) {
                $image_src = wp_get_attachment_image_src($settings['image']['id'], $attachment_size);
                $image_url = $image_src[0];
                $image_alt = get_post_meta($settings['image']['id'], '_wp_attachment_image_alt', TRUE);
            } else {
                $image_url = $settings['image']['url'];
                $image_alt = get_post_meta($settings['image']['id'], '_wp_attachment_image_alt', TRUE);
            }
        }

        $bg_image_url = isset($settings['bg_image']['id']) ? wp_get_attachment_url($settings['bg_image']['id']) :'';
        if( ! $bg_image_url){
            $bg_image_url = $settings['bg_image']['url'];
        }
        ?>
        <section class="video-section mb-xs-50 mb-md-75 mb-lg-120 lazy" data-src="<?php echo esc_url($bg_image_url); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8 col-lg-6 on-scroll fade-up">
                        <h2 class="mb-xs-25 mb-md-25"><?php echo wp_kses_post($settings['title_1']); ?></h2>
                        <p class="mb-xs-20 mb-md-37"><?php echo wp_kses_post($settings['title_2']); ?></p>
                        <?php
                        if ($settings['show_button']) { ?>
                            <a href="<?php echo esc_url($url); ?>" class="video-btn" data-toggle="lightbox">
                            <span class="play-ico animate">
                                <span>
                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'play.png'); ?>' alt="<?php echo esc_attr($image_alt); ?>">
                                </span>
                            </span> <?php echo esc_html($settings['button_text']); ?>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
