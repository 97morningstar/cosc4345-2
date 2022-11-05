<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Faq extends Widget_Base {

    public function get_name() {
        return 'faq';
    }

    public function get_title() {
        return __('Faq', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'title_content_section', [
            'label' => __('Title', 'childit-core'),
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

        $this->end_controls_section();

        $this->start_controls_section(
                'content_section', [
            'label' => __('FAQ List', 'childit-core'),
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'title_1', [
            'label' => __('Question', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );
        $repeater->add_control(
                'title_2', [
            'label' => __('Answere', 'childit-core'),
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
                    'title_1' => __('What are the Qualifications of Teachers?', 'childit-core'),
                    'title_2' => __('All of our head teachers have a Masters in Early Childhood Education and are certified in Early Childhood Education. Head teachers in the infant / toddler rooms may have a degree in Early Childhood Education or in a different field such as Elementary Educaiton, Psychology, English, Theater).', 'childit-core'),
                ],
                [
                    'title_1' => __('How can I get involved in my classroom?', 'childit-core'),
                    'title_2' => __('Wait a bit before volunteering at lunch or recess to let your child adjust. Once the school year is underway, there are plenty of opportunities to get involved, from helping students at events and going on class field trips. Several kindergarten family events are scheduled on evenings throughout the year.', 'childit-core'),
                ]
            ]
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
            'default' => __('Do You Have Any Question?', 'childit-core')
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
				'selector' => '{{WRAPPER}} .accordion-block .accordion-header p',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_title_typography',
				'label'    => __( 'Form Title Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .form-title-feq',
			)
		);
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="faq-section pt-xs-40 pt-md-60 pb-xs-50 pb-md-70 pb-lg-120">
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="accordion-wrap" data-accordion-colection>
                                    <?php
                                    if (!empty($settings['item_list'])) {
                                        $i = 1;
                                        foreach ($settings['item_list'] as $key => $item) {
                                            $isActive = '';
                                            if ($key == 0) {
                                                $isActive = 'active';
                                            }
                                            $counter = '';
                                            if ($i % 2 != 0) {
                                                if ($i > 8) {
                                                    $counter = 'faq-to-hide';
                                                }
                                                ?>
                                                <div class="accordion-block <?php echo esc_attr($isActive); ?><?php echo esc_attr($counter); ?>">
                                                    <div class="accordion-header">
                                                        <p><?php echo wp_kses_post($item['title_1']); ?></p>
                                                        <span class="accordion-ico"></span>
                                                    </div>
                                                    <div class="accordion-content">
                                                        <p><?php echo wp_kses_post($item['title_2']); ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $i++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="accordion-wrap" data-accordion-colection>
                                    <?php
                                    if (!empty($settings['item_list'])) {
                                        $y = 1;
                                        foreach ($settings['item_list'] as $key => $item) {
                                            $isActive = '';
                                            if ($key == 1) {
                                                $isActive = 'active';
                                            }
                                            $counter = '';
                                            if ($y % 2 == 0) {
                                                if ($y > 8) {
                                                    $counter = 'faq-to-hide';
                                                }
                                                ?>
                                                <div class="accordion-block <?php echo esc_attr($isActive); ?><?php echo esc_attr($counter); ?>">
                                                    <div class="accordion-header">
                                                        <p><?php echo wp_kses_post($item['title_1']); ?></p>
                                                        <span class="accordion-ico"></span>
                                                    </div>
                                                    <div class="accordion-content">
                                                        <p><?php echo wp_kses_post($item['title_2']); ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $y++;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mb-lg-90 mb-xs-50">
                            <a href="#" class="read-more pt-xs-0 pt-md-20" data-view-more=".faq-to-hide"><?php echo __('view more', 'childit-core'); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M0.505883 5.20577L0.491834 5.2027L6.51423 5.2027L4.62101 7.10009C4.5283 7.19272 4.47745 7.31821 4.47745 7.44992C4.47745 7.58162 4.5283 7.70623 4.62101 7.79909L4.91559 8.09382C5.00823 8.18645 5.13166 8.23767 5.2633 8.23767C5.39501 8.23767 5.51852 8.18682 5.61115 8.09418L8.85649 4.84913C8.94949 4.75613 9.00035 4.63226 8.99998 4.50048C9.00035 4.36796 8.94949 4.24401 8.85649 4.15116L5.61115 0.905818C5.51852 0.813257 5.39508 0.76233 5.2633 0.76233C5.13166 0.76233 5.00823 0.813331 4.91559 0.905818L4.62101 1.20055C4.5283 1.29304 4.47745 1.41655 4.47745 1.54826C4.47745 1.67989 4.5283 1.79689 4.62101 1.88945L6.53559 3.79745L0.499152 3.79745C0.227908 3.79745 -1.94412e-05 4.03123 -1.94175e-05 4.30233L-1.93811e-05 4.71918C-1.93574e-05 4.99028 0.23464 5.20577 0.505883 5.20577Z"></path></svg>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                                <!-- Begin main-form -->
                                <h3 class="text-center form-title-feq"><?php
                                    echo wp_kses_post($settings['title']);
                                    ?>
                                </h3>
                                <?php echo do_shortcode(shortcode_unautop($settings['testi_cf7'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}
