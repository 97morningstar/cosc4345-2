<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Advantage2 extends Widget_Base {

    public function get_name() {
        return 'advantage2';
    }

    public function get_title() {
        return __('Advantage 2', 'childit-core');
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
            'default' => __('Prepare your child for school readiness', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Feel The Difference', 'childit-core')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('What gives our schools the quality you feel the moment you enter are the “pillars” of belief that support them. There are six core beliefs on which everything centers at our schools.', 'childit-core'),
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
                    'title_1' => __('Experiential Learning', 'childit-core'),
                    'title_2' => __('We help children connect with their surroundings in new ways, so they discover what is meaningful to them in the moment and in the future.', 'childit-core'),
                ],
                [
                    'title_1' => __('Community', 'childit-core'),
                    'title_2' => __('A child’s educational success in large part depends on families, educators, peers and relevant members of the community.', 'childit-core'),
                ],
                [
                    'title_1' => __('Collaboration', 'childit-core'),
                    'title_2' => __('Sharing new experiences and solving problems with others leads to a greater sense of connectedness – as well as meaningful learning experiences.', 'childit-core'),
                ],
                [
                    'title_1' => __('Proven Models', 'childit-core'),
                    'title_2' => __('Several important learning models have been developed by educators around the world. The human connection must be a key component of learning.', 'childit-core'),
                ],
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
				'selector' => '{{WRAPPER}} .advantage-list.advantage-second li .advantage-block h5',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <!-- Begin advantage-list second -->
        <section class="mb-xs-60 mb-sm-70 mb-md-90 mb-lg-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-header">
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
                        <ol class="advantage-list advantage-second">

                            <?php
                            if (!empty($settings['item_list'])) {
                                foreach ($settings['item_list'] as $item) {
                                    ?>
                                    <li>
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
        <!-- End advantage-list second -->
        <?php
    }

}
