<?php
/**
 * One Page Portfolio functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package One_Page_Portfolio
 */

if ( ! function_exists( 'one_page_portfolio_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	function one_page_portfolio_setup() {

		load_child_theme_textdomain( 'one-page-portfolio' );

		// Declare WooCommerce Support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

endif;
add_action( 'after_setup_theme', 'one_page_portfolio_setup');


if ( ! function_exists( 'one_page_portfolio_enqueue_styles' ) ) :

	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function one_page_portfolio_enqueue_styles() {

		wp_enqueue_style( 'rt-portfolio-style', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'one-page-portfolio', get_stylesheet_uri(), array( 'rt-portfolio-style' ), '1.0.0' );

		//Responsive css
		wp_enqueue_style( 'rt-portfolio-responsive-parent', get_template_directory_uri() . '/assets/css/responsive.css' );

        wp_enqueue_script( 'one-page-portfolio-custom', get_stylesheet_directory_uri() . '/assets/js/custom-main.js', array( 'jquery' ), '20190104', true );		

		$enabled_sections 	= rt_portfolio_get_sections();
		$sections = array();

		foreach ($enabled_sections as $section ) {
			$sections[] = $section['id'];
		}
		
		wp_localize_script('rt-portfolio-custom', '	', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'anchors' => $sections,	
		));
			
	}

endif;

add_action( 'wp_enqueue_scripts', 'one_page_portfolio_enqueue_styles');

if ( ! function_exists( 'one_page_portfolio_is_woocommerce_active' ) ) :

	/**
	 * Check if WooCommerce is active.
	 *
	 * @since 1.0.0
	 *
	 * @return bool Active status.
	 */
	function one_page_portfolio_is_woocommerce_active() {
		$output = false;

		if ( class_exists( 'WooCommerce' ) ) {
			$output = true;
		}

		return $output;
	}

endif;

if ( ! function_exists( 'rt_portfolio_get_sections' ) ) :
    /**
     * Function to get Sections 
     */
    function rt_portfolio_get_sections(){
        $sections = array( 'home', 'aboutus','service','portfolio', 'myshop', 'testimonial','team','blog','contact'  );
        $enabled_section = array();
        foreach ( $sections as $section ){
            
            if ( true == rt_portfolio_get_option( 'enable_'.$section ) ) {
                $enabled_section[] = array(
                    'id' => $section,
                    'menu_text' => esc_html( rt_portfolio_get_option( $section . '_menu_title' ) ),
                );
            }
        }
        return $enabled_section;
    }
    
endif;

/**
 * Register the required plugins for this theme.
 * 
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function one_page_portfolio_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'      => esc_html__( 'Contact Form 7', 'one-page-portfolio' ), //The plugin name
            'slug'      => 'contact-form-7',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        
        array(
            'name'      => esc_html__( 'One Click Demo Import', 'one-page-portfolio' ), //The plugin name
            'slug'      => 'one-click-demo-import',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),   

        array(
            'name'      => esc_html__( 'Woocommerce', 'one-page-portfolio' ), //The plugin name
            'slug'      => 'woocommerce',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        
        array(
            'name'      => esc_html__( 'YITH WooCommerce Wishlist', 'one-page-portfolio' ), //The plugin name
            'slug'      => 'yith-woocommerce-wishlist',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        array(
            'name'      => esc_html__( 'YITH WooCommerce Quick View', 'one-page-portfolio' ), //The plugin name
            'slug'      => 'yith-woocommerce-quick-view',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),               
    );

    $config = array(
        'id'           => 'one-page-portfolio',        // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.     
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'one_page_portfolio_register_required_plugins' );



// Load Customizer Options.
require_once trailingslashit( get_stylesheet_directory() ) . '/inc/woocommerce.php';

// Load Customizer Options.
require_once trailingslashit( get_stylesheet_directory() ) . '/inc/customizer-inc.php';
