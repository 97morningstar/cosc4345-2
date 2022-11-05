<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Foods extends Widget_Base {

    public function get_name() {
        return 'foods';
    }

    public function get_title() {
        return __('Foods', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'bg_image_section', [
                'label' => __('BG Image', 'childit-core'),
            ]
        );

        $this->add_control(
            'bg_image', [
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
                'default' => __('Children need healthy, wholesome foods', 'childit-core'),
            ]
        );

        $this->add_control(
            'title_2', [
                'label' => __('Title 2', 'childit-core'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('<span>Healthy</span> Food for Growing Children', 'childit-core'),
            ]
        );

        $this->add_control(
            'content', [
                'label' => __('Content', 'childit-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('By eating family-style and serving themselves, children learn about making healthy choices and the connection between food and community.', 'childit-core'),
            ]
        );

        $this->add_control(
            'show_icon_list',
            [
                'label' => __('Icon List', 'childit-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'childit-core'),
                'label_off' => __('Hide', 'childit-core'),
                'return_value' => 'yes',
                'default' => 'yes',
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
            'title', [
                'label' => __('Title', 'childit-core'),
                'type' => Controls_Manager::TEXT,
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
                        'title' => __('Fruits', 'childit-core'),
                    ],
                    [
                        'title' => __('Vegetables', 'childit-core'),
                    ],
                    [
                        'title' => __('Grains', 'childit-core'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

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
                    'custom' => __('Custom', 'childit-core'),
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
				'selector' => '{{WRAPPER}} .block-header h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub Title Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .block-header p',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .show-scroll > p',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $attachment_size = array();
        $has_custom_size = false;
        if (!empty($settings['width']) && !empty($settings['height'])) {
            $has_custom_size = true;
            $attachment_size[0] = (int) $settings['width'];
            $attachment_size[1] = (int) $settings['height'];
        }

        if (!$has_custom_size) {
            $attachment_size = 'full';
        }

        if (is_array($attachment_size)) {
            $instance = ['image_size' => 'custom', 'image_custom_dimension' => ['width' => (int) $settings['width'], 'height' => (int) $settings['height']]];
            $big_image_url = Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'image', $instance);
        } else {
            if (!empty($settings['image']['id'])) {
                $image_src = wp_get_attachment_image_src($settings['image']['id'], $attachment_size);
                $big_image_url = $image_src[0];
            } else {
                $big_image_url = $settings['image']['url'];
            }
        }

        $bg_image_url = ($settings['bg_image']['id'] != '') ? wp_get_attachment_url($settings['bg_image']['id']) : $settings['bg_image']['url'];

        ?>
<!-- Begin foods -->
<section
  class="food-section wave-block reverce-wave bg-cover pb-xs-90 pb-md-120 pb-lg-150 pt-xs-70 pt-md-110 pt-lg-170 mb-xs-50 mb-md-75 mb-lg-120 lazy"
  data-src="<?php echo esc_url($bg_image_url); ?>">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 on-scroll fade-left">
        <div class="block-header">
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
        <p class="mb-xs-20 mb-md-45">
          <?php
echo wp_kses_post($settings['content']);
        ?>
        </p>

        <?php
if ($settings['show_icon_list']) {?>
        <div class="icons-list bm-0">
          <?php
if (!empty($settings['item_list'])) {
            foreach ($settings['item_list'] as $item) {
                $image_alt = get_post_meta($item['image']['id'], '_wp_attachment_image_alt', true);
                $image_url = ($item['image']['id'] != '') ? wp_get_attachment_url($item['image']['id']) : $item['image']['url'];
                ?>
          <div class="icon square-icon">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt) ?>">
            <p><?php echo wp_kses_post($item['title']); ?></p>
          </div>
          <?php
}
        }
            ?>
        </div>
        <?php }
        ?>
      </div>
      <div class="col-md-6 on-scroll fade-up">
        <div class="svg-block">
          <svg viewBox="0 0 526 502" fill="none" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <mask id="img1-food" maskUnits="userSpaceOnUse" x="0" y="0" width="526" height="502">
              <path
                d="M51 8.49999C125.8 -21.9 276.833 39.8333 343 74.5C288.5 32.5 323 18.5 347 20.5C371 22.5 432.5 44.5 467.5 68C495.5 86.8 491.167 99.8333 485.5 104C489.333 108.333 499.7 121.5 510.5 139.5C524 162 532.5 183.5 517 210C504.6 231.2 446.833 231.833 421 229.5C419.667 229.5 422.4 233.9 444 251.5C471 273.5 495.5 299.5 493.5 330.5C491.9 355.3 436.833 363.833 409.5 365C410.5 368.5 409.8 376.9 399 382.5C388.2 388.1 355.833 387.5 341 386.5C364.167 399 410.3 428.9 409.5 448.5C408.5 473 386.5 492 344 488C301.5 484 238 444.5 250 452.5C262 460.5 280 481.5 271.5 492C263 502.5 236 504.5 216.5 496C197 487.5 81.5 440.5 67.5 397.5C53.5 354.5 83.5 367 81.5 359.5C79.5 352 53 346.5 25.5 293C3.50001 250.2 34.5 226.5 58 224.5C54.8333 224.5 40.3 217.8 23.5 191C6.7 164.2 25.8333 142.5 37.5 135C35.5 133.167 30.6 128.6 27 125C22.5 120.5 -42.5 46.5 51 8.49999Z"
                fill="#C4C4C4" />
            </mask>
            <g mask="url(#img1-food)">
              <rect y="-13" width="750" height="523" fill="url(#pattern-food-children)" />
            </g>
            <defs>
              <pattern id="pattern-food-children" patternContentUnits="objectBoundingBox" width="1" height="1">
                <use xlink:href="#for-img1-food" transform="scale(0.00133333 0.00191205)" />
              </pattern>
              <image id="for-img1-food" width="750" height="523" xlink:href="<?php echo esc_url($big_image_url); ?>">
              </image>
            </defs>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End foods -->
<?php
}

}