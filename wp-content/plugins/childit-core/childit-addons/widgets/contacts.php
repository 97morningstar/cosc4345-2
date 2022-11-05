<?php
namespace ChildItAddons\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

class Contacts extends \Elementor\Widget_Base {

	public function get_name() {
		return 'contacts';
	}

	public function get_title() {
		return __( 'Contacts', 'childit-core' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return array( 'childit' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'map_section',
			array(
				'label' => __( 'Map', 'childit-core' ),
			)
		);

		$this->add_control(
			'show_map',
			array(
				'label'        => __( 'Show Map', 'childit-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'childit-core' ),
				'label_off'    => __( 'Hide', 'childit-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'map_style',
			array(
				'label'   => __( 'Map Style', 'childit-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'api_key',
				'options' => array(
					'api_key' => __( 'By API Key', 'childit-core' ),
					'embed'   => __( 'Embed Google Map', 'childit-core' ),
				),
			)
		);

		$this->add_control(
			'map_embed_code',
			array(
				'label'       => __( 'Map Embed Code. Size:(540x520)', 'childit-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => 'Please Follow the Link <a href="https://www.embedgooglemap.net/" target="_blank">embedgooglemap.net/</a>',
				'condition'   => array(
					'map_style' => 'embed',
				),
			)
		);

		$this->add_control(
			'latitude',
			array(
				'label'     => __( 'Iatitude', 'childit-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '-117.2697074',
				'condition' => array(
					'map_style' => 'api_key',
				),
			)
		);

		$this->add_control(
			'longitude',
			array(
				'label'     => __( 'Longitudes', 'childit-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '34.0887252',
				'condition' => array(
					'map_style' => 'api_key',
				),

			)
		);
		$this->add_control(
			'zoom',
			array(
				'label'     => __( 'Zoom', 'childit-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 15,
				'condition' => array(
					'map_style' => 'api_key',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'contact_section',
			array(
				'label' => __( 'Form', 'childit-core' ),
			)
		);
		$this->add_control(
			'title_1',
			array(
				'label'       => __( 'Title 1', 'childit-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Get In Touch', 'childit-core' ),
			)
		);

		$this->add_control(
			'title_2',
			array(
				'label'   => __( 'Title 2', 'childit-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Each year, we have many fun ChildIt Family events scheduled simultaneously in all of our centres. In addition, each ChildIt location has its own unique events.', 'childit-core' ),
			)
		);

		$this->add_control(
			'shortcode',
			array(
				'label' => __( 'CF7 shortcode', 'childit-core' ),
				'type'  => Controls_Manager::TEXTAREA,
			)
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
				'name'     => 'form_title_typography',
				'label'    => __( 'Form Title Typography', 'childit-core' ),
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .contact-container h2',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$latitude  = $settings['latitude'];
		$longitude = $settings['longitude'];
		$zoom      = $settings['zoom'];
		$title_1   = $settings['title_1'];
		$title_2   = $settings['title_2'];
		$shortcode = $settings['shortcode'];

		?>
		<!-- Begin contacts -->
		<section class="contact-container pt-60 pb-60 pt-xs-30 pb-xs-30 pt-md-60 pb-md-60 r-cloud">
			<div class="container">
				<div class="row">
					<?php

					$row_column = 'col-lg-12';
					if ( $settings['show_map'] ) {
						$row_column = 'col-lg-6';

						?>
					 <div class="col-lg-6 mb-xs-50 mb-md-60">
						<?php
						if ( $settings['map_style'] == 'api_key' ) {
							?>
						<div class="map-block" id="contact-map" data-lng='<?php echo esc_attr( $latitude ); ?>' data-lat='<?php echo esc_attr( $longitude ); ?>' data-zoom='<?php echo esc_attr( $zoom ); ?>' data-map-icon="<?php echo esc_url( CHILDIT_IMG_URL . 'map-marker.svg' ); ?>"></div>
							<?php
						} else {
							echo $settings['map_embed_code'];
						}
						?>
					</div>
						<?php
					}
					?>
					
					<div class="<?php echo esc_attr( $row_column ); ?> mb-xs-20 mb-md-60">
						<h2>
							<?php
							echo wp_kses_post( $title_1 );
							?>
						</h2>
						<p class="mb-xs-10 mb-lg-20">
							<?php
							echo wp_kses_post( $title_2 );
							?>
						</p>
						<!-- Begin main-form -->
						<?php echo do_shortcode( shortcode_unautop( $shortcode ) ); ?>
						<!-- End main-form -->
					</div>
				</div>
			</div>
		</section>
		<!-- End contacts -->
		<?php
	}

}
