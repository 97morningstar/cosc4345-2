<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Page_Gallery_full extends Widget_Base {

    public function get_name() {
        return 'page_gallery_full';
    }

    public function get_title() {
        return __('Gallery Full Width', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return ['childit'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'section_page_gallery', [
            'label' => __('Page Gallery', 'childit-core'),
                ]
        );

        $this->add_control(
                'gallery_width', [
            'label' => __('Gallery Width', 'childit-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'boxed',
            'options' => [
                'boxed' => __('Boxed', 'childit-core'),
                'full' => __('Full', 'childit-core')
            ]
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('A quick peek at our centre', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('ChildiT Centre Photo Gallery', 'childit-core'),
                ]
        );

        $this->add_control(
                'content', [
            'label' => __('Content', 'childit-core'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('We aim to capture the many smiles we see every day, show the many experiences the children have every day and provide you as the families a visual experience.', 'childit-core'),
                ]
        );

        $this->add_control(
                'number', [
            'label' => __('Number of Gallery', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 16
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
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $pg_num = get_query_var('pageid') ? get_query_var('pageid') : 1;
        $args = array(
            'post_type' => 'galleries',
            'post_status' => array('publish'),
            'nopaging' => false,
            'paged' => $pg_num,
            'posts_per_page' => $posts_per_page,
            'orderby' => $order_by,
            'order' => $order,
        );
        $query = new \WP_Query($args);
        ?>
        <!-- Begin gallery-full-width -->
        <section class="gallery-full-width pt-xs-30 pt-md-60 pb-xs-40 pb-md-70 pb-lg-120">
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
                        <?php
                        if ($query->have_posts()) {
                            ?>
                            <div class="grid-filter">
                                <ul class="centre-tab-list">
                                    <li>
                                        <a href="#" data-filter="*" class="active">
                                            <?php echo __('All', 'childit-core'); ?>
                                        </a>
                                    </li>
                                    <?php
                                    $taxonomy = 'gallery';
                                    $terms = get_terms($taxonomy); // Get all terms of a taxonomy
                                    if ($terms && !is_wp_error($terms)) :
                                        foreach ($terms as $term) {
                                            ?>
                                            <li><a href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
                                            <?php
                                        }
                                    endif;
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            if ($query->have_posts()) {
                ?>
                <div class="grid full-width-gallery-grid">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        if (has_post_thumbnail()) {
                            $childit_featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            $childit_featured_image_1 = get_the_post_thumbnail_url(get_the_ID(), 'childit_galleries_full_width');
                            $post_terms = get_the_terms(get_the_ID(), 'gallery');
                            ?>
                            <div class="grid-item <?php echo $post_terms[0]->slug; ?>">
                                <div class="gallery-item">
                                    <a href="<?php echo esc_url($childit_featured_image); ?>" data-gallery="example-gallery">
                                        <img src="<?php echo esc_url($childit_featured_image_1); ?>" alt="<?php esc_attr_e('Img', 'childit'); ?>">
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="pagination mb-0 mt-xs-35 mt-md-40 mt-lg-45">
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
        </section>
        <?php
    }

}
