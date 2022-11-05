<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Blogs extends Widget_Base {

    public function get_name() {
        return 'blogs';
    }

    public function get_title() {
        return __('Blog', 'childit-core');
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return ['childit'];
    }
    private function get_blog_categories() {
      $options  = array();
      $taxonomy = 'category';
      if ( ! empty( $taxonomy ) ) {
        $terms = get_terms(
          array(
            'parent'     => 0,
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
          )
        );
        if ( ! empty( $terms ) ) {
          foreach ( $terms as $term ) {
            if ( isset( $term ) ) {
              $options[''] = 'Select';
              if ( isset( $term->slug ) && isset( $term->name ) ) {
                $options[ $term->slug ] = $term->name;
              }
            }
          }
        }
      }
      return $options;
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
        return ['blogs'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'section_blogs', [
            'label' => __('Blogs', 'childit-core'),
                ]
        );

        $this->add_control(
                'title_1', [
            'label' => __('Title 1', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __("What\'s new", 'childit-core')
                ]
        );

        $this->add_control(
                'title_2', [
            'label' => __('Title 2', 'childit-core'),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'default' => __('Latest News', 'childit-core')
                ]
        );


        $this->add_control(
          'category_id',
          array(
            'type'        => Controls_Manager::SELECT2,
            'label'       => esc_html__( 'Category', 'fionca-core' ),
            'options'     => $this->get_blog_categories(),
            'multiple'    => true,
            'label_block' => true,
          )
        );

        $this->add_control(
                'number', [
            'label' => __('Number of Post', 'childit-core'),
            'type' => Controls_Manager::TEXT,
            'default' => 4
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


        $this->add_control(
            'show_author',
            [
                'label' => __( 'Show Author', 'childit-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'childit-core' ),
                'label_off' => __( 'Hide', 'childit-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_commnets',
            [
                'label' => __( 'Show Comments', 'childit-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'childit-core' ),
                'label_off' => __( 'Hide', 'childit-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
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
            'name'     => 'blog_title_typography',
            'label'    => __( 'Blog Title Typography', 'childit-core' ),
            'selector' => '{{WRAPPER}} .section-header.on-scroll.show-scroll h2',
          )
        );
        $this->add_group_control(
          Group_Control_Typography::get_type(),
          array(
            'name'     => 'blog_sub_title_typography',
            'label'    => __( 'Blog Sub Title Typography', 'childit-core' ),
            'selector' => '{{WRAPPER}} .section-header.on-scroll.show-scroll .h-sub',
          )
        );
        $this->add_group_control(
          Group_Control_Typography::get_type(),
          array(
            'name'     => 'item_blog_title_typography',
            'label'    => __( 'Item Title Typography', 'childit-core' ),
            'selector' => '{{WRAPPER}} .news-block .news-block-description .news-block-description__short-text h4 a',
          )
        );
        $this->add_group_control(
          Group_Control_Typography::get_type(),
          array(
            'name'     => 'item_blog_content_typography',
            'label'    => __( 'Item Content Typography', 'childit-core' ),
            'selector' => '{{WRAPPER}} .news-block .news-block-description .news-block-description__short-text p',
          )
        );
            
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $show_commnets = $settings['show_commnets'];
        $show_author = $settings['show_author'];
        $order = $settings['order'];
        $pg_num = get_query_var('paged') ? get_query_var('paged') : 1;

        if ( $settings['category_id'] ) {
          $category_arr = implode( ', ', $settings['category_id'] );
        } else {
          $category_arr = '';
        }
        $args = array(
            'post_type' => array('post'),
            'post_status' => array('publish'),
            'nopaging' => false,
            'paged' => $pg_num,
            'posts_per_page' => $posts_per_page,
			      'category_name'  => $category_arr,
            'orderby' => $order_by,
            'order' => $order,
        );
        $query = new \WP_Query($args);
        ?>
<!-- Begin latest news -->
<section class="mb-xs-50 mb-md-80 mb-lg-120">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-header on-scroll">
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
        </div>
        <div class="news-slider" data-show-count='3' data-show-count-md='2' data-show-count-mob='1'
          data-slick-speed="5000" data-slick-autoplay="true">
          <?php
          if ($query->have_posts()) {
              $i = 1;
              while ($query->have_posts()) {
                  $query->the_post();
                  ?>
          <div class="news-slider__card">
            <div class="news-block">
              <?php
                if (has_post_thumbnail()) {
                    $childit_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'childit_blog_post_section_image');
                    ?>
              <a href="<?php the_permalink(); ?>" class="news-block__img">
                <picture>
                  <source type="image/jpeg" srcset="<?php echo esc_url($childit_featured_image[0]); ?>">
                  <img src="<?php echo esc_url($childit_featured_image[0]); ?>"
                    alt="<?php esc_attr_e('Img', 'childit'); ?>">
                </picture>
              </a>
              <?php } ?>
              <div class="news-block-description">
                <div class="news-block-description__main-info">
                  <?php if ($show_author) { ?>
                  <p>
                    <?php echo esc_html__('by','childit-core');?><span class="main-color-font">
                      <?php childit_posted_author(); ?>
                    </span>
                  </p>
                  <?php
                }
                if ($show_commnets) {
                    echo '<p>';
                    childit_comments_count(); 
                    echo ' </p>';
                }
                ?>
                </div>
                <div class="news-block-description__short-text">
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <?php echo the_excerpt();?>
                  <?php childit_posted_on(); ?>
                </div>
              </div>
            </div>
          </div>
          <?php
                  $i++;
              }
              wp_reset_postdata();
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End latest news -->
<?php
    }

}