<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


class Post_Widget extends \Elementor\Widget_Base{
    public function get_name()
	{
		return 'post-widget';
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
		return esc_html__('Post Widget', 'widget-test');
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
		return ['post', 'posts', 'posts'];
	}

    /**
	 * Get post categories from the dropdown.
	 *
	 * @return array The post categories.
	 */
	// public function get_students_list() {
	// 	$student_posts = get_posts(
	// 		array(
	// 			'post_type'      => 'post',
	// 		)
	// 	);

	// 	$student_post_list     = array();
	// 	// $student_post_list[''] = __( 'All Student Posts', 'mccf' );
	// 	// foreach ( $student_posts as $student_post ) {
	// 	// 	$student_post_list[ $student_post->ID ] = $student_post->post_title;
	// 	// }
	// 	// return $student_post_list;
    //     return $student_posts;
	// }


	
    

	

    protected function register_controls()
	{

		

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'elementor-oembed-widget'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$categories = get_categories(array(
			'hide_empty' => 0,
			'orderby' => 'name',
			'order' => 'ASC'
		  ));
		  
		  $options = array();
		  
		  foreach ($categories as $category) {
			// $options[] =  $category->name;
			// 'value' => strval($category->term_id),
			$options[] = array(
				'value' => strval($category->term_id),
				'label' => strval($category->name)
			  );
 var_dump($options);
			
		  }

		 
		$this->add_control(
				'category',
				array(
				'label' => __( 'Category', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $options[0],
				'multiple' => true,
				)
		);
		  
		  

		

		$this->add_control(
			'demo_post_per_page_post',
			array(
				'label'   => esc_html__( 'Posts Per Page', 'widget-test' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'default' => esc_html__( '1', 'widget-test' ),
			)
		);
        
        $this->end_controls_section();

    
    }

    protected function render()
	{

		$settings = $this->get_settings_for_display();
		$post_per_page = isset( $settings['demo_post_per_page_post'] ) && ! empty( $settings['demo_post_per_page_post'] ) ? $settings['demo_post_per_page_post'] : '';
		
		// var_dump($setting['category']);
		
        $post_query = new WP_Query(
			array(
				'post_type'      => 'post',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $post_per_page,
			)
		);

		if($post_query ->have_posts()){
			
			?>
<div class="posts-slider-wrapper">
    <div class="container">
        <?php
						while ( $post_query->have_posts() ) :
							$post_query->the_post();
											
					?>
        <div class="swiper-slide single-post-wrp">
            <div class="post-single">
                <a href="<?php echo get_permalink(); ?>" class="featured-img">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'medium' ); ?>
                    <?php endif; ?>
                </a>
                <div class="content-col-slide">
                    <h6 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo  get_the_title()  ?></a>
                    </h6>
                    <div class="post-meta-date"><span><?php echo get_the_date( 'F D, Y' ); ?></span></div>
					<div class="post-meta-date"><span><?php echo get_the_date( 'F D, Y' ); ?></span></div>
                    <div class="btn-wrp text-link">
                        <a href="<?php echo get_permalink(); ?>" class="elementor-button">Read The <span
                                class="last">Story</span></a>
                    </div>
                </div>
            </div>
        </div>
        <?php							
					endwhile;
					?>;
    </div>
</div>
<?php
		
}
	
}

}

?>