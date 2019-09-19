<?php 
/**
 * One Page Portfolio Theme Customizer
 *
 * @package One_Page_Portfolio
 */
if ( ! function_exists( 'rt_portfolio_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function rt_portfolio_get_default_theme_options() {

	$defaults = array();

	$defaults['site_identity']						= 'title-text';
	$defaults['enable_single_menu']					= false;
	$defaults['enable_search']						= true;
	$defaults['enable_social_menu']					= true;

	/*************************** Banner Section *******************************/
	$defaults['enable_home']						= true;	
	$defaults['home_menu_title']					= esc_html__( 'Home','one-page-portfolio');
	$defaults['home_section_title']					= esc_html__( 'About Me','one-page-portfolio');
	$defaults['banner_page']						= 0;
	$defaults['home_sub_title']						= esc_html__( 'UI/UX','one-page-portfolio');

	/**************************About Page Section *****************************/
	$defaults['enable_aboutus']						= true;	
	$defaults['aboutus_menu_title']					= esc_html__( 'About us','one-page-portfolio');
	$defaults['intro_section_title']				= esc_html__( 'Who Am I?','one-page-portfolio');	
	$defaults['intro_page_first']					= 0;
	$defaults['intro_title_first']					= esc_html__( 'About Me', 'one-page-portfolio' );
	$defaults['intro_page_second']					= 0;
	$defaults['intro_title_second']					= esc_html__( 'History', 'one-page-portfolio' );

	/*****************************Service Section **********************************/
	$defaults['enable_service']						= true;	
	$defaults['service_menu_title']					= esc_html__( 'Service','one-page-portfolio');
	$defaults['service_section_title']				= esc_html__( 'What I Do?','one-page-portfolio');
	$defaults['service_category']					= 0;
	$defaults['service_number']						= 4;

	/*****************************Portfolio Section **********************************/
	$defaults['enable_portfolio']					= true;
	$defaults['portfolio_bg_image']					= '';
	$defaults['portfolio_menu_title']				= esc_html__( 'Portfolio','one-page-portfolio');
	$defaults['portfolio_section_title']			= esc_html__( 'My Work','one-page-portfolio');
	$defaults['portfolio_category']					= 0;
	$defaults['portfolio_number']					= 4;


	/****************************************My Shop ********************************************/
	$defaults['enable_myshop']						= false;
	$defaults['myshop_bg_image']					= get_template_directory_uri() . '/assets/img/default-img.png';
	$defaults['myshop_menu_title']					= esc_html__( 'Shop','one-page-portfolio');
	$defaults['myshop_section_title']				= esc_html__( 'My Shop','one-page-portfolio');
	$defaults['myshop_page']						= 0;	

	/*****************************Testimonial Section **********************************/
	$defaults['enable_testimonial']					= true;
	$defaults['enable_partner']						= true;	
	$defaults['testimonial_menu_title']				= esc_html__( 'Testimonial','one-page-portfolio');
	$defaults['testimonial_section_title']			= esc_html__( 'My Clients','one-page-portfolio');
	$defaults['testimonial_category']				= 0;
	$defaults['testimonial_number']					= 4;
	$defaults['partner_title']						= esc_html__( 'Partner','one-page-portfolio');

	/***************************** Team Section **********************************/
	$defaults['enable_team']						= true;	
	$defaults['team_menu_title']					= esc_html__( 'Team','one-page-portfolio');
	$defaults['team_section_title']					= esc_html__( 'My Team','one-page-portfolio');
	$defaults['team_category']						= 0;
	$defaults['team_number']						= 4;

	/***************************** Blog Section **********************************/
	$defaults['enable_blog']						= true;	
	$defaults['blog_menu_title']					= esc_html__( 'Blog','one-page-portfolio');
	$defaults['blog_section_title']					= esc_html__( 'My Tips & Tricks','one-page-portfolio');
	$defaults['blog_category']						= 0;
	$defaults['blog_number']						= 4;	

	/***************************** Contact Section **********************************/
	$defaults['enable_contact']						= true;	
	$defaults['contact_menu_title']					= esc_html__( 'Contact','one-page-portfolio');
	$defaults['contact_section_title']				= esc_html__( 'Get in Touch','one-page-portfolio');	
	$defaults['contact_page']						= 0;
	$defaults['contact_callback_html']				= '';

	/******************************** General Section **************************************/
	$defaults['enable_author']						= true;
	$defaults['enable_posted_date']					= true;
	$defaults['pagination_option']					= 'default';
	$defaults['blog_content_option']				= 'excpert';

	/******************************** Footer Section **************************************/
	$defaults['enable_footer_social_menu']			= true;
	$defaults['social_menu_title']					= esc_html__( 'Follow Me','one-page-portfolio');	

	// Pass through filter.
	$defaults = apply_filters( 'rt_portfolio_filter_default_theme_options', $defaults );
	return $defaults;
}

endif;

function one_page_portfolio_customize_register( $wp_customize ) {


	$default = rt_portfolio_get_default_theme_options();
	

	/********************** My Shop Section. *************************************/
	$wp_customize->add_section('section_myshop', 
		array(    
		'title'       => esc_html__('My Shop Setting', 'one-page-portfolio'),
		'priority'    => 135,	
		'panel'       => 'home_option_panel'    
		)
	);

	// Enable My Shop Section
	$wp_customize->add_setting( 'theme_options[enable_myshop]',
		array(
			'default'           => $default['enable_myshop'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rt_portfolio_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'theme_options[enable_myshop]',
		array(
			'label'    => esc_html__( 'Enable My Shop Section', 'one-page-portfolio' ),
			'section'  => 'section_myshop',
			'type'     => 'checkbox',		
		)
	);


	// Menu Title
	$wp_customize->add_setting('theme_options[myshop_menu_title]', 
		array(
		'default'           => $default['myshop_menu_title'],
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control('theme_options[myshop_menu_title]', 
		array(
		'label'       => esc_html__('My Shop Menu Title', 'one-page-portfolio'),
		'section'     => 'section_myshop',   
		'settings'    => 'theme_options[myshop_menu_title]',		
		'type'        => 'text',
		)
	);

	// My Shop Section Title
	$wp_customize->add_setting('theme_options[myshop_section_title]', 
		array(
		'default'           => $default['myshop_section_title'],
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control('theme_options[myshop_section_title]', 
		array(
		'label'       => esc_html__('Section Title', 'one-page-portfolio'),
		'section'     => 'section_myshop',   
		'settings'    => 'theme_options[myshop_section_title]',		
		'type'        => 'text',
		)
	);
	// My Shop Page
	$wp_customize->add_setting('theme_options[myshop_page]', 
		array(
		'default'           => $default['myshop_page'],
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'rt_portfolio_sanitize_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[myshop_page]', 
		array(
		'label'       => esc_html__('Select Shop Page', 'one-page-portfolio'),	     
		'section'     => 'section_myshop',   
		'settings'    => 'theme_options[myshop_page]',		
		'type'        => 'dropdown-pages'
		)
	);	

		

}
add_action( 'customize_register', 'one_page_portfolio_customize_register' );