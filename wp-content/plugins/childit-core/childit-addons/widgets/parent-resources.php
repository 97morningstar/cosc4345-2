<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Parent_Resource extends Widget_Base {

    public function get_name() {
        return 'parent_resource';
    }

    public function get_title() {
        return __('Parent Resource', 'childit-core');
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
            'type' => Controls_Manager::TEXT,
            'default' => __('Parent Resources', 'childit-core')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('The Parent Handbook provides new parents with an understanding of the mission, philosophy, policies, and procedures followed at our centre.', 'childit-core'),
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

        $repeater->add_control(
                'download_title', [
            'label' => __('Download Title', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __('Type your title here', 'childit-core'),
                ]
        );

        $repeater->add_control(
                'download_url', [
            'label' => __('Download URL', 'childit-core'),
            'type' => Controls_Manager::URL,
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
                    'title' => 'Parent Handbook (246 Kb)',
                    'download_url' => "#"
                ],
                [
                    'title' => 'Child Care Checklist (95 KB)',
                    'download_url' => "#"
                ],
                [
                    'title' => 'Agreement Form (94 KB)',
                    'download_url' => "#"
                ],
                [
                    'title' => 'Monthly Billing Chart (95 KB)',
                    'download_url' => "#"
                ]
            ]
                ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <!-- Begin Parent Info -->
        <div class="parent-resources-wrap pt-50">
            <div class="section-header mb-xs-30 mb-md-31">
                <h3>
                    <?php
                    echo wp_kses_post($settings['title_1']);
                    ?>
                </h3>
                <p>
                    <?php
                    echo wp_kses_post($settings['content']);
                    ?>
                </p>
            </div>
            <ul class="resources-list">
                <?php
                if (!empty($settings['item_list'])) {
                    foreach ($settings['item_list'] as $item) {
                        $image_url = isset($item['image']['id']) ? wp_get_attachment_url($item['image']['id']) :'';
                            if( ! $image_url){
                                $image_url = $item['image']['url'];
                            }
                            if( ! $download_title){
                                $download_title = $item['download_title'];
                            }
                        ?>
                        <li>
                            <div class="resources-block">
                                <div class="resources-img">
                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy resource-ico" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr('img'); ?>">
                                    <img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy cloud" data-src="<?php echo esc_url(CHILDIT_IMG_URL . 'cloud-small.svg'); ?>" alt="<?php echo esc_attr('img'); ?>">
                                </div>
                                <div class="resources-text">
                                    <p><?php echo wp_kses_post($item['title']); ?></p>
                                    <a href="#"><img src="<?php echo esc_url(CHILDIT_IMG_URL . 'lazy.png'); ?>" class="lazy" data-src="<?php echo esc_url(CHILDIT_IMG_URL . 'pdf-ico.svg'); ?>" alt="<?php echo esc_attr('img'); ?>"><?php echo $download_title; ?></a>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <!-- End Parent Info -->
        <?php
    }

}
