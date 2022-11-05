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


class About_Us_Price extends Widget_Base {

    public function get_name() {
        return 'about_us_price';
    }

    public function get_title() {
        return __('About Price', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {


        $this->start_controls_section(
                'image_section', [
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
            'default' => __('Membership loyalty program', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('How to get Membership <span>Discounts</span>', 'childit-core'),
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => '<p class="mb-xs-15 mb-lg-8">A 2% reduction of the annual tuition is available for full payment of tuition by CHECK or CASH if paid by June 1, 2019. A 5% reduction of the annual tuition is available when enrolling a third child (or more) of the same parents.</p>
                            <p class="mb-xs-20 mb-md-37">Membership is a direct discount card and no loyalty points are give for any purchases. Membership is renewed every year with its expiry date fixed at 31st December of each corresponding year.</p>'
                ]
        );

        $this->add_control(
                'button_text', [
            'label' => __('Button Text', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => __('read more', 'childit-core'),
                ]
        );

        $this->add_control(
                'action_link', [
            'label' => __('Action Button', 'childit-core'),
            'type' => Controls_Manager::URL,
            'default' => [
                'url' => '#',
                'is_external' => '',
            ],
            'show_external' => true,
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
            } else {
                $image_url = $settings['image']['url'];
            }
        }
        ?>
        <!-- Begin text-block -->
        <section class="text-block pb-xs-50 pb-md-60 pb-lg-120">
            <div class="container">
                <div class="row align-items-sm-center align-items-lg-start">
                    <div class="col-md-6">
                        <div class="svg-block image-left">
                            <svg viewBox="0 0 526 502" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <mask id="img-price" maskUnits="userSpaceOnUse" x="0" y="0" width="526" height="502">
                                    <path  d="M50.2671 492.802C125.214 523.202 276.545 461.468 342.841 426.802C288.234 468.802 322.802 482.802 346.849 480.802C370.896 478.802 432.517 456.802 467.586 433.302C495.641 414.502 491.299 401.468 485.622 397.302C489.463 392.968 499.85 379.802 510.671 361.802C524.197 339.302 532.714 317.802 517.184 291.302C504.759 270.102 446.879 269.468 420.995 271.802C419.659 271.802 422.398 267.402 444.04 249.802C471.093 227.802 495.641 201.802 493.637 170.802C492.034 146.002 436.859 137.468 409.472 136.302C410.474 132.802 409.773 124.402 398.952 118.802C388.13 113.202 355.7 113.802 340.837 114.802C364.05 102.302 410.274 72.4016 409.472 52.8016C408.47 28.3016 386.427 9.3016 343.843 13.3016C301.26 17.3016 237.635 56.8016 249.658 48.8016C261.682 40.8016 279.717 19.8016 271.201 9.30161C262.684 -1.19839 235.631 -3.19838 216.093 5.30162C196.554 13.8016 80.8271 60.8016 66.7995 103.802C52.772 146.802 82.831 134.302 80.8271 141.802C78.8231 149.302 52.271 154.802 24.7169 208.302C2.67369 251.102 33.7347 274.802 57.2809 276.802C54.108 276.802 39.5461 283.502 22.713 310.302C5.87998 337.102 25.0509 358.802 36.7406 366.302C34.7366 368.135 29.827 372.702 26.2199 376.302C21.711 380.802 -43.4168 454.802 50.2671 492.802Z" fill="#C4C4C4"/>
                                </mask>
                                <g mask="url(#img-price)">
                                    <rect y="-13" width="750" height="523" fill="url(#pattern-prices)"/>
                                </g>
                                <defs>
                                    <pattern id="pattern-prices" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#for-img-price" transform="scale(0.00133333 0.00191205)"/>
                                    </pattern>
                                    <image id="for-img-price" width="750" height="523" xlink:href="<?php echo esc_url($image_url); ?>">
                                    </image>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="block-header pt-xs-30 pt-lg-50">
                            <p class="mb-xs-15 mb-lg-8"> <?php
                                echo wp_kses_post($settings['title_1']);
                                ?></p>
                            <h2 class="mb-xs-25 mb-md-25">
                                <?php
                                echo wp_kses_post($settings['title_2']);
                                ?>
                            </h2>
                        </div>
                        <?php
                        echo wp_kses_post($settings['content']);
                        ?>
                        <a href="<?php echo esc_url($url); ?>" <?php echo $target; ?> class="read-more"><?php echo esc_html($settings['button_text']); ?> <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M0.505883 5.20577L0.491834 5.2027L6.51423 5.2027L4.62101 7.10009C4.5283 7.19272 4.47745 7.31821 4.47745 7.44992C4.47745 7.58162 4.5283 7.70623 4.62101 7.79909L4.91559 8.09382C5.00823 8.18645 5.13166 8.23767 5.2633 8.23767C5.39501 8.23767 5.51852 8.18682 5.61115 8.09418L8.85649 4.84913C8.94949 4.75613 9.00035 4.63226 8.99998 4.50048C9.00035 4.36796 8.94949 4.24401 8.85649 4.15116L5.61115 0.905818C5.51852 0.813257 5.39508 0.76233 5.2633 0.76233C5.13166 0.76233 5.00823 0.813331 4.91559 0.905818L4.62101 1.20055C4.5283 1.29304 4.47745 1.41655 4.47745 1.54826C4.47745 1.67989 4.5283 1.79689 4.62101 1.88945L6.53559 3.79745L0.499152 3.79745C0.227908 3.79745 -1.94412e-05 4.03123 -1.94175e-05 4.30233L-1.93811e-05 4.71918C-1.93574e-05 4.99028 0.23464 5.20577 0.505883 5.20577Z"/></svg></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Begin text-block -->
        <?php
    }

}
