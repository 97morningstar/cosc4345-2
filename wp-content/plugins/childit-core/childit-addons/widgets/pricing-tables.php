<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Pricing_Tables extends Widget_Base {

    public function get_name() {
        return 'pricing_Tables';
    }

    public function get_title() {
        return __('Pricing Table', 'childit-core');
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
            'label' => __('Pricing Tables', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Which fee will you pay?', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Pricing & Fees', 'childit-core')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Fees are payable for 52 weeks, fees will not be refunded for any periods of sickness, holidays or days absent from the preschool.', 'childit-core'),
                ]
        );

        $this->add_control(
                'note_text', [
            'label' => __('Note Text', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('* The preschool reserves the right to increase the said fees at any time.', 'childit-core'),
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'table_content', [
            'label' => __('Table', 'childit-core'),
            'type' => Controls_Manager::WYSIWYG,
                ]
        );

        $this->add_control(
                'item_list', [
            'label' => __('Table List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'table_content' => ''
                ],
                [
                    'table_content' => ''
                ],
                [
                    'table_content' => ''
                ]
            ]
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'term_condition', [
            'label' => __('Terms & Conditions', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_con', [
            'label' => __('Condition Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Fee Terms & Conditions', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_list', [
            'label' => __('Condition List', 'childit-core'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => ''
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_form', [
        'label' => __('Form Section', 'childit-core'),
            ]
    );

    $this->add_control(
            'title', [
        'label' => __('Title', 'childit-core'),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
        'default' => __('Want to Leave Your Review?', 'childit-core'),
            ]
    );

    $this->add_control(
            'testi_cf7', [
        'label' => __('CF7 Shortcode', 'childit-core'),
        'type' => Controls_Manager::TEXTAREA
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
            'name'     => 'bottom_title_typography',
            'label'    => __( 'Bottom Title Typography', 'childit-core' ),
            'selector' => '{{WRAPPER}} .terms-list h3',
        )
    );
    
    $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="pricing-tables pt-xs-30 pt-md-60 mb-xs-70 mb-md-70 mb-lg-120">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
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
                        <?php
                        if (!empty($settings['item_list'])) {
                            foreach ($settings['item_list'] as $item) {
                                ?>
                                <div class="table-wrap">
                                    <table class="adaptive pricing-table mb-xs-25 mb-md-50">
                                        <?php
                                        echo $item['table_content'];
                                        ?>
                                    </table>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <p class="mb-0">
                            <?php
                            echo wp_kses_post($settings['note_text']);
                            ?>
                        </p>
                        <div class="terms-list mt-xs-40 mt-md-60 mt-lg-90">
                            <h3 class="text-center"> <?php
                                echo wp_kses_post($settings['title_con']);
                                ?></h3>
                            <ul class="flex-style">
                                <?php
                                echo wp_kses_post($settings['title_list']);
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
