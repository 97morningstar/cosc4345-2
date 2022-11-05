<?php
namespace ChildItAddons\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Programs extends Widget_Base {

    public function get_name() {
        return 'programs';
    }

    public function get_title() {
        return __('Programs', 'childit-core');
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
        return ['education-slider'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'bg_image_section', [
                'label' => __('BG Image', 'childit-core'),
            ]
        );

        $this->add_control(
            'image', [
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_program', [
                'label' => __('Content', 'childit-core'),
            ]
        );

        $this->add_control(
            'title_1', [
                'label' => __('Title 1', 'childit-core'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('We are dedicated to the care and education', 'childit-core'),
            ]
        );

        $this->add_control(
            'title_2', [
                'label' => __('Title 2', 'childit-core'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('Our Educational Programs', 'childit-core'),
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
                'default' => 4,
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
                    'menu_order' => __('Menu order', 'childit-core'),
                ],
            ]
        );

        $this->add_control(
            'order', [
                'label' => __('Order', 'childit-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => __('DESC', 'childit-core'),
                    'asc' => __('ASC', 'childit-core'),
                ],
            ]
        );

        $this->add_control(
            'button_text', [
                'label' => __('Button Text', 'childit-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('book a tour', 'childit-core'),
            ]
        );

        $this->add_control(
            'button_url', [
                'label' => __('Link', 'childit-core'),
                'type' => Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
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
				'selector' => '{{WRAPPER}} .section-header.on-scroll h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .section-header.on-scroll.show-scroll .h-sub',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Content Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .programs-sectio-content-text',
			)
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'item_title_typography',
				'label'    => __( 'Item Title Typography', 'childit-core' ),
				'selector' => '{{WRAPPER}} .education-short .education-bottom p',
			)
        );
        
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $posts_per_page = $settings['number'];
        $order_by = $settings['order_by'];
        $order = $settings['order'];
        $button_text = $settings['button_text'];
        $args = array(
            'post_type' => 'our-programs',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $order_by,
            'order' => $order,
        );
        $posts = new \WP_Query($args);
        $childit_bg_image_url = isset($settings['image']['id']) ? wp_get_attachment_url($settings['image']['id']) : '';
        if (!$childit_bg_image_url) {
            $childit_bg_image_url = $settings['image']['url'];
        }

        $childit_button_url = $settings['button_url']['url'];

        $slick_atts = array(
            'arrows' => false,
            'dots' => true,
            'infinite' => true,
            'adaptiveHeight' => true,
            'slidesToShow' => 3,
            'slidesToScroll' => 1,
            'autoplaySpeed' => 5000,
            'autoplay' => true,
            'responsive' => array(
                array(
                    'breakpoint' => 1200,
                    'settings' => array(
                        "slidesToShow" => 2,
                    ),
                ),
                array(
                    'breakpoint' => 765,
                    'settings' => array(
                        "slidesToShow" => 1,
                    ),
                ),
            ))
        ?>
<!-- Begin education-slier -->
<section class="wave-block mb-xs-65 mb-md-60 mb-lg-120 pb-xs-130 pb-md-120 pb-lg-150 pt-xs-90 pt-md-120 pt-lg-180 lazy"
  data-src="<?php echo esc_url($childit_bg_image_url); ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-header on-scroll">
          <p class="h-sub">
            <?php echo wp_kses_post($settings['title_1']); ?>
          </p>
          <h2><?php echo wp_kses_post($settings['title_2']); ?>
          </h2>
          <p class="programs-sectio-content-text">
            <?php echo wp_kses_post($settings['content']); ?>
          </p>
        </div>
        <div class="education-slier on-scroll fade-up" data-slick='<?php echo wp_json_encode($slick_atts); ?>'>
          <?php
            if ($posts->have_posts()) {
            $i = 1;
            while ($posts->have_posts()) {
                $posts->the_post();
                $chilit_education_age = get_post_meta(get_the_ID(), 'childit-age', true);
                $chilit_education_old = get_post_meta(get_the_ID(), 'childit-old', true);
                ?>
          <div class="it-card">
            <div class="education-short color-<?php echo esc_attr($i); ?>">
              <div class="education-top">
                <?php if (has_post_thumbnail(get_the_ID())): ?>
                <?php $chilid_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');?>
                <picture>
                  <source type="image/jpeg" srcset="<?php echo esc_url($chilid_image[0]); ?>">
                  <img src="<?php echo esc_url($chilid_image[0]); ?>" alt="<?php echo esc_attr('img'); ?>">
                </picture>
                <?php endif;?>
                <div class="hide-block">
                  <div class="inner-wrap">
                    <?php the_excerpt();?>
                    <a href="<?php echo esc_url($childit_button_url); ?>" class="read-more"
                      tabindex="-1"><?php echo wp_kses_post($button_text); ?> <svg xmlns="http://www.w3.org/2000/svg"
                        width="9" height="9" viewBox="0 0 9 9" fill="none">
                        <path
                          d="M0.505883 5.20577L0.491834 5.2027L6.51423 5.2027L4.62101 7.10009C4.5283 7.19272 4.47745 7.31821 4.47745 7.44992C4.47745 7.58162 4.5283 7.70623 4.62101 7.79909L4.91559 8.09382C5.00823 8.18645 5.13166 8.23767 5.2633 8.23767C5.39501 8.23767 5.51852 8.18682 5.61115 8.09418L8.85649 4.84913C8.94949 4.75613 9.00035 4.63226 8.99998 4.50048C9.00035 4.36796 8.94949 4.24401 8.85649 4.15116L5.61115 0.905818C5.51852 0.813257 5.39508 0.76233 5.2633 0.76233C5.13166 0.76233 5.00823 0.813331 4.91559 0.905818L4.62101 1.20055C4.5283 1.29304 4.47745 1.41655 4.47745 1.54826C4.47745 1.67989 4.5283 1.79689 4.62101 1.88945L6.53559 3.79745L0.499152 3.79745C0.227908 3.79745 -1.94412e-05 4.03123 -1.94175e-05 4.30233L-1.93811e-05 4.71918C-1.93574e-05 4.99028 0.23464 5.20577 0.505883 5.20577Z">
                        </path>
                      </svg></a>
                  </div>
                </div>
              </div>
              <div class="education-bottom">
                <p><?php the_title();?> <span
                    class="education-age"><?php echo wp_kses_post($chilit_education_age); ?></span><span
                    class="old"><?php echo wp_kses_post($chilit_education_old); ?></span></p>
              </div>
              <!-- educational-1 -->
            </div>
          </div>
          <?php
        $i++;
            }
        }
        wp_reset_query();
        ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End education-slier -->
<?php
}
}