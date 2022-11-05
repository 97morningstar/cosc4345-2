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

class About_Us extends Widget_Base {

    public function get_name() {
        return 'about_us';
    }

    public function get_title() {
        return __('About Us', 'childit-core');
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
            'default' => __('Where work and play come together', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' =>__('<span>The Center</span> for Early Childhood Education', 'childit-core')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('We provide an innovative, nurturing and stimulating environment where children develop independence, confidence and a positive sense of self and the world around them. Our curriculum is designed to involve children in experiences that enhance language, literacy, music, movement, art and socialization. Through play, all areas of development are fostered.', 'childit-core')
                ]
        );

        $this->add_control(
                'button_text', [
            'label' => __('Button Text', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' =>  __('read more', 'childit-core'),
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
				'selector' => '{{WRAPPER}} .show-scroll .block-header p',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .show-scroll > p',
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
        $rnd = rand(10,100);
        ?>
        <section class="text-block pb-xs-30 pb-sm-50 pb-md-60 on-scroll">
            <div class="container">
                <div class="row align-items-sm-center align-items-lg-center">
                    <div class="col-md-6 on-scroll fade-left fade-scale">
                        <div class="svg-block">
                            <svg viewBox="0 0 526 502" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <mask id="img1" maskUnits="userSpaceOnUse" x="0" y="0" width="526" height="502">
                                    <path d="M51 8.49999C125.8 -21.9 276.833 39.8333 343 74.5C288.5 32.5 323 18.5 347 20.5C371 22.5 432.5 44.5 467.5 68C495.5 86.8 491.167 99.8333 485.5 104C489.333 108.333 499.7 121.5 510.5 139.5C524 162 532.5 183.5 517 210C504.6 231.2 446.833 231.833 421 229.5C419.667 229.5 422.4 233.9 444 251.5C471 273.5 495.5 299.5 493.5 330.5C491.9 355.3 436.833 363.833 409.5 365C410.5 368.5 409.8 376.9 399 382.5C388.2 388.1 355.833 387.5 341 386.5C364.167 399 410.3 428.9 409.5 448.5C408.5 473 386.5 492 344 488C301.5 484 238 444.5 250 452.5C262 460.5 280 481.5 271.5 492C263 502.5 236 504.5 216.5 496C197 487.5 81.5 440.5 67.5 397.5C53.5 354.5 83.5 367 81.5 359.5C79.5 352 53 346.5 25.5 293C3.50001 250.2 34.5 226.5 58 224.5C54.8333 224.5 40.3 217.8 23.5 191C6.7 164.2 25.8333 142.5 37.5 135C35.5 133.167 30.6 128.6 27 125C22.5 120.5 -42.5 46.5 51 8.49999Z" fill="#C4C4C4"/>
                                </mask>
                                <g mask="url(#img1)">
                                    <rect y="-13" width="750" height="523" fill="url(#pattern<?php echo $rnd;?>)"/>
                                </g>
                                <defs>
                                    <pattern id="pattern<?php echo $rnd;?>" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#for-img<?php echo $rnd;?>" transform="scale(0.00133333 0.00191205)"/>
                                    </pattern>
                                    <image id="for-img<?php echo $rnd;?>" width="750" height="523" xlink:href="<?php echo esc_url($image_url); ?>"></image>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div class="col-md-6 on-scroll fade-up fade-scale pt-xs-35 pt-md-0">
                        <div class="block-header mb-xs-25 mb-md-25">
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
                        <p class="mb-xs-20 mb-md-30">
                            <?php
                            echo wp_kses_post($settings['content']);
                            ?>
                        </p>
                        <?php
                        if ($settings['action_link']['url']) { ?>
                        <a href="<?php echo esc_url($settings['action_link']['url']); ?>" <?php echo $target; ?> class="read-more"><?php echo esc_html($settings['button_text']); ?> <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M0.505883 5.20577L0.491834 5.2027L6.51423 5.2027L4.62101 7.10009C4.5283 7.19272 4.47745 7.31821 4.47745 7.44992C4.47745 7.58162 4.5283 7.70623 4.62101 7.79909L4.91559 8.09382C5.00823 8.18645 5.13166 8.23767 5.2633 8.23767C5.39501 8.23767 5.51852 8.18682 5.61115 8.09418L8.85649 4.84913C8.94949 4.75613 9.00035 4.63226 8.99998 4.50048C9.00035 4.36796 8.94949 4.24401 8.85649 4.15116L5.61115 0.905818C5.51852 0.813257 5.39508 0.76233 5.2633 0.76233C5.13166 0.76233 5.00823 0.813331 4.91559 0.905818L4.62101 1.20055C4.5283 1.29304 4.47745 1.41655 4.47745 1.54826C4.47745 1.67989 4.5283 1.79689 4.62101 1.88945L6.53559 3.79745L0.499152 3.79745C0.227908 3.79745 -1.94412e-05 4.03123 -1.94175e-05 4.30233L-1.93811e-05 4.71918C-1.93574e-05 4.99028 0.23464 5.20577 0.505883 5.20577Z"/></svg></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}
