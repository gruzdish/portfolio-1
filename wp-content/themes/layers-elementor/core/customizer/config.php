<?php /**
 * Customizer Configuration File
 *
 * This file is used to define the different panels, sections and controls for Layers
 *
 * @package Layers
 * @since Layers 1.0.0
 */

class Layers_Customizer_Config {

	public $panels;

	public $default_panels;

	public $default_sections;

	public $sections;

	public $controls;
	
	public $partials;

	private static $instance; // stores singleton class

    /**
    *  Get Instance creates a singleton class that's cached to stop duplicate instances
    */
    public static function get_instance() {
        if ( ! self::$instance ) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    /**
    *  Construct empty on purpose
    */

    private function __construct() {}

    /**
    *  Init behaves like, and replaces, construct
    */

    public function init() {

		// Init and store panels
		$this->panels = $this->panels();

		// Init and store default_sections
		$this->default_panels = $this->default_panels();
		$this->default_sections = $this->default_sections();
		$this->default_controls = $this->default_controls();

		// Init and store sections
		$this->sections = $this->sections();

		// Init and store controls
		$this->controls = $this->controls();
		
		// Init the partials. They will fill later.
		$this->partials = array();
    }

	/**
	* Default WP Customiser Panels
	*
	* @return   array 			Panels to be registered in the customizer
	*/

	private function panels(){
		global $layers_customizer_panels;

		// Set intial config.
		$layers_customizer_panels = array(
            'site-settings' => array(
                'title' => __( 'Site Settings' , 'layerswp' ),
                'description' => __( 'Control your content\'s default layout.' , 'layerswp' ), // @TODO Put a helper here
                'priority' => 40
            ),

			'header' => array(
                'title' => __( 'Header' , 'layerswp' ),
                'description' => __( 'Control your header\'s logo, layout, colors and font.' , 'layerswp' ), // @TODO Put a helper here
                'priority' => 60
            ),

			'blog-archive-single' => array(
                'title' => __( 'Blog' , 'layerswp' ),
                'description' => __( 'Control your sites\'s sidebars and blog layout.' , 'layerswp' ), // @TODO Put a helper here
                'priority' => 70
            ),

			'footer' => array(
                'title' => __( 'Footer' , 'layerswp' ),
                'description' => __( 'Control your footer\'s custom text, widget areas and layout.' , 'layerswp' ), // @TODO Put a helper here
                'priority' => 80
            ),
		);

		return apply_filters( 'layers_customizer_panels', $layers_customizer_panels );
	}

	/**
	* Default WP Customiser Panels
	*
	* @return   array 			Panels to be registered in the customizer
	*/

	private function default_panels(){

		$default_panels = array();

		$default_panels[ 'nav_menus' ] = array(
			'priority' => 50,
		);

		return apply_filters( 'layers_customizer_default_panels', $default_panels );
	}

	/**
	* Layers Customiser Sections
	*
	* @return   array 			Sections to be registered in the customizer
	*/

	private function default_sections(){

		$default_sections = array();

		$default_sections[ 'title_tagline' ] = array(
			'title' => __( 'Logo &amp; Title' , 'layerswp' ),
			'panel' => 'site-settings'
		);

		$default_sections[ 'colors' ] = array(
			'panel' => 'site-settings',
			'priority' => 55,
		);

		$default_sections[ 'background_image' ] = array(
			'panel' => 'site-settings',
			'priority' => 55,
		);

		$default_sections[ 'static_front_page' ] = array(
			'panel' => 'site-settings',
		);

		return apply_filters( 'layers_customizer_default_sections', $default_sections );
	}

	/**
	* Default WP Customiser Controls
	*
	* @return   array Controls to be registered in the customizer
	*/

	private function default_controls(){

		$default_controls = array();

		$default_sections[ 'header_textcolor' ] = array(
			'section' => 'site-colors'
		);

		$default_sections[ 'background_color' ] = array(
			'section' => 'site-colors'
		);

		return apply_filters( 'layers_customizer_default_controls', $default_sections );
	}


	/**
	* Layers Customiser Sections
	*
	* @return array Sections to be registered in the customizer
	*/

	private function sections(){
		global $layers_customizer_sections;

		// Following default sections need to be added so our registration process can access them
		$layers_customizer_sections[ 'title_tagline' ] = array(
			'panel' => 'site-settings'
		);

		$layers_customizer_sections[ 'colors' ] = array(
			'panel' => 'site-settings',
		);

		$layers_customizer_sections[ 'background_image' ] = array(
			'panel' => 'site-settings',
		);

		$layers_customizer_sections[ 'static_front_page' ] = array(
			'panel' => 'site-settings',
		);

		// End default sections

		$layers_customizer_sections[ 'site-general' ] = array(
			'title' =>__( 'General' , 'layerswp' ),
			'panel' => 'site-settings',
			'priority' => 45,
		);

		$layers_customizer_sections[ 'site-scripts' ] = array(
			'title' =>__( 'Additional Scripts' , 'layerswp' ),
			'panel' => 'site-settings',
		);

		$layers_customizer_sections[ 'buttons'] = array(
			'title' => __( 'Buttons', 'layerswp' ),
			'panel' => 'site-settings',
		);

		$layers_customizer_sections[ 'site-colors' ] = array(
			'title' =>__( 'Colors' , 'layerswp' ),
			'panel' => 'site-settings',
			'priority' => 50,
		);

		$layers_customizer_sections[ 'fonts' ] = array(
			'title' =>__( 'Fonts' , 'layerswp' ),
			'panel' => 'site-settings',
			'priority' => 55,
		);

		$layers_customizer_sections[ 'dev-switches' ] = array(
			'title' =>__( 'Dev Switches', 'layerswp' ),
			'panel' => 'site-settings',
			'priority' => 100,
		);

		$layers_customizer_sections[ 'css' ] = array(
			'title' =>__( 'CSS' , 'layerswp' ),
		);

		$layers_customizer_sections[ 'header-layout' ] = array(
			'title' =>__( 'Styling' , 'layerswp' ),
			'panel' => 'header',
		);

		$layers_customizer_sections[ 'header-layout' ] = array(
			'title' =>__( 'Styling' , 'layerswp' ),
			'panel' => 'header',
		);

		$layers_customizer_sections[ 'header-menu-styling' ] = array(
			'title' =>__( 'Menu Styling' , 'layerswp' ),
			'panel' => 'header',
		);

		$layers_customizer_sections[ 'blog-styling' ] = array(
			'title' => __( 'Styling', 'layerswp' ),
			'panel' => 'blog-archive-single',
		);

		$layers_customizer_sections[ 'blog-archive' ] = array(
			'title' => __( 'Archive', 'layerswp' ),
			'panel' => 'blog-archive-single',
		);

		$layers_customizer_sections['blog-single' ] = array(
			'title' => __( 'Posts &amp; Pages', 'layerswp' ),
			'panel' => 'blog-archive-single',
		);

		$layers_customizer_sections['footer-layout' ] = array(
			'title' =>__( 'Styling' , 'layerswp' ),
			'panel' => 'footer',
		);

		$layers_customizer_sections['footer-text' ] = array(
			'title' =>__( 'Text' , 'layerswp' ),
			'panel' => 'footer',
		);

		$layers_customizer_sections['footer-scripts' ] = array(
			'title' =>__( 'Additional Scripts' , 'layerswp' ),
			'panel' => 'footer',
		);

		$layers_customizer_sections['woocommerce-sidebars' ] = array(
			'title' =>__( 'Sidebars' , 'layerswp' ),
			'panel' => 'woocommerce',
		);

		$layers_customizer_sections['body-customization' ] = array(
			'title' =>__( 'Customization' , 'layerswp' ),
			'panel' => 'body',
		);

		return apply_filters( 'layers_customizer_sections', $layers_customizer_sections );
	}

	private function controls(){

		global $layers_customizer_controls, $wp_version;



		$this->elementor_activation_link = layers_get_elementor_install_link();

		// Setup some folder variables
		$customizer_dir = '/core/customizer/';

		// Set intial config.
		$layers_customizer_controls = array();

		$layers_customizer_controls['title_tagline']['header-logo-size'] = array(
			'type'  => 'layers-select',
			'label' => __( 'Logo Size', 'layers-pro' ),
			'class' => 'group layers-push-top',
			'choices' => array(
				'' => __( 'Auto', 'layers-pro' ),
				'small' => __( 'Small', 'layers-pro' ),
				'medium' => __( 'Medium', 'layers-pro' ),
				'large' => __( 'Large', 'layers-pro' ),
				'massive' => __( 'Massive', 'layers-pro' ),
				'custom' => __( 'Custom', 'layers-pro' ),
			),
		);

		$layers_customizer_controls['title_tagline']['header-logo-size-custom'] = array(
			'type'  => 'layers-range',
			'label' => __( 'Logo Custom Size', 'layers-pro' ),
			'class' => 'group',
			'min' => 1,
			'max' => 200,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-header-logo-size",
				'show-if-value' => 'custom',
			),
		);

		$layers_customizer_controls['site-general'] = array(
			array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'General', 'layers-pro' ),
			),
			'enable-smooth-scroll' => array(
				'label' => __( 'Enable Smooth Scroll', 'layers-pro' ),
				'type' => 'layers-checkbox',
				'default' => FALSE
			),
			'enable-animations' => array(
				'label' => __( 'Enable Site Wide Animations', 'layers-pro' ),
				'type' => 'layers-checkbox',
				'default' => TRUE
			),
			'header-body-styling' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Styling', 'layers-pro' ),
				'class' => 'layers-push-top',
			),
			'body-background-color' => array(
				'label' => '',
				'subtitle' => __( 'Body Background', 'layers-pro' ),
				'description' => __( 'Body container background color', 'layers-pro' ),
				'type' => 'layers-color',
				'class' => 'group',
			),
			'site-accent-color' => array(
				'label' => '',
				'subtitle' => __( 'Site Accent Color', 'layerswp' ),
				'description' => __( 'Choose a color for your buttons and links.', 'layerswp' ),
				'type' => 'layers-color',
				'default' => FALSE,
				'class' => 'group',
			),
		);

		// Site Settings -> Fonts
		$layers_customizer_controls['fonts'] = array(
			'typekit-id' => array(
				'type' => 'layers-text',
				'label'    => __( 'Typekit ID' , 'layerswp' ),
				'description' => sprintf( __( 'For more information on obtaining your Typekit ID, <a href="%s" target="_blank">follow this link</a>.', 'layerswp' ), 'http://help.typekit.com/customer/portal/articles/6780' ),
			),
			'body-fonts' => array(
				'type' => 'layers-font',
				'label'    => __( 'Body' , 'layerswp' ),
				'selectors' => 'body',
				'choices' => layers_get_google_font_options(),
			),
			'heading-fonts' => array(
				'type' => 'layers-font',
				'label'    => __( 'Headings' , 'layerswp' ),
				'selectors' => 'h1,h2,h3,h4,h5,h6, .heading',
				'choices' => layers_get_google_font_options(),
			),
			'menu-fonts' => array(
				'type' => 'layers-font',
				'label'    => __( 'Header Menu' , 'layerswp' ),
				'selectors' => '.header-site nav.nav-horizontal .menu li',
				'choices' => layers_get_google_font_options(),
			),
			'form-fonts' => array(
				'type' => 'layers-font',
				'label'    => __( 'Buttons' , 'layerswp' ),
				'selectors' => 'button, .button, input[type=submit]',
				'choices' => layers_get_google_font_options(),
			),
		);

		// Site Settings -> Layout
		$layers_customizer_controls['header-layout'] = array(
			'header-menu-layout' => array(
				'type'     => 'layers-select-icons',
				'heading_divider' => __( 'Header Arrangement' , 'layerswp' ),
				'default' => 'header-logo-left',
				'choices' => array(
					'header-logo-left' => __( 'Logo Left' , 'layerswp' ),
					'header-logo-right' => __( 'Logo Right' , 'layerswp' ),
					'header-logo-center-top' => __( 'Logo Center Top' , 'layerswp' ),
					'header-logo-top' => __( 'Logo Top' , 'layerswp' ),
					'header-logo-center' => __( 'Logo Center' , 'layerswp' ),
					'header-sidebar' => __( 'Header Sidebar' , 'layerswp' ),
				),
			),
			'header-width' => array(
				'type'     => 'layers-select-icons',
				'heading_divider' => __( 'Header Width' , 'layerswp' ),
				'default' => 'layout-boxed',
				'choices' => array(
					'layout-boxed' => __( 'Boxed' , 'layerswp' ),
					'layout-fullwidth' => __( 'Full Width' , 'layerswp' ),
				),
				'linked'    => array(
  					'show-if-selector' => "#customize-control-layers-header-menu-layout",
  					'show-if-value' => 'header-sidebar',
  					'show-if-operator' => '!==',
  				),
			),
			'header-position-heading' => array(
				'type'  => 'layers-heading',
				'heading_divider' => __( 'Sticky Header' , 'layerswp' ),
				'linked'    => array(
  					'show-if-selector' => "#customize-control-layers-header-menu-layout",
  					'show-if-value' => 'header-sidebar',
  					'show-if-operator' => '!==',
  				),
			),
			'header-sticky' => array(
				'type'		=> 'layers-checkbox',
				'label'		=> __( 'Sticky' , 'layerswp' ),
				'class'		=> 'layers-pull-top layers-pull-bottom',
				'default'	=> FALSE,
				'linked'    => array(
  					'show-if-selector' => "#customize-control-layers-header-menu-layout",
  					'show-if-value' => 'header-sidebar',
  					'show-if-operator' => '!==',
  				),
			),
			'header-overlay' => array(
				'type'     => 'layers-checkbox',
				'label'    => __( 'Transparent Overlay' , 'layerswp' ),
				'default'	=> FALSE,
				'linked'    => array(
  					'show-if-selector' => "#customize-control-layers-header-menu-layout",
  					'show-if-value' => 'header-sidebar',
  					'show-if-operator' => '!==',
  				),
			),
			'header-search-heading' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Search', 'layers-pro' ),
				'class' => 'layers-push-top',
			),
			'header-search-active' => array(
				'label' => __( 'Show Search' , 'layers-pro' ),
				'type' => 'layers-checkbox',
			),
			'header-search-label' => array(
				'label' => __( 'Search Label' , 'layers-pro' ),
				'type' => 'layers-text',
				'linked' => array(
					'show-if-selector' => '#layers-header-search-active',
					'show-if-value' => 'true',
				)
			),
			'header-styling-heading' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Header Styling', 'layers-pro' ),
				'description' => __( 'Control the visual styling of your header elements. Go here to <a class="customizer-link" href="#accordion-section-title_tagline">change logo size</a>.', 'layers-pro' ),
				'class' => 'layers-push-top',
			),
			'header-height' => array(
				'type'   => 'layers-range',
				'label'  => __( 'Header Padding', 'layers-pro' ),
				'class' => 'group',
				'placeholder' => 0,
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'header-background-color' => array(
				'label' => '',
				'subtitle' => __( 'Background Color' , 'layers-pro' ),
				'type' => 'layers-color',
				'default' => '#F3F3F3',
				'class' => 'group',
			),
			'header-background-image' => array(
				'label' => __( 'Background Image', 'layers-pro' ),
				'type' => 'layers-select-images',
				'class' => 'group',
			),
			'header-background-repeat' => array(
				'label' => __( 'Repeat', 'layers-pro' ),
				'type' => 'layers-select',
				'class' => 'group',
				'default' => 'no-repeat',
				'choices' => array(
					'no-repeat' => __( 'No Repeat', 'layers-pro' ),
					'repeat' => __( 'Repeat', 'layers-pro' ),
					'repeat-x' => __( 'Repeat Horizontal', 'layers-pro' ),
					'repeat-y' => __( 'Repeat Vertical', 'layers-pro' )
				),
				'linked' => array(
					'show-if-selector' => '#layers-header-background-image',
					'show-if-value' => '',
					'show-if-operator' => '!==',
				)
			),
			'header-background-position' => array(
				'label' => __( 'Position', 'layers-pro' ),
				'type' => 'layers-select',
				'class' => 'group',
				'default' => 'center',
				'choices' => array(
					'center' => __( 'Center', 'layers-pro' ),
					'top' => __( 'Top', 'layers-pro' ),
					'bottom' => __( 'Bottom', 'layers-pro' ),
					'left' => __( 'Left', 'layers-pro' ),
					'right' => __( 'Right', 'layers-pro' )
				),
				'linked' => array(
					'show-if-selector' => '#layers-header-background-image',
					'show-if-value' => '',
					'show-if-operator' => '!==',
				)
			),
			'header-background-size' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Stretch', 'layers-pro' ),
				'default' => TRUE,
				'class' => 'group',
				'linked' => array(
					'show-if-selector' => '#layers-header-background-image',
					'show-if-value' => '',
					'show-if-operator' => '!==',
				)
			),
			'header-sticky-breakpoint' => array(
				'type'  => 'layers-range',
				'label' => __( 'Sticky Breakpoint (px)' , 'layers-pro' ),
				'description' => __( 'At what point in the scroll down does your header start sticking.' , 'layers-pro' ),
				'class' => 'group',
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'placeholder' => 270,
				'linked' => array(
					'show-if-selector' => '#layers-header-sticky',
					'show-if-value' => 'true',
				),
			),
			'header-title-styling-heading' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Page Title Styling', 'layers-pro' ),
				'description' => __( 'Page titles appear on list pages and pages using the "Blank Page" template they also include breadcrumb navigation.', 'layers-pro' ),
				'class' => 'layers-push-top',
			),
			'title-background-color' => array(
				'label' => '',
				'subtitle' => __( 'Title Background', 'layers-pro' ),
				'type' => 'layers-color',
				'class' => 'group',
			),

			'title-background-image' => array(
				'label' => __( 'Background Image', 'layers-pro' ),
				'type' => 'layers-select-images',
				'class' => 'group',
			),
			'title-background-repeat' => array(
				'label' => __( 'Repeat', 'layers-pro' ),
				'type' => 'layers-select',
				'class' => 'group',
				'default' => 'no-repeat',
				'choices' => array(
					'no-repeat' => __( 'No Repeat', 'layers-pro' ),
					'repeat' => __( 'Repeat', 'layers-pro' ),
					'repeat-x' => __( 'Repeat Horizontal', 'layers-pro' ),
					'repeat-y' => __( 'Repeat Vertical', 'layers-pro' )
				),
				'linked' => array(
					'show-if-selector' => '#layers-title-background-image',
					'show-if-value' => '',
					'show-if-operator' => '!==',
				)
			),
			'title-background-position' => array(
				'label' => __( 'Position', 'layers-pro' ),
				'type' => 'layers-select',
				'class' => 'group',
				'default' => 'center',
				'choices' => array(
					'center' => __( 'Center', 'layers-pro' ),
					'top' => __( 'Top', 'layers-pro' ),
					'bottom' => __( 'Bottom', 'layers-pro' ),
					'left' => __( 'Left', 'layers-pro' ),
					'right' => __( 'Right', 'layers-pro' )
				),
				'linked' => array(
					'show-if-selector' => '#layers-title-background-image',
					'show-if-value' => '',
					'show-if-operator' => '!==',
				)
			),
			'title-background-size' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Stretch', 'layers-pro' ),
				'default' => TRUE,
				'class' => 'group',
				'linked' => array(
					'show-if-selector' => '#layers-title-background-image',
					'show-if-value' => '',
					'show-if-operator' => '!==',
				)
			),
			'header-title-sticky-breakpoint' => array(
				'type'  => 'layers-range',
				'label' => __( 'Sticky Breakpoint (px)' , 'layers-pro' ),
				'description' => __( 'At what point in the scroll down does your header start sticking.' , 'layers-pro' ),
				'class' => 'group',
				'min' => 0,
				'max' => 500,
				'step' => 1,
				'placeholder' => 270,
				'linked' => array(
					'show-if-selector' => '#layers-header-title-sticky',
					'show-if-value' => 'true',
				),
			),
			'section-title-heading-color' => array(
				'label' => '',
				'subtitle' => __( 'Title', 'layers-pro' ),
				'description' => __( 'Text color of your page title', 'layers-pro' ),
				'type' => 'layers-color', //#323232
				'class' => 'group',
			),
			'section-title-excerpt-color' => array(
				'label' => '',
				'subtitle' => __( 'Excerpt', 'layers-pro' ),
				'description' => __( 'Text color of your page description', 'layers-pro' ),
				'type' => 'layers-color', // #323232
				'class' => 'group',
			),
			'header-title-height' => array(
				'type'   => 'layers-range',
				'label'  => __( 'Title Height', 'layers-pro' ),
				'class' => 'group',
				'min' => 20,
				'max' => 200,
				'step' => 1,
				'placeholder' => 20,
			),
			'header-title-spacing-after' => array(
				'type'  => 'layers-range',
				'label' => __( 'Title Below Spacing (px)', 'layers-pro' ),
				'class' => 'group',
				'min' => 0,
				'max' => 300,
				'step' => 1,
				'placeholder' => 0,
			),
		);


		$layers_customizer_controls['blog-styling'] = array(

			'blog-colors-heading' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Blog Colors', 'layers-pro' ),
				'description' => __( 'Customize the various colors of your blog. Make sure you switch to the blog so you can see your changes live.', 'layers-pro' ),
				'class' => 'layers-push-bottom',
			),
			'story-title-color' => array(
				'label' => '',
				'subtitle' => __( 'Titles', 'layers-pro' ),
				'description' => __( 'Post Title Colors', 'layers-pro' ),
				'type' => 'layers-color',
				'class' => 'group',
			),
			'story-link-color' => array(
				'label' => '',
				'subtitle' => __( 'Story Link', 'layers-pro' ),
				'description' => __( 'Link colors in posts', 'layers-pro' ),
				'type' => 'layers-color',
				'class' => 'group',
			),
			'sidebar-well-color' => array(
				'label' => '',
				'subtitle' => __( 'Sidebar Background', 'layers-pro' ),
				'type' => 'layers-color',
				'default' => '#FFFFFF',
				'class' => 'group',
			),
			'story-meta-color' => array(
				'label' => '',
				'subtitle' => __( 'Post Meta', 'layers-pro' ),
				'type' => 'layers-color',
				'class' => 'group',
			),
		);

		// Site Settings -> Sidebars
		$layers_customizer_controls['blog-single'] = array(
			'single-sidebar-heading' => array(
				'type'  => 'layers-heading',
				'label'    => __( 'Single Post Sidebar(s)' , 'layerswp' ),
				'description' => __( 'This option affects your single post pages.' , 'layerswp' ),
			),
			'single-left-sidebar' => array(
				'type'      => 'layers-checkbox',
				'label'     => __( 'Display Left Sidebar' , 'layerswp' ),
				'default'   => FALSE,
			),
			'single-right-sidebar' => array(
				'type'      => 'layers-checkbox',
				'label'     => __( 'Display Right Sidebar' , 'layerswp' ),
				'default'   => TRUE,
			),
			'single-heading-styling' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Post Meta', 'layers-pro' ),
				'description' => __( 'These settings allow you to choose what meta to display on a single blog page.', 'layers-pro' ),
			),
			'single-featured-image' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Featured Image', 'layers-pro' ),
				'default' => 'yes',
			),
			'single-post-meta-date' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Date', 'layers-pro' ),
				'default' => 'yes',
			),
			'single-post-meta-author' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Author', 'layers-pro' ),
				'default' => 'yes',
			),
			'single-post-meta-categories' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Categories', 'layers-pro' ),
				'default' => 'yes',
			),
			'single-post-meta-tags' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Tags', 'layers-pro' ),
				'default' => 'yes',
			),
		);

		$layers_customizer_controls['blog-archive'] = array(
			'archive-sidebar-heading' => array(
				'type'  => 'layers-heading',
				'label'    => __( 'Archive Sidebar(s)' , 'layerswp' ),
				'description' => __( 'This option affects your category, tag, author and search pages.' , 'layerswp' ),
			),
			'archive-left-sidebar' => array(
				'type'		=> 'layers-checkbox',
				'label' 	=> __( 'Display Left Sidebar' , 'layerswp' ),
				'default' 	=> FALSE,
			),
			'archive-right-sidebar' => array(
				'type'		=> 'layers-checkbox',
				'label' 	=> __( 'Display Right Sidebar' , 'layerswp' ),
				'default' 	=> TRUE,
			),
			'archive-heading-styling' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Layout &amp; Post Meta', 'layers-pro' ),
				'description' => __( 'These settings allow you to choose what meta to display on a single blog page.', 'layers-pro' ),
			),
			'archive-featured-image' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Featured Image', 'layers-pro' ),
				'default' => 'yes',
			),
			'archive-post-meta-date' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Date', 'layers-pro' ),
				'default' => 'yes',
			),
			'archive-post-meta-author' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Author', 'layers-pro' ),
				'default' => 'yes',
			),
			'archive-post-meta-categories' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Categories', 'layers-pro' ),
				'default' => 'yes',
			),
			'archive-post-meta-tags' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Tags', 'layers-pro' ),
				'default' => 'yes',
			),
			'archive-excerpt' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( 'Excerpt', 'layers-pro' ),
				'default' => 'true',
			),
			'archive-excerpt-length' => array(
				'type'   => 'layers-number',
				'label'  => __( 'Excerpt Length (word count)', 'layers-pro' ),
				'default' => 50,
				'linked' => array(
					'show-if-selector' => "#layers-archive-excerpt",
					'show-if-value' => 'true',
				),
			),
			'archive-read-more-button' => array(
				'type'   => 'layers-checkbox',
				'label'  => __( "'Read More' Button", 'layers-pro' ),
				'default' => 'yes',
			),
			'archive-read-more-button-text' => array(
				'type'   => 'layers-text',
				'label'  => __( "'Read More' Button Text", 'layers-pro' ),
				'default' => 'Read More',
				'linked' => array(
					'show-if-selector' => "#layers-archive-read-more-button",
					'show-if-value' => 'true',
				),
			),
		);


		$layers_customizer_controls['site-scripts'] = array(
			'open-graph-support' => array(
				'type'     => 'layers-checkbox',
				'label'    => __( 'Open Graph Support' , 'layerswp' ),
				'description' => __( 'Enable Open Graph support for rich Facebook and Twitter sharing.' , 'layerswp' ),
				'default' => TRUE,
			),
			'google-maps-api' => array(
				'type'     => 'layers-text',
				'label'    => __( 'Google Maps API Key' , 'layerswp' ),
				'description' => __( sprintf( 'Enter in your Maps API Key to enable your contact widget. <a href="%s" target="_blank">Click Here</a> to get your API Key.', 'https://developers.google.com/maps/documentation/javascript/get-api-key' ), 'layerswp' ),
				'default' => '',
			),
			'header-custom-scripts' => array(
				'type'     => 'layers-code',
				'label'    => __( 'Custom Header Scripts' , 'layerswp' ),
				'description' => __( 'Enter in any custom script to include in your site\'s header. Be sure to use double quotes for strings.' , 'layerswp' ),
				'default' => '',
			),
			'footer-custom-scripts' => array(
				'type'     => 'layers-code',
				'label'    => __( 'Custom Footer Scripts' , 'layerswp' ),
				'description' => __( 'Enter in any custom script to include in your site\'s footer. Be sure to use double quotes for strings.' , 'layerswp' ),
				'default' => '',
			),
		);

		// Footer -> Layout
		$layers_customizer_controls['footer-layout'] = array(
			'footer-width' => array(
				'type'     => 'layers-select-icons',
				'heading_divider' => __( 'Footer Width' , 'layerswp' ),
				'default' => 'layout-boxed',
				'choices' => array(
					'layout-boxed' => __( 'Boxed' , 'layerswp' ),
					'layout-fullwidth' => __( 'Full Width' , 'layerswp' ),
				),
			),
			'footer-sidebar-count' => array(
				'type'     => 'layers-select',
				'heading_divider'    => __( 'Widget Areas' , 'layerswp' ),
				'description' => __( 'Choose how many widget areas apear in the footer. Go here to <a class="customizer-link" href="#accordion-panel-widgets">customize footer widgets</a>.', 'layerswp' ),
				'default' => 4,
				'sanitize_callback' => 'layers_sanitize_number',
				'choices' => array(
					'0' => __( 'None' , 'layerswp' ),
					'1' => __( '1' , 'layerswp' ),
					'2' => __( '2' , 'layerswp' ),
					'3' => __( '3' , 'layerswp' ),
					'4' => __( '4' , 'layerswp' ),
				),
			),
			'footer-copyright-text' => array(
				'type'     => 'layers-text',
				'label'    => __( 'Copyright Text' , 'layerswp' ),
				'default' => ' Made at the tip of Africa. &copy;',
				'sanitize_callback' => FALSE
			),
			'footer-styling' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Styling', 'layers-pro' ),
				'class' => 'layers-push-top',
			),
			'footer-background-color' => array(
				'label' => '',
				'subtitle' => __( 'Footer Background' , 'layers-pro' ),
				'type' => 'layers-color',
				'default' => '#F3F3F3',
				'class' => 'group',
			),
			'footer-height' => array(
				'type'   => 'layers-range',
				'label'  => __( 'Footer Padding', 'layers-pro' ),
				'class' => 'group layers-push-bottom-small',
				'placeholder' => 40,
				'min' => 0,
				'max' => 250,
				'step' => 1,
			),
		);

		// Header > Menu Styling


		$layers_customizer_controls['header-menu-styling'] = array(
			/**
			 * -- Menu Styling Goes Here ----------
			 */
			'menu-heading' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Header Menu Styling', 'layers-pro' ),
				'description' => __( 'This will affect the menus which display in the header', 'layers-pro' ), // @TODO
				// 'class' => 'layers-push-top',
			),
			/**
			 * Text
			 */
			'menu-text-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Text Color', 'layers-pro' ),
				'class' => 'group',
			),
			'menu-text-shadow' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Shadow', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'none' => __( 'None', 'layers-pro' ),
					'bottom' => __( 'Bottom Shadow', 'layers-pro' ),
					'top' => __( 'Top Shadow', 'layers-pro' ),
				),
			),
			'menu-text-transform' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Transform', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'' => __( 'Normal', 'layers-pro' ),
					'uppercase' => __( 'Uppercase', 'layers-pro' ),
					'capitalize' => __( 'Capitalize', 'layers-pro' ),
					'lowercase' => __( 'Lowercase', 'layers-pro' ),
				),
			),
			'menu-item-spacing' => array(
				'type'  => 'layers-range',
				'label' => __( 'Link Spacing', 'layers-pro' ),
				'class' => 'group',
				'colspan'  => 3,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'placeholder' => 10,
			),
			'menu-hover-toggle' => array(
				'type'  => 'layers-checkbox',
				'label' => __( 'Enable Hover Styling', 'layers-pro' ),
				'class' => 'group',
			),
			'menu-hover-heading' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Header Menu Hover Styling', 'layers-pro' ),
				'description' => __( 'This will affect header menu items when hovered over or active', 'layers-pro' ), // @TODO
				'class' => 'layers-push-top',
				'linked'    => array(
						'show-if-selector' => "#layers-menu-hover-toggle",
						'show-if-value' => 'true',
				),
			),
			'menu-hover-text-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Text Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-menu-hover-toggle",
						'show-if-value' => 'true',
				),
			),
			'menu-hover-text-shadow' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Shadow', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'none' => __( 'None', 'layers-pro' ),
					'bottom' => __( 'Bottom Shadow', 'layers-pro' ),
					'top' => __( 'Top Shadow', 'layers-pro' ),
				),
				'linked'    => array(
						'show-if-selector' => "#layers-menu-hover-toggle",
						'show-if-value' => 'true',
				),
			),
			/**
			 * Background & Borders
			 */
			'menu-hover-background-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Background Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-menu-hover-toggle",
						'show-if-value' => 'true',
				),
			),
			'menu-hover-border-radius' => array(
				'type' => 'layers-range',
				'label' => __( 'Rounded Corner Size', 'layers-pro' ),
				'class' => 'group',
				'default' => 4,
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'linked'    => array(
						'show-if-selector' => "#layers-menu-hover-toggle",
						'show-if-value' => 'true',
				),
			),
			/**
			 * Border
			 */
			'menu-hover-border-width' => array(
				'type' => 'layers-range',
				'label' => __( 'Border Width', 'layers-pro' ),
				'class' => 'group layers-push-top-small',
				'min' => '0',
				'max' => '10',
				'step' => '1',
				'placeholder' => '0',
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-menu-hover-toggle",
						'show-if-value' => 'true',
				),
			),
			'menu-hover-border-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Border Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-menu-hover-toggle",
						'show-if-value' => 'true',
				),
			),

			'submenu-primary-heading' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Sub Menu Styling', 'layers-pro' ),
				'description' => __( 'This will affect menu drop-downs', 'layers-pro' ), // @TODO
				'class' => 'layers-push-top',
			),
			/**
			 * Text
			 */
			'submenu-text-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Text Color', 'layers-pro' ),
				'class' => 'group',
			),
			'submenu-text-shadow' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Shadow', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'none' => __( 'None', 'layers-pro' ),
					'bottom' => __( 'Bottom Shadow', 'layers-pro' ),
					'top' => __( 'Top Shadow', 'layers-pro' ),
				),
			),
			'submenu-text-transform' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Transform', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'' => __( 'Normal', 'layers-pro' ),
					'uppercase' => __( 'Uppercase', 'layers-pro' ),
					'capitalize' => __( 'Capitalize', 'layers-pro' ),
					'lowercase' => __( 'Lowercase', 'layers-pro' ),
				),
			),
			/**
			 * Background & Borders
			 */
			'submenu-background-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Background Color', 'layers-pro' ),
				'class' => 'group',
			),
			/**
			 * Border
			 */
			'submenu-border-width' => array(
				'type' => 'layers-range',
				'label' => __( 'Border Width', 'layers-pro' ),
				'class' => 'group layers-push-top-small',
				'min' => '0',
				'max' => '10',
				'step' => '1',
				'placeholder' => '0',
				'class' => 'group',
			),
			'submenu-border-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Border Color', 'layers-pro' ),
				'class' => 'group',
			),
			'submenu-separate-border-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Separator Border Color', 'layers-pro' ),
				'class' => 'group',
			),
		);

		// Site Settings > Buttons		

		$layers_customizer_controls['buttons'] = array(
			/**
			 * -- Primary Buttons (White/Light Backgrounds) ----------
			 */
			'buttons-primary-heading-primary' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Primary Buttons', 'layers-pro' ),
				'description' => __( 'Buttons apearing on light backgrounds (eg white).', 'layers-pro' ), // @TODO
				'class' => '',
			),
			/**
			 * Background
			 */
			'buttons-primary-background-style' => array(
				'type'  => 'layers-select',
				'label' => __( 'Background Style', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'' => '-- Choose --',
					'solid' => __( 'Solid', 'layers-pro' ),
					'transparent' => __( 'Transparent', 'layers-pro' ),
					'gradient' => __( 'Gradient', 'layers-pro' ),
				),
				'default'  => 'solid',
			),
			'buttons-primary-background-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Background Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-buttons-primary-background-style",
						'show-if-value' => 'solid',
				),
			),
			'buttons-primary-background-gradient-start-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Gradient Start Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-buttons-primary-background-style",
						'show-if-value' => 'gradient',
				),
			),
			'buttons-primary-background-gradient-end-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Gradient End Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-buttons-primary-background-style",
						'show-if-value' => 'gradient',
				),
			),
			'buttons-primary-background-gradient-direction' => array(
				'type' => 'layers-range',
				'label' => __( 'Gradient Angle', 'layers-pro' ),
				'class' => 'group',
				'default' => 0,
				'min' => '0',
				'max' => '360',
				'step' => '1',
				'linked'    => array(
						'show-if-selector' => "#layers-buttons-primary-background-style",
						'show-if-value' => 'gradient',
				),
			),
			/**
			 * Text
			 */
			'buttons-primary-text-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Text Color', 'layers-pro' ),
				'class' => 'group layers-push-top-small',
			),
			'buttons-primary-text-shadow' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Shadow', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'' => '-- Choose --',
					'none' => __( 'None', 'layers-pro' ),
					'bottom' => __( 'Bottom Shadow', 'layers-pro' ),
					'top' => __( 'Top Shadow', 'layers-pro' ),
				),
			),
			'buttons-primary-text-transform' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Transform', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					// '' => __( 'Normal', 'layers-pro' ),
					'' => '-- Choose --',
					'uppercase' => __( 'Uppercase', 'layers-pro' ),
					'capitalize' => __( 'Capitalize', 'layers-pro' ),
					'lowercase' => __( 'Lowercase', 'layers-pro' ),
				),
			),
			/**
			 * Border
			 */
			'buttons-primary-border-width' => array(
				'type' => 'layers-range',
				'label' => __( 'Border Width', 'layers-pro' ),
				'class' => 'group layers-push-top-small',
				'default' => 0,
				'min' => '0',
				'max' => '10',
				'step' => '1',
			),
			'buttons-primary-border-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Border Color', 'layers-pro' ),
				'class' => 'group',
			),
			/**
			 * Styling
			 */
			'buttons-primary-border-radius' => array(
				'type' => 'layers-range',
				'label' => __( 'Rounded Corner Size', 'layers-pro' ),
				'class' => 'group layers-push-top-small',
				'default' => 4,
				'min' => '0',
				'max' => '100',
				'step' => '1',
			),
			'buttons-primary-shadow' => array(
				'type' => 'layers-select',
				'label' => __( 'Button Shadow', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'' => '-- Choose --',
					'none' => __( 'None', 'layers-pro' ),
					'small' => __( 'Small', 'layers-pro' ),
					'medium' => __( 'Medium', 'layers-pro' ),
					'large' => __( 'Large', 'layers-pro' ),
				),
			),
			/**
			 * -- Secondary Secondry (White/Light Backgrounds) ----------
			 */
			'buttons-secondary-heading-primary' => array(
				'type' => 'layers-heading',
				'heading_divider' => __( 'Secondary Buttons', 'layers-pro' ),
				'description' => __( 'Buttons apearing on dark backgrounds (eg black).', 'layers-pro' ),
				'class' => 'layers-push-top',
			),
			/**
			 * Background
			 */
			'buttons-secondary-background-style' => array(
				'type'  => 'layers-select',
				'label' => __( 'Background Style', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'' => '-- Choose --',
					'solid' => __( 'Solid', 'layers-pro' ),
					'transparent' => __( 'Transparent', 'layers-pro' ),
					'gradient' => __( 'Gradient', 'layers-pro' ),
				),
				'default'  => 'solid',
			),
			'buttons-secondary-background-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Background Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-buttons-secondary-background-style",
						'show-if-value' => 'solid',
				),
			),
			'buttons-secondary-background-gradient-start-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Gradient Start Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-buttons-secondary-background-style",
						'show-if-value' => 'gradient',
				),
			),
			'buttons-secondary-background-gradient-end-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Gradient End Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-buttons-secondary-background-style",
						'show-if-value' => 'gradient',
				),
			),
			'buttons-secondary-background-gradient-direction' => array(
				'type' => 'layers-range',
				'label' => __( 'Gradient Angle', 'layers-pro' ),
				'class' => 'group',
				'default' => 0,
				'min' => '0',
				'max' => '360',
				'step' => '1',
				'linked'    => array(
						'show-if-selector' => "#layers-buttons-secondary-background-style",
						'show-if-value' => 'gradient',
				),
			),
			/**
			 * Text
			 */
			'buttons-secondary-text-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Text Color', 'layers-pro' ),
				'class' => 'group layers-push-top-small',
			),
			'buttons-secondary-text-shadow' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Shadow', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'' => '-- Choose --',
					'none' => __( 'None', 'layers-pro' ),
					'bottom' => __( 'Bottom Shadow', 'layers-pro' ),
					'top' => __( 'Top Shadow', 'layers-pro' ),
				),
			),
			'buttons-secondary-text-transform' => array(
				'type' => 'layers-select',
				'label' => __( 'Text Transform', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					// '' => __( 'Normal', 'layers-pro' ),
					'' => '-- Choose --',
					'uppercase' => __( 'Uppercase', 'layers-pro' ),
					'capitalize' => __( 'Capitalize', 'layers-pro' ),
					'lowercase' => __( 'Lowercase', 'layers-pro' ),
				),
			),
			/**
			 * Border
			 */
			'buttons-secondary-border-width' => array(
				'type' => 'layers-range',
				'label' => __( 'Border Width', 'layers-pro' ),
				'class' => 'group layers-push-top-small',
				'default' => 0,
				'min' => '0',
				'max' => '10',
				'step' => '1',
			),
			'buttons-secondary-border-color' => array(
				'type' => 'layers-color',
				'label' => __( 'Border Color', 'layers-pro' ),
				'class' => 'group',
			),
			/**
			 * Styling
			 */
			'buttons-secondary-border-radius' => array(
				'type' => 'layers-range',
				'label' => __( 'Rounded Corner Size', 'layers-pro' ),
				'class' => 'group layers-push-top-small',
				'default' => 0,
				'min' => '0',
				'max' => '100',
				'step' => '1',
			),
			'buttons-secondary-shadow' => array(
				'type' => 'layers-select',
				'label' => __( 'Button Shadow', 'layers-pro' ),
				'class' => 'group',
				'choices' => array(
					'' => '-- Choose --',
					'none' => __( 'None', 'layers-pro' ),
					'small' => __( 'Small', 'layers-pro' ),
					'medium' => __( 'Medium', 'layers-pro' ),
					'large' => __( 'Large', 'layers-pro' ),
				),
			),
		);

		if( class_exists( 'WooCommerce' ) ) {
			$layers_customizer_controls[ 'woocommerce-sidebars' ] = array(
				'label-sidebar-single' => array(
					'type'  => 'layers-heading',
					'label'    => __( 'Single Product Sidebar(s)' , 'layerswp' ),
					'description' => __( 'This option affects your single product pages.' , 'layerswp' ),
				),
				'single-left-woocommerce-sidebar' => array(
					'type'      => 'layers-checkbox',
					'label'     => __( 'Display Left Sidebar' , 'layerswp' ),
					'default'   => FALSE,
				),
				'single-right-woocommerce-sidebar' => array(
					'type'      => 'layers-checkbox',
					'label'     => __( 'Display Right Sidebar' , 'layerswp' ),
					'default'   => TRUE,
				),
				'label-sidebar-archive' => array(
					'type'  => 'layers-heading',
					'label'    => __( 'Product List Sidebar(s)' , 'layerswp' ),
					'description' => __( 'This option affects your shop page, product category and product tag pages.' , 'layerswp' ),
				),
				'archive-left-woocommerce-sidebar' => array(
					'type'      => 'layers-checkbox',
					'label'     => __( 'Display Left Sidebar' , 'layerswp' ),
					'default'   => FALSE,
				),
				'archive-right-woocommerce-sidebar' => array(
					'type'      => 'layers-checkbox',
					'label'     => __( 'Display Right Sidebar' , 'layerswp' ),
					'default'   => TRUE,
				),
			);
		} // if WooCommerce

		/*
		* Layers Pro Upsells
		*/

		if( !class_exists( 'Elementor\Plugin' ) ){
			$elementor_activation_details = array(
				'type'  => 'layers-heading',
				'class' => 'layers-upsell-tag',
				'label'    => $this->elementor_activation_link['label'],
				'description' => '<p>Looking for the page builder?<br />Join 1,000,000+ Professionals Who Build Better Sites With Elementor.
					</p>
					<a class="button btn-primary" target="_blank" href="' . $this->elementor_activation_link['url'] . '">' . $this->elementor_activation_link['label'] . '</a>',
			);
			$layers_customizer_controls['title_tagline']['logo-elementor-upsell'] = $elementor_activation_details;
			$layers_customizer_controls['blog-styling']['archive-elementor-upsell'] = $elementor_activation_details;
			$layers_customizer_controls['blog-archive']['archive-elementor-upsell'] = $elementor_activation_details;
			$layers_customizer_controls['blog-single']['single-elementor-upsell'] = $elementor_activation_details;
			$layers_customizer_controls['fonts']['font-elementor-upsell'] = $elementor_activation_details;
			$layers_customizer_controls[ 'woocommerce-sidebars' ]['woocommerce-elementor-upsell'] = $elementor_activation_details;
			
			$layers_customizer_controls = layers_insert_config_elements_before( 'header-menu-layout', $layers_customizer_controls, array( 'header-elementor-upsell' => $elementor_activation_details ) );
			
			$layers_customizer_controls = layers_insert_config_elements_before( 'menu-heading', $layers_customizer_controls, array( 'header-elementor-upsell' => $elementor_activation_details ) );


			$layers_customizer_controls = layers_insert_config_elements_before( 'footer-width', $layers_customizer_controls, array( 'footer-elementor-upsell' => $elementor_activation_details ) );
		} else if( !class_exists( 'ElementorPro\Plugin' ) && FALSE == $this->elementor_activation_link[ 'pro_exists' ] ){
			
			$layers_customizer_controls['title_tagline']['logo-elementor-upsell'] = array(
				'type'  => 'layers-heading',
				'class' => 'layers-upsell-tag',
				'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
				'description' => __( 'Want to control every single elment of your header?<br /><a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=Header">Elementor Pro</a> lets you create completely custom headers.' , 'layerswp' ),
			);

			$layers_customizer_controls['blog-styling']['single-elementor-upsell'] = array(
				'type'  => 'layers-heading',
				'class' => 'layers-upsell-tag',
				'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
				'description' => __( 'Do you want to create completely custom archive and single pages? <a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=Blog%Styling">Elementor Pro</a> is the tool you need.' , 'layerswp' ),
			);

			$layers_customizer_controls['blog-archive']['archive-elementor-upsell'] = array(
				'type'  => 'layers-heading',
				'class' => 'layers-upsell-tag',
				'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
				'description' => __( 'Do you want to create completely custom archive and single pages? <a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=Blog%20Archive">Elementor Pro</a> is the tool you need.' , 'layerswp' ),
			);

			$layers_customizer_controls['blog-single']['single-elementor-upsell'] = array(
				'type'  => 'layers-heading',
				'class' => 'layers-upsell-tag',
				'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
				'description' => __( 'Do you want to create completely custom archive and single pages? <a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=Blog%Single">Elementor Pro</a> is the tool you need.' , 'layerswp' ),
			);

			$layers_customizer_controls['fonts']['font-elementor-upsell'] = array(
				'type'  => 'layers-heading',
				'class' => 'layers-upsell-tag',
				'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
				'description' => __( 'Create completely custom page layouts and have full control over your site\'s fonts <a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=Fonts"> with Elementor Pro</a>.' , 'layerswp' ),
			);

			
			$layers_customizer_controls[ 'woocommerce-sidebars' ]['woocommerce-elementor-upsell'] = array(
				'type'  => 'layers-heading',
				'class' => 'layers-upsell-tag',
				'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
				'description' => __( 'Create completely custom WooCommerce pages with <a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=WooCommerce"> with Elementor Pro</a>.' , 'layerswp' ),
			);
			
			$layers_customizer_controls = layers_insert_config_elements_before(
				'header-menu-layout',
				$layers_customizer_controls,
				array(
					'header-elementor-upsell' => array(
						'type'  => 'layers-heading',
						'class' => 'layers-upsell-tag',
						'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
						'description' => __( 'Want to control every single elment of your header?<br /><a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=Header%20Menu">Elementor Pro</a> lets you create completely custom headers.' , 'layerswp' ),
					)
				)
			);
			
			$layers_customizer_controls = layers_insert_config_elements_before(
				'menu-heading',
				$layers_customizer_controls,
				array(
					'header-elementor-upsell' => array(
						'type'  => 'layers-heading',
						'class' => 'layers-upsell-tag',
						'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
						'description' => __( 'Want to control every single elment of your header?<br /><a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=Menu%20Styling">Elementor Pro</a> lets you create completely custom headers.' , 'layerswp' ),
					)
				)
			);


			$layers_customizer_controls = layers_insert_config_elements_before(
				'footer-width',
				$layers_customizer_controls,
				array(
					'footer-elementor-upsell' => array(
						'type'  => 'layers-heading',
						'class' => 'layers-upsell-tag',
						'label'    => __( 'Get Elementor Pro' , 'layerswp' ),
						'description' => __( 'Want to control every single elment of your footer?<br /><a target="_blank" href="https://elementor.com/?utm_source=layers%20theme&utm_medium=link&utm_campaign=Layers%20Upsell&utm_content=Footer%20Layout">Elementor Pro</a> lets you create completely custom footer.' , 'layerswp' ),
					)
				)
			);
			
		}

		do_action( 'layers_customizer_controls_modify' );

		$layers_customizer_controls = apply_filters( 'layers_customizer_controls', $layers_customizer_controls );

		$layers_customizer_controls = $this->apply_defaults( $layers_customizer_controls );

		return $layers_customizer_controls;
	}

	private function apply_defaults( $controls ){

		$defaults = apply_filters( 'layers_customizer_control_defaults' , array() );

		if( empty( $defaults ) ) return $controls;

		foreach( $controls as $section_key => $control ){

			foreach( $control as $control_key => $control_data ) {
				if( isset( $defaults[ $control_key ] ) ){
					$controls[ $section_key ][ $control_key ][ 'default' ] = $defaults[ $control_key ];
				}
			}
		}

		return $controls;
	}
}