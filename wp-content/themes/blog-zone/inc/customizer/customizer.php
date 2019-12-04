<?php
/**
 * Blog Zone Theme Customizer
 *
 * @package Blog_Zone
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blog_zone_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.site-title a',
		'container_inclusive' => false,
		'render_callback'     => 'blog_zone_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'            => '.site-description',
		'container_inclusive' => false,
		'render_callback'     => 'blog_zone_customize_partial_blogdescription',
	) );

	/* Include Controls
	----------------------------------------------------------------------*/
	require get_template_directory() . '/inc/customizer/customizer-controls.php';

	/* Include Sanitization functions
	----------------------------------------------------------------------*/
	require get_template_directory() . '/inc/customizer/customizer-sanitize.php';

	/* Load Upgrade to Pro control
	----------------------------------------------------------------------*/
	require_once trailingslashit( get_template_directory() ) . '/inc/upgrade-to-pro/control.php';

	/* Register custom section types.
	----------------------------------------------------------------------*/
	$wp_customize->register_section_type( 'Blog_Zone_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Blog_Zone_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Blog Zone Pro', 'blog-zone' ),
				'pro_text' => esc_html__( 'Buy Pro', 'blog-zone' ),
				'pro_url'  => 'https://www.prodesigns.com/wordpress-themes/downloads/blog-zone-pro/',
				'priority' => 1,
			)
		)
	);

	$defaults = blog_zone_default_options();

	/*------------------------------------------------------------------------*/
    /*  For logo options
    /*------------------------------------------------------------------------*/
	$wp_customize->add_setting( 'logo_type', 
		array(
			'default'           => $defaults['logo_type'],			
			'sanitize_callback' => 'blog_zone_sanitize_select'
		)
	);

	$wp_customize->add_control( 'logo_type', 
		array(
			'label'       => esc_html__('Site Title and Logo', 'blog-zone'),
			'section'     => 'title_tagline',   
			'type'        => 'radio',
			'priority'    => 10,
			'choices'     => array(
				'logo-only' 		=> esc_html__( 'Logo Only', 'blog-zone' ),
				'title-desc' 		=> esc_html__( 'Title + Tagline', 'blog-zone' ),
				'logo-title'   		=> esc_html__( 'Logo + Title', 'blog-zone' ),
				'logo-desc'   		=> esc_html__( 'Logo + Tagline', 'blog-zone' ),

			),
		)
	);

	/*------------------------------------------------------------------------*/
    /*  Option Panel
    /*------------------------------------------------------------------------*/
	$wp_customize->add_panel( 'theme_options', 
		array(
			'title'				=> esc_html__('Theme Options', 'blog-zone'),
			'priority' 			=> 30		
			)
	);

	
	/*------------------------------------------------------------------------*/
    /*  Main Header Section
    /*------------------------------------------------------------------------*/
	$wp_customize->add_section( 'main_header', 
		array(    
			'title'       => esc_html__('Main Header', 'blog-zone'),
			'panel'       => 'theme_options'    
		)
	);

	// Show home icon in main menu
	$wp_customize->add_setting( 'home_icon',
		array(
			'default'           => $defaults['home_icon'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'home_icon',
		array(
			'label'           => esc_html__( 'Show home icon in menu', 'blog-zone' ),
			'section'         => 'main_header',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// Show social icons in main menu
	$wp_customize->add_setting( 'social_icons',
		array(
			'default'           => $defaults['social_icons'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'social_icons',
		array(
			'label'           => esc_html__( 'Show social icons in menu', 'blog-zone' ),
			'section'         => 'main_header',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// Show search in main menu
	$wp_customize->add_setting( 'show_search',
		array(
			'default'           => $defaults['show_search'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'show_search',
		array(
			'label'           => esc_html__( 'Show search in menu', 'blog-zone' ),
			'section'         => 'main_header',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	/*------------------------------------------------------------------------*/
    /*  Slider Section
    /*------------------------------------------------------------------------*/
	$wp_customize->add_section( 'main_slider', 
		array(    
			'title'       => esc_html__('Slider Selection', 'blog-zone'),
			'panel'       => 'theme_options'    
		)
	);

	$wp_customize->add_setting( 'slider_status',
		array(
			'default'           => $defaults['slider_status'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'slider_status',
		array(
			'label'           => esc_html__( 'Enable Slider', 'blog-zone' ),
			'section'         => 'main_slider',
			'type'            => 'checkbox',
			'priority'        => 100
		)
	);

	// Slider Type 
	$wp_customize->add_setting( 'slider_type', 
		array(
			'default'           => $defaults['slider_type'],			
			'sanitize_callback' => 'blog_zone_sanitize_select'
		)
	);

	$wp_customize->add_control( 'slider_type', 
		array(
			'label'       => esc_html__('Slider Type', 'blog-zone'),
			'section'     => 'main_slider',   
			'type'        => 'radio',
			'priority'    => 100,
			'choices'     => array(
				'category_posts' 	=> esc_html__( 'Posts from category', 'blog-zone' ),
				'pages' 			=> esc_html__( 'Assign Pages', 'blog-zone' ),
			),
			'active_callback' 	=> 'blog_zone_slider_active'
		)
	);

	// Slider category 
	$wp_customize->add_setting( 'slider_category', 
		array(
			'default'           => '',			
			'sanitize_callback' => 'blog_zone_sanitize_number'
		)
	);

	$wp_customize->add_control(
		new Blog_Zone_Customize_Category_Control(
			$wp_customize,
			'slider_category',
			array(
				'label'       		=> esc_html__( 'Category for Slider', 'blog-zone' ),
				'section'     		=> 'main_slider', 
				'priority'    		=> 100,  
				'active_callback' 	=> 'blog_zone_slider_type_category',     
			)
		)
	);

	$slide = 5;
	for ( $i = 1; $i <= $slide; $i++ ) {
		$wp_customize->add_setting( "slide_$i",
			array(
				'sanitize_callback' => 'blog_zone_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control( "slide_$i",
			array(
				'label'           => esc_html__( 'Page', 'blog-zone' ) . ' - ' . $i,
				'section'         => 'main_slider',
				'type'            => 'dropdown-pages',
				'priority'        => 100,
				'active_callback' => 'blog_zone_slider_type_page',
			)
		);
	}

	// hide posted date of slider
	$wp_customize->add_setting( 'hide_slider_date',
		array(
			'default'           => $defaults['hide_slider_date'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_slider_date',
		array(
			'label'           => esc_html__( 'Hide posted date in slider', 'blog-zone' ),
			'section'         => 'main_slider',
			'type'            => 'checkbox',
			'priority'        => 100,
			'active_callback' => 'blog_zone_slider_active',
		)
	);

	// hide category of slider
	$wp_customize->add_setting( 'hide_slider_cat',
		array(
			'default'           => $defaults['hide_slider_cat'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_slider_cat',
		array(
			'label'           => esc_html__( 'Hide post category in slider', 'blog-zone' ),
			'section'         => 'main_slider',
			'type'            => 'checkbox',
			'priority'        => 100,
			'active_callback' => 'blog_zone_slider_active',
		)
	);

	/*------------------------------------------------------------------------*/
    /*  Slider Section
    /*------------------------------------------------------------------------*/
	$wp_customize->add_section( 'slider_settings', 
		array(    
			'title'       => esc_html__('Slider Settings', 'blog-zone'),
			'panel'       => 'theme_options'    
		)
	);

	// hide posted date of slider
	$wp_customize->add_setting( 'hide_slider_date',
		array(
			'default'           => $defaults['hide_slider_date'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_slider_date',
		array(
			'label'           => esc_html__( 'Hide Posted Date', 'blog-zone' ),
			'section'         => 'slider_settings',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// hide category of slider
	$wp_customize->add_setting( 'hide_slider_cat',
		array(
			'default'           => $defaults['hide_slider_cat'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_slider_cat',
		array(
			'label'           => esc_html__( 'Hide Post Category', 'blog-zone' ),
			'section'         => 'slider_settings',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// Setting slider_transition_effect.
	$wp_customize->add_setting( 'slider_transition_effect',
		array(
			'default'           => $defaults['slider_transition_effect'],
			'sanitize_callback' => 'blog_zone_sanitize_select',
		)
	);
	$wp_customize->add_control( 'slider_transition_effect',
		array(
			'label'           => __( 'Transition Effect', 'blog-zone' ),
			'section'         => 'slider_settings',
			'type'            => 'select',
			'priority'        => 100,
			'choices'         => array(
				'fade'       => esc_html__( 'Fade', 'blog-zone' ),
				'scrollHorz' => esc_html__( 'Scroll Horizontal', 'blog-zone' ),
				'scrollVertz' => esc_html__( 'Scroll Vertical', 'blog-zone' ),
			),
		)
	);

	// Setting slider_transition_delay.
	$wp_customize->add_setting( 'slider_transition_delay',
		array(
			'default'           => $defaults['slider_transition_delay'],
			'sanitize_callback' => 'blog_zone_sanitize_number',
		)
	);
	$wp_customize->add_control( 'slider_transition_delay',
		array(
			'label'           => esc_html__( 'Transition Delay', 'blog-zone' ),
			'description'     => esc_html__( 'in seconds', 'blog-zone' ),
			'section'         => 'slider_settings',
			'type'            => 'number',
			'priority'        => 100,
			'input_attrs'     => array( 'min' => 2, 'max' => 10, 'step' => 1, 'style' => 'width: 100px;' ),
		)
	);
	
	// Setting slider_arrow_status.
	$wp_customize->add_setting( 'slider_arrow_status',
		array(
			'default'           => $defaults['slider_arrow_status'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'slider_arrow_status',
		array(
			'label'           => esc_html__( 'Show Arrow', 'blog-zone' ),
			'section'         => 'slider_settings',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// Setting slider_autoplay_status.
	$wp_customize->add_setting( 'slider_autoplay_status',
		array(
			'default'           => $defaults['slider_autoplay_status'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'slider_autoplay_status',
		array(
			'label'           => esc_html__( 'Enable Autoplay', 'blog-zone' ),
			'section'         => 'slider_settings',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// Setting slider_overlay_status.
	$wp_customize->add_setting( 'slider_overlay_status',
		array(
			'default'           => $defaults['slider_overlay_status'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'slider_overlay_status',
		array(
			'label'           => esc_html__( 'Enable Overlay', 'blog-zone' ),
			'section'         => 'slider_settings',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	/*------------------------------------------------------------------------*/
    /*  Featured Post (After Slider) Section
    /*------------------------------------------------------------------------*/
	$wp_customize->add_section( 'featured_post', 
		array(    
			'title'       => esc_html__('Featured Posts (After Slider)', 'blog-zone'),
			'panel'       => 'theme_options'    
		)
	);

	// Featured Post Type 
	$wp_customize->add_setting( 'featured_post_type', 
		array(
			'default'           => $defaults['featured_post_type'],			
			'sanitize_callback' => 'blog_zone_sanitize_select'
		)
	);

	$wp_customize->add_control( 'featured_post_type', 
		array(
			'label'       => esc_html__('Featured Post Type', 'blog-zone'),
			'section'     => 'featured_post',   
			'type'        => 'radio',
			'priority'    => 100,
			'choices'     => array(
				'category_posts' 	=> esc_html__( 'Posts from category', 'blog-zone' ),
				'pages' 			=> esc_html__( 'Assign Pages', 'blog-zone' ),
			),
		)
	);

	// Featured post category 
	$wp_customize->add_setting( 'featured_post_category', 
		array(
			'default'           => '',			
			'sanitize_callback' => 'blog_zone_sanitize_number'
		)
	);

	$wp_customize->add_control(
		new Blog_Zone_Customize_Category_Control(
			$wp_customize,
			'featured_post_category',
			array(
				'label'       		=> esc_html__( 'Category for Featured Post', 'blog-zone' ),
				'section'     		=> 'featured_post', 
				'priority'    		=> 100,  
				'active_callback' 	=> 'blog_zone_featured_post_type_category',     
			)
		)
	);

	$featured_post = 2;
	for ( $i = 1; $i <= $featured_post; $i++ ) {
		$wp_customize->add_setting( "featured_post_$i",
			array(
				'sanitize_callback' => 'blog_zone_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control( "featured_post_$i",
			array(
				'label'           => esc_html__( 'Page', 'blog-zone' ) . ' - ' . $i,
				'section'         => 'featured_post',
				'type'            => 'dropdown-pages',
				'priority'        => 100,
				'active_callback' => 'blog_zone_featured_post_type_page',
			)
		);
	}

	// hide posted date of featured post
	$wp_customize->add_setting( 'hide_featured_post_date',
		array(
			'default'           => $defaults['hide_featured_post_date'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_featured_post_date',
		array(
			'label'           => esc_html__( 'Hide posted date', 'blog-zone' ),
			'section'         => 'featured_post',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// hide category of featured post
	$wp_customize->add_setting( 'hide_featured_post_cat',
		array(
			'default'           => $defaults['hide_featured_post_cat'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_featured_post_cat',
		array(
			'label'           => esc_html__( 'Hide post category', 'blog-zone' ),
			'section'         => 'featured_post',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	/*------------------------------------------------------------------------*/
    /*  Global Page, Post and Blog Section
    /*------------------------------------------------------------------------*/
	$wp_customize->add_section( 'global_blog', 
		array(    
			'title'       => esc_html__('Blog Options', 'blog-zone'),
			'panel'       => 'theme_options'    
		)
	);

	// Setting blog_layout.
	$wp_customize->add_setting( 'blog_layout',
		array(
			'default'           => $defaults['blog_layout'],
			'sanitize_callback' => 'blog_zone_sanitize_select',
		)
	);
	$wp_customize->add_control( 'blog_layout',
		array(
			'label'    => esc_html__( 'Blog Layout', 'blog-zone' ),
			'section'  => 'global_blog',
			'type'     => 'radio',
			'priority' => 100,
			'choices'  => array(
					'left-sidebar'  => esc_html__( 'Left Sidebar', 'blog-zone' ),
					'right-sidebar' => esc_html__( 'Right Sidebar', 'blog-zone' ),
					'no-sidebar' => esc_html__( 'No Sidebar', 'blog-zone' )
				),
		)
	);

	// readmore text.
	$wp_customize->add_setting( 'readmore_text',
		array(
			'default'           => $defaults['readmore_text'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'readmore_text',
		array(
			'label'    => esc_html__( 'Read More Text', 'blog-zone' ),
			'section'  => 'global_blog',
			'type'     => 'text',
			'priority' => 100,
		)
	);

	// Setting excerpt_length.
	$wp_customize->add_setting( 'excerpt_length',
		array(
			'default'           => $defaults['excerpt_length'],
			'sanitize_callback' => 'blog_zone_sanitize_number',
		)
	);
	$wp_customize->add_control( 'excerpt_length',
		array(
			'label'       => esc_html__( 'Excerpt Length', 'blog-zone' ),
			'description' => esc_html__( 'in words', 'blog-zone' ),
			'section'     => 'global_blog',
			'type'        => 'number',
			'priority'    => 100,
			'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
		)
	);

	// hide posted date of blog post
	$wp_customize->add_setting( 'hide_blog_post_date',
		array(
			'default'           => $defaults['hide_blog_post_date'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_blog_post_date',
		array(
			'label'           => esc_html__( 'Hide posted date', 'blog-zone' ),
			'section'         => 'global_blog',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// hide category of blog post
	$wp_customize->add_setting( 'hide_blog_post_cat',
		array(
			'default'           => $defaults['hide_blog_post_cat'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_blog_post_cat',
		array(
			'label'           => esc_html__( 'Hide post category', 'blog-zone' ),
			'section'         => 'global_blog',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	// hide readmore button of blog post
	$wp_customize->add_setting( 'hide_blog_post_btn',
		array(
			'default'           => $defaults['hide_blog_post_btn'],
			'sanitize_callback' => 'blog_zone_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'hide_blog_post_btn',
		array(
			'label'           => esc_html__( 'Hide read more button', 'blog-zone' ),
			'section'         => 'global_blog',
			'type'            => 'checkbox',
			'priority'        => 100,
		)
	);

	/*------------------------------------------------------------------------*/
    /*  Social Section
    /*------------------------------------------------------------------------*/
	$wp_customize->add_section( 'social_links', 
		array(    
			'title'       => esc_html__('Social Links', 'blog-zone'),
			'panel'       => 'theme_options'    
		)
	);

	for( $j= 1; $j<=5; $j++ ){
		$wp_customize->add_setting( "social_link_$j",
			array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		if( $j == 1 ){
			$desc_info = esc_html__( 'Ex: https://www.facebook.com/TheProDesigns', 'blog-zone' );
		}elseif( $j == 2 ){
			$desc_info = esc_html__( 'Ex: https://twitter.com/TheProDesigns', 'blog-zone' );
		}else{
			$desc_info = '';
		}

		$wp_customize->add_control( "social_link_$j",
			array(
				'label'           => esc_html__( 'Social Link', 'blog-zone' ),
				'description' 	  => $desc_info,
				'section'         => 'social_links',
				'type'            => 'text',
				'priority'        => 100,
			)
		);
	}

	/*------------------------------------------------------------------------*/
    /*  Footer Section
    /*------------------------------------------------------------------------*/
	$wp_customize->add_section( 'footer', 
		array(    
			'title'       => esc_html__('Footer Options', 'blog-zone'),
			'panel'       => 'theme_options'    
		)
	);	

	// Copyright.
	$wp_customize->add_setting( 'copyright_text',
		array(
			'default'           => $defaults['copyright_text'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'copyright_text',
		array(
			'label'    => esc_html__( 'Copyright Text', 'blog-zone' ),
			'section'  => 'footer',
			'type'     => 'text',
			'priority' => 100,
		)
	);

}

add_action( 'customize_register', 'blog_zone_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function blog_zone_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function blog_zone_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blog_zone_customize_preview_js() {
	wp_enqueue_script( 'blog-zone-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blog_zone_customize_preview_js' );

/**
 * Enqueue style for custom customize control.
 */
function blog_zone_custom_customize_enqueue() {

	wp_enqueue_script( 'blog-zone-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

	wp_enqueue_style( 'blog-zone-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'blog_zone_custom_customize_enqueue' );
