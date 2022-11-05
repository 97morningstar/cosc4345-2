<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Guidance extends Widget_Base {

    public function get_name() {
        return 'guidance';
    }

    public function get_title() {
        return esc_html__('Guidance', 'childit-core');
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
            'label' => esc_html__('Content', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => esc_html__('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Understanding children’s behavior', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => esc_html__('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Behavior Guidance', 'childit-core')
                ]
        );

        $this->add_control(
                'paragraph', [
            'label' => esc_html__('Paragraph', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Positive and consistent techniques should be used to encourage children whose play actions are both appropriate and inappropriate.', 'childit-core'),
                ]
        );

        $this->add_control(
                'content', [
            'label' => esc_html__('Content Left', 'childit-core'),
            'type' => Controls_Manager::WYSIWYG
                ]
        );

        $this->add_control(
                'content_1', [
            'label' => esc_html__('Content Right', 'childit-core'),
            'type' => Controls_Manager::WYSIWYG
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
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .section-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub Title Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .section-header .h-sub',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_title_typography',
				'label'    => __( 'Item Title Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .practices-list-wrap h4',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <!-- Begin guidance -->
        <section class="guidance-section pb-md-0 pb-lg-60">
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
                                echo wp_kses_post($settings['paragraph']);
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="practices-list-wrap mb-60">
                            <div class="practices-ico preferred">
                                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'check.svg'); ?>" alt="<?php esc_attr_e('img', 'childit-core'); ?>">
                            </div>
                            <?php
                            echo wp_kses_post($settings['content']);
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="practices-list-wrap mb-60">
                            <div class="practices-ico prohibited">
                                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'close.svg'); ?>" alt="<?php esc_attr_e('img', 'childit-core'); ?>">
                            </div>
                            <?php
                            echo wp_kses_post($settings['content_1']);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End guidance -->
        <?php
    }

}
