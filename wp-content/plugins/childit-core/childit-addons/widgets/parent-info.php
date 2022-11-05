<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Parent_Info extends Widget_Base {

    public function get_name() {
        return 'parent_info';
    }

    public function get_title() {
        return __('Parent Info', 'childit-core');
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
            'label' => __('Content', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Partnerships with families', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Information for Parents', 'childit-core'),
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Established relationships with parents means we can share information positively and effectively to support children as much as possible.', 'childit-core'),
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
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $repeater->add_control(
                'content', [
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
                    'title' => __('Hours of Operation', 'childit-core'),
                    'content' => __("Eligible hours of care are based on parent's working hours plus one half hour for picking up of your child. For example: If your working or school hours are 9:00am-4:30pm then your eligible hours of care are 8:30am-5:00pm.", 'childit-core'),
                ],
                [
                    'title' => __('Medical Information', 'childit-core'),
                    'content' =>__("Open communication between parents and staff is strongly encouraged. Teachers are encouraged to learn what is important to you as a parent and to use that information when programming for the group.", 'childit-core'),
                ],
                [
                    'title' => __('Medical Information', 'childit-core'),
                    'content' => __('We are required under the Child Care and Early Years Act to have a copy of each child\'s immunization record or a statement of religious or conscientious objection to immunization.', 'childit-core'),
                ],
                [
                    'title' => __('Injuries', 'childit-core'),
                    'content' => __("If your child is injured while at the centre, staff will administer basic first aid. If medical attention is required, attempts will be made to reach the parents immediately. Staff will call Emergency Services if required.", 'childit-core'),
                ],
                [
                    'title' => __('Clothing', 'childit-core'),
                    'content' => __("Exploration often requires getting messagey! All of the materials that we use are washable however, we are aware that some paint colours and other materials are difficult to fully remove.", 'childit-core'),
                ],
                [
                    'title' => __('Nutrition', 'childit-core'),
                    'content' => __("Children are encouraged to taste a variety of foods but no child is ever forced to eat foods that they do not wish to. All parts of the meal make up a child's nutritional requirement; therefore no food will be withheld.", 'childit-core'),
                ]
            ]
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'p_content_section', [
            'label' => __('Parent Resource', 'childit-core'),
                ]
        );

        $this->add_control(
                'p_title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Parent Resources', 'childit-core')
                ]
        );

        $this->add_control(
                'p_content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('The Parent Handbook provides new parents with an understanding of the mission, philosophy, policies, and procedures followed at our centre.', 'childit-core'),
                ]
        );

        $repeater_1 = new \Elementor\Repeater();
        $repeater_1->add_control(
                'image', [
            'label' => __('Image', 'childit-core'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
                ]
        );

        $repeater_1->add_control(
                'title', [
            'label' => __('Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $repeater_1->add_control(
                'download_url', [
            'label' => __('Download URL', 'childit-core'),
            'type' => Controls_Manager::URL,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $this->add_control(
                'p_item_list', [
            'label' => __('Item List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title' => 'Parent Handbook (246 Kb)',
                    'download_url' => "#"
                ],
                [
                    'title' => 'Child Care Checklist (95 KB)',
                    'download_url' => [
                        'url' => '#'
                    ]
                ],
                [
                    'title' => 'Agreement Form (94 KB)',
                    'download_url' => [
                        'url' => '#'
                    ]
                ],
                [
                    'title' => 'Monthly Billing Chart (95 KB)',
                    'download_url' => [
                        'url' => '#'
                    ]
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
				'selector' => '{{WRAPPER}} .parent-info-item .parent-title h5',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bottom_title_typography',
				'label'    => __( 'Bottom Title Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .parent-resources-wrap .section-header h3',
			)
		);
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <!-- Begin Parent Info -->
        <section class="parent-info-section pt-xs-30 pt-md-60 pb-xs-50 pb-md-70 pb-lg-120">
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
                                echo wp_kses_post($settings['content']);
                                ?>
                            </p>
                        </div>
                        <ul class="parent-info-list">
                            <?php
                            if (!empty($settings['item_list'])) {
                                foreach ($settings['item_list'] as $item) {
                                    $image_url = ( $item['image']['id'] != '' ) ? wp_get_attachment_url($item['image']['id']) : $item['image']['url'];
                                    ?>
                                    <li>
                                        <div class="parent-info-item">
                                            <div class="parent-info-image">
                                                <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr('img'); ?>">
                                            </div>
                                            <div class="parent-info-text">
                                                <div class="parent-title"><span class="parent-title__ico">
                                                        <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url(CHILDIT_IMG_URL . 'check.svg'); ?>" alt="<?php echo esc_attr('img'); ?>"></span> <h5><?php echo wp_kses_post($item['title']); ?></h5></div>
                                                <p><?php echo wp_kses_post($item['content']); ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        <div class="parent-resources-wrap pt-50">
                            <div class="section-header mb-xs-30 mb-md-31">
                                <h3>
                                    <?php
                                    echo wp_kses_post($settings['p_title_1']);
                                    ?>
                                </h3>
                                <p>
                                    <?php
                                    echo wp_kses_post($settings['p_content']);
                                    ?>
                                </p>
                            </div>
                            <ul class="resources-list">
                                <?php
                                if (!empty($settings['p_item_list'])) {
                                    foreach ($settings['p_item_list'] as $item) {
                                        $image_url = ( $item['image']['id'] != '' ) ? wp_get_attachment_url($item['image']['id']) : $item['image']['url'];
                                        ?>
                                        <li>
                                            <div class="resources-block">
                                                <div class="resources-img">
                                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy resource-ico" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr('img'); ?>">
                                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy cloud" data-src="<?php echo esc_url(CHILDIT_IMG_URL . 'cloud-small.svg'); ?>" alt="<?php echo esc_attr('img'); ?>">
                                                </div>
                                                <div class="resources-text">
                                                    <p><?php echo wp_kses_post($item['title']); ?></p>
                                                    <a href="<?php echo esc_url($item['download_url']['url']); ?>"><img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url(CHILDIT_IMG_URL . 'pdf-ico.svg'); ?>" alt="<?php echo esc_attr('img'); ?>"><?php echo __('download', 'childit-core') ?></a>
                                                </div>
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
            </div>
        </section>
        <!-- End Parent Info -->
        <?php
    }

}
