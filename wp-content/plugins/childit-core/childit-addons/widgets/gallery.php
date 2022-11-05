<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Gallery extends Widget_Base {

    public function get_name() {
        return 'gallery';
    }

    public function get_title() {
        return __('Gallery', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'section_blogs', [
            'label' => __('Gallery', 'childit-core'),
                ]
        );
        $this->add_control(
                'bg_image', [
            'label' => __('BG Image', 'childit-core'),
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
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Checkout our Instagram feed', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('#ChildiT</span> Centre Photo Gallery', 'childit-core'),
                ]
        );

        $this->add_control(
                'number', [
            'label' => __('Number of Gallery', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 6
                ]
        );

        $this->add_control(
                'order_by', [
            'label' => __('Order By', 'childit-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'date',
            'options' => [
                'date' => __('Date', 'childit-core'),
                'ID' => __('ID', 'childit-core'),
                'author' => __('Author', 'childit-core'),
                'title' => __('Title', 'childit-core'),
                'modified' => __('Modified', 'childit-core'),
                'rand' => __('Random', 'childit-core'),
                'comment_count' => __('Comment count', 'childit-core'),
                'menu_order' => __('Menu order', 'childit-core')
            ]
                ]
        );

        $this->add_control(
                'order', [
            'label' => __('Order', 'childit-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'desc',
            'options' => [
                'desc' => __('DESC', 'childit-core'),
                'asc' => __('ASC', 'childit-core')
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
				'selector' => '{{WRAPPER}} .section-header.on-scroll.show-scroll h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub Title Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .section-header.on-scroll.show-scroll .h-sub',
			)
        );        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $bg_image_url = ( $settings['bg_image']['id'] != '' ) ? wp_get_attachment_url($settings['bg_image']['id']) : $settings['bg_image']['url'];
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $pg_num = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => array('galleries'),
            'post_status' => array('publish'),
            'nopaging' => false,
            'paged' => $pg_num,
            'posts_per_page' => $posts_per_page,
            'orderby' => $order_by,
            'order' => $order,
        );
        $query = new \WP_Query($args);
        ?>
        <!-- Begin gallery section -->
        <section class="wave-block wave-gallery reverce-wave pb-xs-90 pb-md-130 pb-lg-150 pt-xs-75 pt-md-115 pt-lg-150 bg-cover mb-xs-55 mb-md-75 mb-lg-120 lazy" data-src="<?php echo esc_url($bg_image_url); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header on-scroll">
                            <p class="h-sub">
                                <?php
                                echo wp_kses_post($settings['title_1']);
                                ?>
                            </p>
                            <h2><span class="main-color-font">
                                    <?php
                                    echo wp_kses_post($settings['title_2']);
                                    ?>
                            </h2>
                        </div>
                        <div class="gallery-prewiev-wrap on-scroll fade-up">
                            <?php
                            if ($query->have_posts()) {
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    ?>
                                    <div class="gallery-item">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $childit_featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                            ?>
                                            <a href="<?php echo esc_url($childit_featured_image); ?>" data-gallery="example-gallery">
                                                <?php
                                                childit_post_thumbnail_image();
                                                ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End gallery section -->
        <?php
    }

}
