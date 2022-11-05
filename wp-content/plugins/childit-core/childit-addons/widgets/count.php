<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Count extends Widget_Base {

    public function get_name() {
        return 'count';
    }

    public function get_title() {
        return esc_html__('Count', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'bg_content_section', [
            'label' => esc_html__('BG Image', 'childit-core'),
                ]
        );

        $this->add_control(
                'bg_image', [
            'label' => esc_html__('Image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'content_section', [
            'label' => esc_html__('Content', 'childit-core'),
                ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'count_number', [
            'label' => esc_html__('Count Number', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT
                ]
        );
        $repeater->add_control(
                'count_text', [
            'label' => esc_html__('Count Text', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT
                ]
        );

        $this->add_control(
                'item_list', [
            'label' => esc_html__('Item List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'count_number' => '15',
                    'count_text' => __('Years of experience', 'childit-core'),
                ],
                [
                    'count_number' => '142',
                    'count_text' => __('Students Enrolled', 'childit-core'),
                ],
                [
                    'count_number' => '24',
                    'count_text' => __('Qualified Teachers', 'childit-core'),
                ],
                [
                    'count_number' => '12',
                    'count_text' => __('Total Groups', 'childit-core'),
                ]
            ]
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
				'name'     => 'counter_number_typography',
				'label'    => __( 'Counter Number Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .count-block .count-numb p',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'counter_number_text_typography',
				'label'    => __( 'Counter Number Text Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .count-block .count-text p',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_url = isset($settings['bg_image']['id']) ? wp_get_attachment_url($settings['bg_image']['id']) :'';
        if( ! $image_url){
            $image_url = $settings['bg_image']['url'];
        }
        ?>
        <!-- Begin count section -->
        <div class="count-section wave-block bg-cover mb-xs-50 mb-sm-55 mb-md-70 mb-lg-120 lazy" data-src="<?php echo esc_url($image_url); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="count-list">
                            <?php
                            if (!empty($settings['item_list'])) {
                                foreach ($settings['item_list'] as $item) {
                                    ?>
                                    <div class="count-block-wrap">
                                        <div class="count-block">
                                            <div class="count-numb">
                                                <p class="numb" data-number="<?php echo esc_attr($item['count_number']); ?>"><?php echo wp_kses_post($item['count_number']); ?></p>
                                                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url(CHILDIT_IMG_URL . 'cloud-small.svg'); ?>" alt="<?php echo esc_attr('img'); ?>">
                                            </div>
                                            <div class="count-text">
                                                <p><?php echo wp_kses_post($item['count_text']); ?></p>
                                            </div>
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
        <?php
    }

}
