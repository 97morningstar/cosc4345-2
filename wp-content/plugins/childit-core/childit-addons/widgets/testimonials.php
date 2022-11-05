<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Testimonials extends Widget_Base {

    public function get_name() {
        return 'testimonials';
    }

    public function get_title() {
        return __('Testimonials', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'section_testimonials', [
            'label' => __('Content', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('We love to hear from our parents!', 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Comments From Parents', 'childit-core')
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('If you have feedback or words of praise that you would like to share, please submit your review at the bottom of this page.', 'childit-core'),
                ]
        );

        $this->add_control(
                'number', [
            'label' => __('Number of Testimonials', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 9
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
                'section_form', [
            'label' => __('Form Section', 'childit-core'),
                ]
        );

        $this->add_control(
                'title', [
            'label' => __('Title', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Want to Leave Your Review?', 'childit-core'),
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
				'selector' => '{{WRAPPER}} .testimonial-block .testimonial-description h5',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_title_typography',
				'label'    => __( 'Form Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .testimonials-form-title-text',
			)
		);
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $pg_num = get_query_var('pageid') ? get_query_var('pageid') : 1;
        $args = array(
            'post_type' => array('testimonials'),
            'post_status' => array('publish'),
            'nopaging' => false,
            'paged' => $pg_num,
            'posts_per_page' => $posts_per_page,
            'orderby' => $order_by,
            'order' => $order,
        );
        $query = new \WP_Query($args);
        ?>
        <!-- Begin testimonials-section -->
        <section class="testimonials-section pt-xs-40 pt-md-60 pb-xs-50 pb-md-70 pb-lg-120">
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
                    </div>
                    <?php if ($query->have_posts()) { ?>
                        <ul class="testimonial-list justify-content-center grid">
                            <?php
                            while ($query->have_posts()) {
                                $query->the_post();
                                ?>
                                <li class="grid-item">
                                    <div class="testimonial-block">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $childit_testi_url = get_the_post_thumbnail_url(get_the_ID());
                                            ?>
                                            <div class="testimonial-img">
                                                <img src="<?php echo esc_url($childit_testi_url); ?>" alt="<?php esc_attr_e('img', 'childit-core'); ?>">
                                            </div>
                                            <div class="testimonial-description">
                                                <h5><?php the_title(); ?></h5>
                                                <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time>
                                                <?php the_content(); ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <div class="pagination mt-xs-45 mt-md-60 mt-lg-90 mb-xs-30 mb-md-60 mb-lg-90">
                            <?php
                            $current = max(1, (int) filter_input(INPUT_GET, 'pageid'));
                            $big = 999999999; // need an unlikely integer
                            echo paginate_links(array(
                                'base' => add_query_arg('pageid', '%#%'),
                                'format' => '?pageid=%#%',
                                'total' => $query->max_num_pages,
                                'current' => $current,
                                'show_all' => false,
                                'end_size' => 1,
                                'mid_size' => 2,
                                'prev_next' => false,
                                'type' => 'plain',
                                'add_args' => false,
                                'add_fragment' => '',
                            ));
                            ?>
                        </div>
                        <?php
                        wp_reset_postdata();
                    }
                    ?>
                    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                        <!-- Begin main-form -->
                        <h3 class="text-center testimonials-form-title-text"><?php
                            echo wp_kses_post($settings['title']);
                            ?>
                        </h3>
                        <?php echo do_shortcode(shortcode_unautop($settings['testi_cf7'])); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End testimonials-section -->
        <?php
    }

}
