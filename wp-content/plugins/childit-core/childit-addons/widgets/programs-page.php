<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Programs_Page extends Widget_Base {

    public function get_name() {
        return 'programs_page';
    }

    public function get_title() {
        return __('Programs Page', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-post';
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
        return ['programs-page'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'section_program_page', [
            'label' => __('Content', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('We are dedicated to the care and education', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Our Educational Programs', 'childit-core')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Our exclusive curricula, combined with our own digital lesson planning tool, enable teachers to create personalized learning experiences, appropriate to every age group.', 'childit-core'),
                ]
        );


        $this->add_control(
                'number', [
            'label' => __('Number of Post', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 3
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
                'section_program_table', [
            'label' => __('Table Content', 'childit-core'),
                ]
        );

        $this->add_control(
                't_title_1', [
            'label' => __('Title 1', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Programs and curriculum table', 'childit-core'),
                ]
        );

        $this->add_control(
                't_title_2', [
            'label' => __('Title 2', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Enrolment Breakdown', 'childit-core'),
                ]
        );

        $this->add_control(
                'table_content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => ''
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
				'selector' => '{{WRAPPER}} .program-preview .program-description .program-heaer h3',
			)
		);
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $args = array(
            'post_type' => 'our-programs',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $order_by,
            'order' => $order
        );
        $posts = new \WP_Query($args);
        ?>
        <!-- Begin programs -->
        <section class="programs-section pt-xs-30 pt-md-60 pb-xs-55 pb-md-70 pb-lg-120">
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
                        <ul class="programs-list">
                            <?php
                            if ($posts->have_posts()) {
                                while ($posts->have_posts()) {
                                    $posts->the_post();
                                    global $post;
                                    $chilit_education_age = get_post_meta(get_the_ID(), 'childit-age', true);
                                    $chilit_education_old = get_post_meta(get_the_ID(), 'childit-old', true);
                                    $chilit_education_teachers = get_post_meta(get_the_ID(), 'childit-teachers', true);
                                    $childit_featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                    $chilit_education_gallery = get_post_meta(get_the_ID(), 'childit-gallery');
                                    ?>
                                    <li>
                                        <div class="program-preview">
                                            <div class="program-slider-wrap">
                                                <div class="program-age"><p><span><?php echo esc_html($chilit_education_age); ?></span> <?php echo esc_html($chilit_education_old); ?></p></div>
                                                <div class="program-big-slider" id="<?php echo get_the_ID(); ?>" data-nav="#<?php echo get_the_ID(); ?>-sm" data-show-count='1' data-show-count-md='1' data-show-count-mob='1' data-slick-arrow="true">
                                                    <?php if ($childit_featured_image) { ?>
                                                        <div class="program-slide">
                                                            <img src="<?php echo esc_url($childit_featured_image); ?>" alt="<?php esc_attr_e('img', 'childit-core'); ?>">
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (!empty($chilit_education_gallery)) {
                                                        foreach ($chilit_education_gallery as $attachment_id) {
                                                            $img = wp_get_attachment_image_src($attachment_id, 'full');
                                                            ?>
                                                            <div class="program-slide">
                                                                <img src="<?php echo esc_url($img[0]); ?>" alt="<?php esc_attr_e('img', 'childit-core'); ?>">
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>


                                                </div>
                                                <div class="program-nav-slider" id="<?php echo get_the_ID(); ?>-sm" data-nav="#<?php echo get_the_ID(); ?>" data-show-count='3' data-show-count-md='3' data-show-count-mob='3' data-slick-arrow="false" data-slick-speed="5000" data-slick-autoplay="true">

                                                    <?php if ($childit_featured_image) { ?>
                                                        <div class="program-slide">
                                                            <img src="<?php echo esc_url($childit_featured_image); ?>" alt="<?php esc_attr_e('img', 'childit-core'); ?>">
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (!empty($chilit_education_gallery)) {
                                                        foreach ($chilit_education_gallery as $attachment_id) {
                                                            $img = wp_get_attachment_image_src($attachment_id, 'full');
                                                            ?>
                                                            <div class="program-slide">
                                                                <img src="<?php echo esc_url($img[0]); ?>" alt="<?php esc_attr_e('img', 'childit-core'); ?>">
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="program-description" data-text="<?php the_title(); ?>">
                                                <div class="program-heaer">
                                                    <h3>
                                                        <?php
                                                        the_title();
                                                        ?>
                                                    </h3>
                                                    <?php
                                                     if (!empty($chilit_education_teachers)) { ?>
                                                         <p><strong><?php echo esc_html__('Teachers', 'childit-core'); ?>:</strong> <?php echo wp_kses_post($chilit_education_teachers); ?></p>
                                                      <?php } 
                                                       ?> 
                                                   </div>
                                                <div class="program-text">
                                                    <?php
                                                    the_content();
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            wp_reset_query();
                            ?>
                        </ul>
                        <div class="section-header mb-xs-30 mb-md-31 pt-xs-10 pt-md-35 pt-lg-40">
                            <p class="h-sub"><?php echo wp_kses_post($settings['t_title_1']);?></p>
                            <h2><?php echo wp_kses_post($settings['t_title_2']);?></h2>
                        </div>
                        <div class="table-wrap">
                            <table class="adaptive mb-0">
                                <?php echo wp_kses_post($settings['table_content']);?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End programs -->
        <?php
    }

}
