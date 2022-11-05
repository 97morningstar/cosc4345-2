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

class About_Section extends Widget_Base {

    public function get_name() {
        return 'about_section';
    }

    public function get_title() {
        return __('About 2', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {


        $this->start_controls_section(
                'image_content_section', [
            'label' => __('Image', 'childit-core'),
                ]
        );

        $this->add_control(
                'image', [
            'label' => __('Image', 'childit-core'),
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
            'label' => __('Select Size', 'childit-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'full',
            'options' => [
                'full' => __('Full', 'childit-core'),
                'custom' => __('Custom', 'childit-core')
            ],
                ]
        );

        $this->add_control(
                'width', [
            'label' => __('Width', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'condition' => [
                'size' => 'custom',
            ],
                ]
        );

        $this->add_control(
                'height', [
            'label' => __('Height', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'condition' => [
                'size' => 'custom',
            ],
                ]
        );

        $this->add_control(
                'show_button', [
            'label' => __('Show Vedio Button', 'childit-core'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'childit-core'),
            'label_off' => __('Hide', 'childit-core'),
            'return_value' => 'yes',
            'default' => 'yes',
                ]
        );

        $this->add_control(
                'action_link', [
            'label' => __('Action Button', 'childit-core'),
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
                'content_section', [
            'label' => __('Content', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Igniting the spark of genius in every child', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('We Work to Understand Your <span>Kids Needs</span>', 'childit-core')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => __('We provide a warm and encouraging atmosphere that enhances self-concept, instills basic moral values, encourages social interaction, and enriches awareness of the natural and cultural world. We’re a warm and loving community of preschoolers, teachers, and parents who inspire imagination, creativity, and play for every learner.', 'childit-core')
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
				'selector' => '{{WRAPPER}} .block-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .block-header p',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .about-content-text > p',
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
        ?>
        <!-- Begin text-block -->

        <section class="text-block pb-xs-50 pb-sm-65 pb-md-90 pb-lg-120 pt-xs-30 pt-md-60">
            <div class="container">
                <div class="row align-items-sm-center align-items-lg-start">
                    <div class="col-lg-12 col-xl-6 about-content-text">
                        <div class="block-header pt-0">
                            <p class="mb-xs-15 mb-lg-8"> 
                                <?php
                                echo wp_kses_post($settings['title_1']);
                                ?>
                            </p>
                            <h2 class="mb-xs-25 mb-md-25"> 
                                <?php
                                echo wp_kses_post($settings['title_2']);
                                ?>
                            </h2>
                        </div>
                        <?php
                        echo wp_kses_post($settings['content']);
                        ?>
                    </div>
                    <div class="col-lg-12 col-xl-6">
                        <div class="svg-block video-block">
                        <?php if ($settings['show_button'] == 'yes') { ?>
                                <a href="<?php echo esc_url($url); ?>" data-toggle="lightbox">
                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="video-prev lazy" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    <p class="video-btn">
                                        <span class="play-ico animate x2"><span>
                                                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src='<?php echo esc_url(CHILDIT_IMG_URL . 'play.png'); ?>' alt="<?php echo esc_attr($image_alt); ?>">
                                            </span>
                                        </span>
                                    </p>
                                </a>
                            <?php } else { ?>
                                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="video-prev lazy" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Begin text-block -->
        <?php
    }

}
