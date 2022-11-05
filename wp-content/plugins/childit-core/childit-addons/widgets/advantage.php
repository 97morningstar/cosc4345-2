<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Advantage extends Widget_Base {

    public function get_name() {
        return 'advantage';
    }

    public function get_title() {
        return __('Advantage', 'childit-core');
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
            'label' => __('Section', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Read on to understand our differene', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core')
                ]
        );
        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Why Choose ChildiT', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core')
                ]
        );

        $repeater = new \Elementor\Repeater();

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
                    'title_1' => __('Home-like Environment', 'childit-core'),
                    'title_2' => __('Children are comfortable and confident in their home, feeling safe and secure to explore and learn.', 'childit-core'),
                ],
                [
                    'title_1' => __('Loving Language', 'childit-core'),
                    'title_2' => __('90% success rate of children reading before they go to school for children attending more than 12 months.', 'childit-core'),
                ],
                [
                    'title_1' => __('30 Day Moneyback Guarantee', 'childit-core'),
                    'title_2' => 'If you’re not completely satisfied we will refund your money, no questions asked.'
                ],
                [
                    'title_1' => __('Culture of Honour', 'childit-core'),
                    'title_2' => __('We aim to help all people that come into contact with ChildiT to feel Significant, Appreciated and Understood.', 'childit-core'),
                ],
                [
                    'title_1' => __('Orientation Process', 'childit-core'),
                    'title_2' => __('Makes the process of you and your child settling into care with ChildiT that much smoother.', 'childit-core'),
                ],
                [
                    'title_1' => __('Quality Educators', 'childit-core'),
                    'title_2' => __('Trusted, highly trained and hand-picked Educators. We believe that educators play a huge role in quality child care.', 'childit-core'),
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
				'name'     => 'item_title_typography',
				'label'    => __( 'Item Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .advantage-list li h5',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_content_typography',
				'label'    => __( 'Item Content Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .advantage-list li p',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <!-- Begin advantage listing -->
        <section class="mb-xs-60 mb-sm-70 mb-md-90 mb-lg-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header on-scroll">
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
                        <ol class="advantage-list pt-xs-0 pt-md-0 pt-lg-20">
                            <?php
                            if (!empty($settings['item_list'])) {
                                foreach ($settings['item_list'] as $item) {
                                    ?>
                                    <li class="on-scroll fade-up">
                                        <div class="advantage-block">
                                            <h5><?php echo wp_kses_post($item['title_1']); ?></h5>
                                            <p><?php echo wp_kses_post($item['title_2']); ?></p>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- End advantage listing -->
        <?php
    }

}
