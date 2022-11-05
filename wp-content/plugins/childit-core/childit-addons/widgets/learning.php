<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Learning extends Widget_Base {

    public function get_name() {
        return 'learning';
    }

    public function get_title() {
        return __('Learning', 'childit-core');
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
        return ['learn-tab'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'content_section', [
            'label' => __('Left Content', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('We provide the main activities', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('<span>Elements</span> of Learning. Committed to Excellence', 'childit-core'),
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Our curriculum is based on the research of the most renowned education experts', 'childit-core'),
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
                'right_section', [
            'label' => __('Right Section', 'childit-core'),
                ]
        );


        $this->add_control(
                'circle_title', [
            'label' => __('Circle Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Curriculum<br>Elements', 'childit-core'),
            'placeholder' => __('Type your title here', 'childit-core'),
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
            'label' => __('Title one', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );
        $repeater->add_control(
                'title_2', [
            'label' => __('Title two', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );
        $repeater->add_control(
                'circle_link', [
            'label' => __('Link', 'childit-core'),
            'type' => Controls_Manager::URL,
            'placeholder'   => esc_html__( 'https://your-link.com', 'childit-core' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
            ]
        );

        $this->add_control(
                'item_list', [
            'label' => __('Item List', 'childit-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'title_1' => __('Gardening', 'childit-core'),
                    'title_2' => __('The Toddler and Preschool Groups have a garden in their outdoor space. Each spring, the children and teachers contribute and create beautiful and educational container/raised bed gardens.', 'childit-core'),
                ],
                [
                    'title_1' => __('Sport', 'childit-core'),
                    'title_2' => __('Children need to develop large motor and small motor skills and cardiovascular endurance. Extensive physical activity is also needed to address a growing problem of obesity in American children.', 'childit-core'),
                ],
                [
                    'title_1' => __('Art', 'childit-core'),
                    'title_2' => __('Kids will love designing and creating puppets and collages, constructing musical instruments and flower bouquets, and painting, gluing, and crafting to their hearts’ content!', 'childit-core'),
                ],
                [
                    'title_1' => __('Excursions', 'childit-core'),
                    'title_2' => __('Excursions form a vital part of a child’s early education. They expose a child to a range of different experiences and enable them to gain a sense of the world in which they find themselves.', 'childit-core'),
                ],
                [
                    'title_1' => __('Outdoor', 'childit-core'),
                    'title_2' => __('Our children benefit from a variety of outdoor play spaces. In addition to our playground, they experience the natural wonders of the forest, the big field, our raised gardens and nature walks.', 'childit-core'),
                ],
                [
                    'title_1' => __('Math', 'childit-core'),
                    'title_2' => __('A preschool math curriculum should be taught using preschool lessons including interactive activities, learning games, printable worksheets, assessments, and reinforcement.', 'childit-core'),
                ],
                [
                    'title_1' => __('Literacy', 'childit-core'),
                    'title_2' => __('A systematic and integrated literacy program promote language development preschool children. The program uses systematic, direct instruction built around a series of weekly books in the classroom.', 'childit-core'),
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
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'circle_container_title_typography',
				'label'    => __( 'Right Circle Title Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .learning-elements-wrap .tab-element-content h3',
			)
        );
        
		$this->end_controls_section();

        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $url = '#';
        $target = '';
        if (!empty($settings['action_link'])) {
            $link = $settings['action_link'];
            $url = $link['url'];
            $target = $link['is_external'] ? 'target="_blank"' : '';
        }
        ?>
        <!-- Begin learning element -->
        <div class="row align-items-lg-center">
            <div class="col-lg-6 on-scroll fade-left">
                <div class="block-header">
                    <p class="mb-xs-15 mb-lg-8"><?php
                    echo wp_kses_post($settings['title_1']);
                    ?></p>
                    <h2 class="mb-xs-25 mb-md-25"><?php
                    echo wp_kses_post($settings['title_2']);
                    ?>
                </h2>
            </div>
            <?php
            echo wp_kses_post($settings['content']);

            if (!empty($settings['button_text'])) { ?>
            <a href="<?php echo esc_url($url); ?>" <?php echo esc_url($target); ?> class="read-more"><?php echo esc_html($settings['button_text']); ?> <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M0.505883 5.20577L0.491834 5.2027L6.51423 5.2027L4.62101 7.10009C4.5283 7.19272 4.47745 7.31821 4.47745 7.44992C4.47745 7.58162 4.5283 7.70623 4.62101 7.79909L4.91559 8.09382C5.00823 8.18645 5.13166 8.23767 5.2633 8.23767C5.39501 8.23767 5.51852 8.18682 5.61115 8.09418L8.85649 4.84913C8.94949 4.75613 9.00035 4.63226 8.99998 4.50048C9.00035 4.36796 8.94949 4.24401 8.85649 4.15116L5.61115 0.905818C5.51852 0.813257 5.39508 0.76233 5.2633 0.76233C5.13166 0.76233 5.00823 0.813331 4.91559 0.905818L4.62101 1.20055C4.5283 1.29304 4.47745 1.41655 4.47745 1.54826C4.47745 1.67989 4.5283 1.79689 4.62101 1.88945L6.53559 3.79745L0.499152 3.79745C0.227908 3.79745 -1.94412e-05 4.03123 -1.94175e-05 4.30233L-1.93811e-05 4.71918C-1.93574e-05 4.99028 0.23464 5.20577 0.505883 5.20577Z"/></svg></a>
            <?php  
               }
             ?>
            </div>
            <div class="col-lg-6 on-scroll fade-up">
                <div class="el-wr">
                    <div class="learning-elements-wrap">
                        <div class="circle-container">
                            <?php
                            if (!empty($settings['item_list'])) {
                                foreach ($settings['item_list'] as $key => $item ) {
                                    $circle_link = $item["circle_link"]['url'];
                                    $circle_link_external = $item["circle_link"]["is_external"] ? 'target="_blank"' : '';
                                    $circle_link_nofollow = $item["circle_link"]["nofollow"] ? 'rel="nofollow"' : '';
                                    $image_alt = get_post_meta($item['image']['id'], '_wp_attachment_image_alt', TRUE);
                                    $image_url = ( $item['image']['id'] != '' ) ? wp_get_attachment_url($item['image']['id']) : $item['image']['url'];
                                    ?>
                                    <a href="<?php echo esc_url($circle_link); ?>" <?php echo $circle_link_external; echo $circle_link_nofollow; ?> ><div class="learning-item" data-learn-tab='#<?php echo $key; ?>'>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                            <p><?php echo wp_kses_post($item['title_1']); ?></p>
                                    </div></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="tab-element-content">
                            <div class="for-tab start">
                                <h3>
                                    <?php
                                    if (!empty($settings['circle_title'])) { 
                                       echo wp_kses_post($settings['circle_title']);
                                    }
                                    ?>
                             </h3>
                            </div>
                            <?php
                            if (!empty($settings['item_list'])) {
                                foreach ($settings['item_list'] as $key => $item) {
                                    ?>
                                    <div class="for-tab" id="<?php echo $key; ?>">
                                        <h3><?php echo wp_kses_post($item['title_1']); ?></h3>
                                        <p class="mb-0"><?php echo wp_kses_post($item['title_2']); ?></p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="my-paroller" data-paroller-factor="0.3" data-paroller-type="foreground" data-paroller-direction="vertical">
                            <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url(CHILDIT_IMG_URL . 'cloud.png'); ?>" alt="<?php esc_attr_e('Cloud', 'childit-core'); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End learning element -->
        <?php
    }

}
