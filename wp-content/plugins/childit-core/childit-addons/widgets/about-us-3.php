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

class About_Us_Three extends Widget_Base {

    public function get_name() {
        return 'about_us_three';
    }

    public function get_title() {
        return __('About 3', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'content_section', [
            'label' => __('Content', 'childit-core'),
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
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Professional and graduated', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Our Staff are Guided by the <span>Principles of</span>', 'childit-core'),
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => '<p class="mb-xs-15 mb-lg-8">Above and beyond our already stringent code of ethics and guidelines for continuing education, our professional staff are guided by the principles and ethical codes of the following clinical and educational organizations:</p>'
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
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_url = ( $settings['image']['id'] != '' ) ? wp_get_attachment_url($settings['image']['id']) : $settings['image']['url'];
        $image_alt = get_post_meta($settings['image']['id'], '_wp_attachment_image_alt', TRUE);
        ?>
        <!-- Begin text-block -->
        <section class="text-block text-block-reverce pb-xs-50 pb-sm-60 pb-md-60 pb-lg-120 pt-0">
            <div class="container">
                <div class="row align-items-sm-center align-items-lg-start">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="svg-block video-block">
                            <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="video-prev lazy" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}
