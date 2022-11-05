<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Pricing_Packages extends Widget_Base {

    public function get_name() {
        return 'pricing_packages';
    }

    public function get_title() {
        return __('Pricing Packages', 'childit-core');
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
        return ['pricing-packages'];
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
            'default' => __('Choose your plan', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core')
                ]
        );
        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Pricing Packages', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('The pricing plans listed below fully reflect the variety of our learning programs and all included activities. If you would like to find out more about any of these plans, contact our managers.', 'childit-core'),
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
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );
        $repeater->add_control(
                'price', [
            'label' => __('Price', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('<span class="currency">$</span><span class="price">990</span> /month', 'childit-core')
                ]
        );

        $repeater->add_control(
                'include', [
            'label' => __('Include', 'childit-core'),
            'type' => Controls_Manager::WYSIWYG,
                ]
        );

        $repeater->add_control(
                'button_text', [
            'label' => __('Button Text', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => __('order now', 'childit-core'),
                ]
        );

        $repeater->add_control(
                'button_url', [
            'label' => __('Button URL', 'childit-core'),
            'type' => Controls_Manager::URL,
            'default' => [
                'url' => '#',
                'is_external' => '',
            ],
            'show_external' => true,
                ]
        );

        $this->add_control(
                'item_list', [
            'label' => __('Item List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title_1' => __('Start Plan', 'childit-core')
                ],
                [
                    'title_1' => __('Standard', 'childit-core')
                ],
                [
                    'title_1' => __('Premium', 'childit-core')
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
				'selector' => '{{WRAPPER}} .pricing-packages-description h3',
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
        <!-- Begin pricing-packages -->
        <section class="wave-block bg-cover mb-xs-20 mb-md-0 mb-lg-120 lazy" data-src="<?php echo esc_url($bg_image_url); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header mb-xs-30 mb-md-31">
                            <p class="h-sub"><?php echo wp_kses_post($settings['title_1']);?></p>
                            <h2><?php echo wp_kses_post($settings['title_2']);?></h2>
                            <p><?php echo wp_kses_post($settings['content']);?></p>
                        </div>
                        <div class="pricing-packages-slider" data-show-count='3' data-show-count-md='2' data-show-count-mob='1' data-slick-speed="5000" data-slick-autoplay="true">
                            <?php
                            if (!empty($settings['item_list'])) {
                                $button_color = '';
                                $i=0;
                                foreach ($settings['item_list'] as $key => $item) {
                                    if ($key == 1) {
                                        $button_color = 'color-2';
                                    } elseif ($key == 2) {
                                        $button_color = 'color-3';
                                    }
                                    $url = '#';
                                    $target = '';
                                    if (!empty($item['button_url'])) {
                                        $link = $item['button_url'];
                                        $url = $link['url'];
                                        $target = $link['is_external'] ? 'target="_blank"' : '';
                                    }
                                    $image_url = ( $item['image']['id'] != '' ) ? wp_get_attachment_url($item['image']['id']) : $item['image']['url'];
                                    ?>
                                    <div class="pricing-packages-slide">
                                        <div class="pricing-packages-card">
                                            <div class="pricing-packages-img">
                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr_e('Img', 'childit'); ?>">
                                            </div>
                                            <div class="pricing-packages-description">
                                                <h3>
                                                    <?php
                                                    echo wp_kses_post($item['title_1']);
                                                    ?>
                                                </h3>
                                                <p class="pricing-packages-price"> <?php
                                                    echo wp_kses_post($item['price']);
                                                    ?>
                                                </p>
                                                <div class="pricing-packages-include">
                                                    <?php
                                                    echo wp_kses_post($item['include']);
                                                    ?>
                                                </div>
                                                <a href="<?php echo esc_url($url); ?>" <?php echo esc_url($target); ?> class="button read-more <?php echo esc_attr($button_color); ?>">
                                                    <?php echo wp_kses_post($item['button_text']); ?><svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M0.505883 5.20577L0.491834 5.2027L6.51423 5.2027L4.62101 7.10009C4.5283 7.19272 4.47745 7.31821 4.47745 7.44992C4.47745 7.58162 4.5283 7.70623 4.62101 7.79909L4.91559 8.09382C5.00823 8.18645 5.13166 8.23767 5.2633 8.23767C5.39501 8.23767 5.51852 8.18682 5.61115 8.09418L8.85649 4.84913C8.94949 4.75613 9.00035 4.63226 8.99998 4.50048C9.00035 4.36796 8.94949 4.24401 8.85649 4.15116L5.61115 0.905818C5.51852 0.813257 5.39508 0.76233 5.2633 0.76233C5.13166 0.76233 5.00823 0.813331 4.91559 0.905818L4.62101 1.20055C4.5283 1.29304 4.47745 1.41655 4.47745 1.54826C4.47745 1.67989 4.5283 1.79689 4.62101 1.88945L6.53559 3.79745L0.499152 3.79745C0.227908 3.79745 -1.94412e-05 4.03123 -1.94175e-05 4.30233L-1.93811e-05 4.71918C-1.93574e-05 4.99028 0.23464 5.20577 0.505883 5.20577Z"/></svg></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End pricing-packages -->
        <?php
    }

}
