<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Elementor_slider_Widget extends \Elementor\Widget_Base
{
	/**
	  * Minimum Elementor Version
	  *
	  * @since 1.0.0
	  * @var string Minimum Elementor version required to run the addon.
	  */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	// our widget code geos here
	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'widget-slider';
	}

	public function get_script_depends()
	{
		return ['widget-script-1', 'widget-script-2'];
	}

	public function get_style_depends()
	{
		return ['widget-style-1', 'widget-style-2'];
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Widget Slider', 'widget-test');
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['general'];
	}

	public function get_keywords()
	{
		return ['slider', 'corousel', 'slides'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'elementor-oembed-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slider_title',
			array(
				'label' => esc_html__('Title', 'widget-test'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('', 'widget-test'),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'slider_image',
			array(
				'label' => esc_html__('', 'widget-test'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'slider_description',
			array(
				'label' => esc_html__('', 'widget-test'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('', 'widget-test'),
			)
		);
		$repeater->add_control(
			'button_text',
			array(
				'label' => esc_html__('Button Text', 'widget-test'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('', 'widget-test'),

			)
		);

		$repeater->add_control(
			'list_link',
			[
				'label' => __('Link', 'widget-test'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('#', 'widget-test'),
				'show_label' => true,
			]
		);

		$this->add_control(
			'slider_widget',
			array(
				'label'       => esc_html__('Slider', 'widget-test'),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'main_heading' => esc_html__('{{{ slider_title }}}', 'widget-test'),
						'card_content' => esc_html__('Item content. Click the edit button to change this text.', 'widget-test'),
					),
				)

			)
		);

		
		


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'Title_options',
			[
				'label' => esc_html__( 'Title Options', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'color',
			[
				'label' => esc_html__( 'Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#510C76',
				'selectors' => [
					'{{WRAPPER}} .name-heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .name-heading',
			]
		);

		$this->add_control(
			'Description_options',
			[
				'label' => esc_html__( 'Description Options', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				
			]
		);

		$this->add_control(
			'color_description',
			[
				'label' => esc_html__( 'Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#510C76',
				'selectors' => [
					'{{WRAPPER}} .description' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .description',
			]
		);
	}


	protected function render()
	{

		$settings = $this->get_settings_for_display();

		if ($settings['slider_widget']) {

			?>
			<!-- Start rendering the output -->
			<div class="stories-slider-wrapper">
				<div class="container">
					<div class="story-slider-wrp">
						<div class="swiper swiper-container">
							<div class="swiper-wrapper">
								<?php foreach ($settings['slider_widget'] as $index => $item) : ?>
									<?php
									$image_url = isset($item['slider_image']['url']) && !empty($item['slider_image']['url']) ? $item['slider_image']['url']  : false;
									$title = isset($item['slider_title']) && !empty($item['slider_title']) ? $item['slider_title'] : false;
									$button_text = isset($item['button_text']) && !empty($item['button_text']) ? $item['button_text'] : false;
									?>
									<div class="swiper-slide">
										<div class="slide-story">
											<div class="featured-img">
												<?php if ($image_url) : ?>
													<?php echo '<img src="' . esc_url($image_url) . '" alt="">'; ?>
												<?php endif; ?>
											</div>
											<div class="content-col-slide">
												<?php if ($title) : ?>
													<h4 class="name-heading"><?php echo  $title ?></h4>
												<?php endif; ?>
												<div class="description"><?php echo $item['slider_description'] ?></div>
												<div class="btn-wrp text-link">
													<?php if ($button_text) : ?>
														<a href="<?php echo $item['list_link']; ?>"><?php echo $button_text ?></a>
													<?php endif; ?>

												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="swiper-controller">
								<div class="swiper-next-btn"></div>
								<div class="swiper-prev-btn"></div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End rendering the output -->

			<?php
		}
	}
}



?>