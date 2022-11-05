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

class Vision_Mission extends Widget_Base {

    public function get_name() {
        return 'vision-mission';
    }

    public function get_title() {
        return __('Vision & Mission', 'childit-core');
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
        return ['vision-mission'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'bg_content_section', [
            'label' => __('BG Image', 'childit-core'),
                ]
        );

        $this->add_control(
                'bg_image', [
            'label' => __('Image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
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
            'default' => __('What is special about centre', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core')
                ]
        );
        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Vision & Mission Statements', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core')
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
            'label' => __('Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );
        $repeater->add_control(
                'title_2', [
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
                    'title_1' => __('Our Mission', 'childit-core'),
                    'title_2' => __('We believe in the ability to improve the quality of life of the individuals and families across the city.', 'childit-core'),
                ],
                [
                    'title_1' => __('Our Vision', 'childit-core'),
                    'title_2' => __('Our vision for Early Years is based upon the premise that every child receives the very best education.', 'childit-core'),
                ],
                [
                    'title_1' => __('Philosophy', 'childit-core'),
                    'title_2' => __('We believe that a teacher-guided, balanced approach establishes an excellent educational foundation.', 'childit-core'),
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
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .section-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .section-header .h-sub',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_title_typography',
				'label'    => __( 'Item Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .statement-card h4',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_content_typography',
				'label'    => __( 'Item Content Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .statement-card p',
			)
        );
        
		$this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $bg_image_url = isset($settings['bg_image']['id']) ? wp_get_attachment_url($settings['bg_image']['id']) :'';
        if( ! $bg_image_url){
            $bg_image_url = $settings['bg_image']['url'];
        }
        ?>
        <!-- Begin statements -->
        <section class="wave-block pt-xs-110 pt-md-120 pt-lg-150 mb-xs-50 mb-sm-50 mb-md-70 mb-lg-120 lazy" data-src="<?php echo esc_url($bg_image_url); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header">
                            <p class="h-sub"><?php
                                echo wp_kses_post($settings['title_1']);
                                ?></p>
                            <h2><?php
                                echo wp_kses_post($settings['title_2']);
                                ?></h2>
                        </div>
                        <ul class="statement-list statement-slider" data-show-count='3' data-show-count-md='2' data-show-count-mob='1' data-slick-speed="5000" data-slick-autoplay="true">
                            <?php
                            if (!empty($settings['item_list'])) {
                                foreach ($settings['item_list'] as $item) {
                                    $image_alt = get_post_meta($item['image']['id'], '_wp_attachment_image_alt', TRUE);
                                    $image_url = ( $item['image']['id'] != '' ) ? wp_get_attachment_url($item['image']['id']) : $item['image']['url'];
                                    ?>
                                    <li>
                                        <div class="statement-card">
                                            <div class="statement-ico">
                                                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                            </div>
                                            <h4><?php echo wp_kses_post($item['title_1']); ?></h4>
                                            <p><?php echo wp_kses_post($item['title_2']); ?></p>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- End statements -->
        <?php
    }

}
