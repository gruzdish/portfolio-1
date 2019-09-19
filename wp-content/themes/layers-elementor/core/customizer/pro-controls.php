<?php
/**
 * Pro Controls
 *
 * This file is used to configure the Controls in the Customizer.
 *
 * @package Layers
 * @since Layers 1.0
 */

class Layers_Pro_Controls {

	private static $instance;

	/**
	 * Get Instance creates a singleton class that's cached to stop duplicate instances
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
			self::$instance->init();
		}
		return self::$instance;
	}

	/**
	 * Construct empty on purpose
	 */
	private function __construct() {}

	/**
	 * Init behaves like, and replaces, construct
	 */
	public function init(){

		// Add Customizer Panel
		add_filter( 'layers_customizer_panels', array( $this, 'modify_customizer_panels' ), 60 );

		// Add Customizer Section
		add_filter( 'layers_customizer_sections', array( $this, 'modify_customizer_sections' ), 60 );

		// Add Customizer Control
		add_filter( 'layers_customizer_controls', array( $this, 'modify_customizer_controls' ), 60 );

		// Apply Customizations
		add_action( 'wp_enqueue_scripts', array( $this, 'apply_customizer_customizations' ), 60 );

		// Apply Featured Image Settings
		add_filter( 'layers_post_featured_media', array( $this, 'apply_featured_image_settings' ) );

		// Apply Meta Display Settings
		add_filter( 'layers_post_meta_display', array( $this, 'apply_meta_display_settings' ) );

		// Modify Read More Buttons Text.
		add_action( 'layers_read_more_text', array( $this, 'layers_read_more_text' ) );

		// Modify Header Class according to the Logo size
		add_filter( 'layers_header_class', array( $this, 'header_class' ) );
		add_filter( 'layers_title_container_class', array( $this, 'title_container_class' ) );

		// Modify Comment Display
		add_filter( 'comments_template', array( $this, 'comments' ) );

		// Apply Localizations to Scripts.
		add_action( 'layers_sticky_header_breakpoint', array( $this, 'apply_sticky_header_breakpoint' ) );

		// Add 'layers-pro-active' to the body class when active.
		add_filter( 'layers_body_class', array( $this, 'body_class' ) );

		// Add Search to Header.
		add_action( 'layers_after_header_nav' , array( $this, 'add_search_button' ), 25 );
		add_filter( 'layers_after_footer', array( $this, 'render_search_interface' ) );
		// add_filter( 'wp_nav_menu_items', array( $this, 'add_search_menu_item' ), 90, 2 ); // OLD

		// ---------- Disable other conflicting color applications -----------

		// Remove application of colors by Layers.
		add_action( 'init', array( $this, 'remove_layers_colors' ) );

		// Disable ColorKit if it is also activated.
		add_action( 'init', array( $this, 'disable_colorkit' ) );
	}

	/**
	* Remove application of colors by Layers.
	*/
	public function remove_layers_colors() {
		remove_action( 'wp_enqueue_scripts', 'layers_apply_customizer_styles', 50 );
		remove_action( 'wp_enqueue_scripts', 'layers_apply_customizer_styles', 100 ); // Legacy - Layers used to hook this to 100
	}

	/**
	 * Disable ColorKit if it is also activated.
	 */
	public function disable_colorkit() {

		// Bail if ColorKit is not active.
		if ( ! class_exists( 'Layers_Controls_ColorKit' ) ) return;

		// Get the instance of the ColorKit class.
		$layers_colorkit = Layers_Controls_ColorKit::get_instance();

		// Remove all Colorkit functionality by removing all it's actions & filters.
		remove_filter( 'layers_customizer_panels', array( $layers_colorkit, 'modify_customizer_panels' ) );
		remove_filter( 'layers_customizer_sections', array( $layers_colorkit, 'modify_customizer_sections' ) );
		remove_filter( 'layers_customizer_controls', array( $layers_colorkit, 'modify_customizer_controls' ) );
		remove_action( 'wp_enqueue_scripts', array( $layers_colorkit, 'apply_customizer_customizations' ), 90 );

		// Display notice if ColorKit is running
		add_action( 'admin_notices', array( $this, 'colorkit_disabled_admin_notice' ) );
	}

	/**
	 * Disable ColorKit admin Notice.
	 */
	public function colorkit_disabled_admin_notice() {
		global $pagenow;
		if ( 'plugins.php' == $pagenow ) {
			?>
			<div class="updated">
				<p><?php _e( '<strong>Layers Pro</strong> has replaced <strong>ColorKit</strong> - it has the same color controls, plus a whole lot more. <strong>Please disable and remove ColorKit</strong>.', 'layers-pro' ); ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Add Customizer Panel
	 */
	public function modify_customizer_panels( $panels ) {

		return $panels;
	}

	/**
	 * Add Customizer Section
	 */
	public function modify_customizer_sections( $sections ) {

		$sections['buttons'] = array(
			'title' => __( 'Buttons', 'layers-pro' ),
			'panel' => 'site-settings',
		);

		$sections = layers_insert_config_elements_before(
			'blog-archive',
			$sections,
			array( 'blog-styling' =>
				array(
					'title' => __( 'Styling', 'layers-pro' ),
					'panel' => 'blog-archive-single',
				)
			)
		);

		// Remove the old color sections - it has no controls left in it.
		// unset( $sections['site-colors'] );

		return $sections;
	}

	/**
	 * Add Customizer Controls
	 */
	public function modify_customizer_controls( $controls ){


		$controls = layers_remove_config_element( 'site-color-heading', $controls );
		$controls = layers_remove_config_element( 'site-accent-color', $controls );

		return $controls;
	}

	/**
	 * Apply Customizations
	 */
	function apply_customizer_customizations() {

		$bg_color = layers_get_theme_mod( 'body-background-color', FALSE );

		if( '' != $bg_color ) {

			layers_inline_styles("
				.wrapper-content {
					background-color: $bg_color;
				}
			");
		}

		/**
		 * Menu Styling
		 */

		$primary_menu_a = '.header-site.invert .nav-horizontal > ul > li > a, .header-site .nav-horizontal > ul > li > a, .header-search a';
		$primary_menu_li = '.header-site.invert .nav-horizontal > ul > li, .header-site .nav-horizontal > ul > li';
		$primary_menu_a_hover = '.header-site.invert .nav-horizontal > ul > li:hover > a, .header-site .nav-horizontal > ul > li:hover > a';
		$primary_menu_li_hover = '.header-site.invert .nav-horizontal > ul > li:hover, .header-site .nav-horizontal > ul > li:hover';

		$primary_menu_style = array();
		$primary_menu_li_style = array();
		$primary_menu_hover_style = array();


		// Prep: Menu Text Colors
		$menu_text_color = layers_get_theme_mod( 'menu-text-color' );
		if( $menu_text_color ){
			$primary_menu_style[ 'color' ] = $menu_text_color;
			if( !layers_get_theme_mod( 'menu-hover-text-color' ) )
				$primary_menu_hover_style[ 'color' ] = layers_too_light_then_dark( $menu_text_color );
		}

		$menu_text_shadow = layers_get_theme_mod( 'menu-text-shadow' );
		if ( 'top' == $menu_text_shadow ) {
			$primary_menu_style[ 'text-shadow' ] = '0 -1px rgba(0,0,0,0.3)';
		} else if ( 'bottom' == $menu_text_shadow ) {
			$primary_menu_style[ 'text-shadow' ] = '0 1px rgba(0,0,0,0.3)';
		}

		$menu_text_transform = layers_get_theme_mod( 'menu-text-transform' );
		if( $menu_text_transform ) {
			$primary_menu_style[ 'text-transform' ] = $menu_text_transform;
		}

		/**
		 * Menu Hover Styling
		 */

		$menu_hover_text_color = layers_get_theme_mod( 'menu-hover-text-color' );
		if( $menu_hover_text_color ){
			$primary_menu_hover_style[ 'color' ] = $menu_hover_text_color;
		}

		$menu_hover_text_shadow = layers_get_theme_mod( 'menu-hover-text-shadow' );
		if ( 'top' == $menu_hover_text_shadow ) {
			$primary_menu_hover_style[ 'text-shadow' ] = '0 -1px rgba(0,0,0,0.3)';
		} else if ( 'bottom' == $menu_hover_text_shadow ) {
			$primary_menu_hover_style[ 'text-shadow' ] = '0 1px rgba(0,0,0,0.3)';
		}

		$menu_hover_border_radius = layers_get_theme_mod( 'menu-hover-border-radius' );
		if( $menu_hover_border_radius ) {
			$primary_menu_style[ 'border-radius' ] = $menu_hover_border_radius . 'px';
		}

		$menu_hover_background_color = layers_get_theme_mod( 'menu-hover-background-color' );
		if( $menu_hover_background_color ) {
			$primary_menu_hover_style[ 'background-color' ] = $menu_hover_background_color;
		}

		$menu_hover_border_width = layers_get_theme_mod( 'menu-hover-border-width' );
		if( $menu_hover_border_width ) {
			$primary_menu_style[ 'border-width' ] = $menu_hover_border_width .'px';
			$primary_menu_style[ 'border-style' ] = 'solid';
			$primary_menu_style[ 'border-color' ] = 'transparent';
		}

		$menu_hover_border_color = layers_get_theme_mod( 'menu-hover-border-color' );
		if( $menu_hover_border_color ) {
			$primary_menu_hover_style[ 'border-color' ] = $menu_hover_border_color;
		}


		/**
		 * Apply the Main Menu Styling
		 */
		if( !empty( $primary_menu_hover_style ) ) {

			if( version_compare( LAYERS_VERSION, '1.2.11', '<' ) && ( $menu_hover_background_color || 0 > $menu_hover_border_width ) ){

				$less_padding = array(
					'header-logo-center',
					'header-logo-left',
					'header-logo-right',
				);


				if( in_array( layers_get_theme_mod( 'header-menu-layout' ) , $less_padding ) ) {
					$primary_menu_style[ 'padding' ] = '0px 10px';
				} else {
					$primary_menu_style[ 'padding' ] = '4px 8px';
				}
				$primary_menu_li_style[ 'margin' ] = '0px 6px;';
				layers_inline_styles( $primary_menu_li, array( 'css' => $primary_menu_li_style ) );
			}

			layers_inline_styles( $primary_menu_a_hover, array( 'css' => $primary_menu_hover_style ) );
		}

		if( !empty( $primary_menu_style ) ) {
			layers_inline_styles( $primary_menu_a, array( 'css' => $primary_menu_style ) );
		}

		$sub_menu = '.header-site.invert .sub-menu, .header-site .sub-menu';
		$sub_menu_text = '.header-site.invert .sub-menu li a, .header-site .sub-menu li a';
		$sub_menu_text_hover = '.header-site.invert .sub-menu li:hover a, .header-site .sub-menu li:hover a';
		$sub_menu_li = '.header-site.invert .sub-menu li, .header-site .sub-menu li';
		$sub_menu_li_hover = '.header-site.invert .sub-menu li:hover, .header-site .sub-menu li:hover';

		$submenu_style = array();
		$submenu_text_style = array();
		$submenu_text_hover_style = array();
		$submenu_li_style = array();

		$submenu_text_color = layers_get_theme_mod( 'submenu-text-color' );
		if( $submenu_text_color ){
			$submenu_text_style[ 'color' ] = $submenu_text_color;
			$submenu_text_hover_style[ 'color' ] = layers_too_light_then_dark( $submenu_text_color );
		}
		$submenu_text_shadow = layers_get_theme_mod( 'submenu-text-shadow' );
		if ( 'top' == $submenu_text_shadow ) {
			$submenu_text_style[ 'text-shadow' ] = '0 -1px rgba(0,0,0,0.3)';
		} else if ( 'bottom' == $submenu_text_shadow ) {
			$submenu_text_style[ 'text-shadow' ] = '0 1px rgba(0,0,0,0.3)';
		}
		$submenu_text_transform = layers_get_theme_mod( 'submenu-text-transform' );
		if( $submenu_text_transform ){
			$submenu_text_style[ 'text-transform' ] = $submenu_text_transform;
		}
		$submenu_background_color = layers_get_theme_mod( 'submenu-background-color' );
		if( $submenu_background_color ) {
			$submenu_text_style[ 'background-color' ] = $submenu_background_color;
			$submenu_text_hover_style[ 'background-color' ] = layers_too_light_then_dark( $submenu_background_color );
		}

		$submenu_border_width = layers_get_theme_mod( 'submenu-border-width' );
		$submenu_border_color = layers_get_theme_mod( 'submenu-border-color' );
		if( $submenu_border_width ) {
			$submenu_style[ 'border-width' ] = $submenu_border_width . 'px';
			$submenu_style[ 'border-color' ] = $submenu_border_color;
		}

		$submenu_separator_border_color = layers_get_theme_mod( 'submenu-separate-border-color' );
		if( $submenu_separator_border_color ) {
			$submenu_li_style[ 'border-color' ] = $submenu_separator_border_color;
		}

		/**
		 * Apply the Sub Menu Styling
		 */
		if( !empty( $submenu_style ) ) {
			layers_inline_styles( $sub_menu, array( 'css' => $submenu_style ) );
		}
		if( !empty( $submenu_text_style ) ) {
			layers_inline_styles( $sub_menu_text, array( 'css' => $submenu_text_style ) );
			layers_inline_styles( $sub_menu_text_hover, array( 'css' => $submenu_text_hover_style ) );
		}
		if( !empty( $submenu_li_style ) ) {
			layers_inline_styles( $sub_menu_li, array( 'css' => $submenu_li_style ) );
		}

		/**
		 * Apply Button Styling
		 */

		// Primary Buttons
		layers_pro_apply_control_button_styling( 'buttons-primary', array(
			'input[type="button"]',
			'input[type="submit"]',
			'button',
			'.button',
			'.form-submit input[type="submit"]',
		) );

		// Secondary Buttons
		layers_pro_apply_control_button_styling( 'buttons-secondary', array(
			'.invert input[type="button"]',
			'.invert input[type="submit"]',
			'.invert button',
			'.invert .button',
			'.invert .form-submit input[type="submit"]',
		) );


		/**
		 * Header - Top & Bottom Padding
		 */
		// if ( layers_get_theme_mod( 'header-outer-padding-top') || layers_get_theme_mod( 'header-outer-padding-bottom') ) {
		if ( FALSE ) {

			// Set intial.
			$padding_top    = NULL;
			$padding_bottom = NULL;

			// Get Values.
			if ( layers_get_theme_mod( 'header-outer-padding-top' ) ) {
				$padding_top = layers_get_theme_mod( 'header-outer-padding-top');
			}
			if ( layers_get_theme_mod( 'header-outer-padding-bottom' ) ) {
				$padding_bottom = layers_get_theme_mod( 'header-outer-padding-bottom');
			}

			// Apply Styles.
			layers_inline_styles( '.header-site', array( 'css' => array(
				'padding-top'    => "{$padding_top}px",
				'padding-bottom' => "{$padding_bottom}px",
			) ) );
		}

		/**
		 * Header - Height
		 */
		if ( layers_get_theme_mod( 'header-height') ) {

			// Get Values.
			$padding = ( layers_get_theme_mod( 'header-height') );

			// Apply Styles.
			layers_inline_styles( "
				@media only screen and ( min-width: 769px ) {
					.header-site:not( .is_stuck ) {
						padding-top    : {$padding}px ;
						padding-bottom : {$padding}px ;
					}
				}
			" );
		}

		/**
		 * Header - Link Spacing
		 */
		if ( is_numeric( layers_get_theme_mod( 'menu-item-spacing') ) ) {

			// Get Values.
			$spacing = layers_get_theme_mod( 'menu-item-spacing');

			// Apply Styles.
			layers_inline_styles( '.header-site .nav-horizontal > ul > li', array( 'css' => array(
				'margin-left'    => "{$spacing}px",
				'margin-right' => "{$spacing}px",
			) ) );
		}

		/**
		 * Header - Logo Size
		 */
		$size = layers_get_theme_mod( 'header-logo-size');
		$max_height = layers_get_theme_mod( 'header-logo-size-custom');
		if ( 'custom' === $size && '' !== $max_height ) {

			// Apply Styles.
			layers_inline_styles( '.custom-logo-link img, .site-logo-link img, .mark img', array( 'css' => array(
				'width' => 'auto',
				'max-height'    => "{$max_height}px",
			) ) );
		}

		/**
		 * Footer - Top & Bottom Padding
		 */
		//if ( layers_get_theme_mod( 'footer-outer-padding-top') || layers_get_theme_mod( 'footer-outer-padding-bottom') ) {
		if ( FALSE ) {

			// Set intial.
			$padding_top    = NULL;
			$padding_bottom = NULL;

			// Get Values.
			if ( layers_get_theme_mod( 'footer-outer-padding-top' ) ) {
				$padding_top = layers_get_theme_mod( 'footer-outer-padding-top');
			}
			if ( layers_get_theme_mod( 'footer-outer-padding-bottom' ) ) {
				$padding_bottom = layers_get_theme_mod( 'footer-outer-padding-bottom');
			}

			// Apply Styles.
			layers_inline_styles( "
				.footer-site > .container > .row:first-child {
					padding-top : {$padding_top}px ;
					padding-bottom : {$padding_bottom}px ;
				}
			" );
		}

		/**
		 * Footer - Height
		 */
		if ( layers_get_theme_mod( 'footer-height') ) {

			// Get Values.
			$padding_top = layers_get_theme_mod( 'footer-height' );
			$padding_bottom = layers_get_theme_mod( 'footer-height' );

			// Apply Styles.
			layers_inline_styles( "
				@media only screen and ( min-width: 769px ) {
					.footer-site > .container > .row:first-child {
						padding-top : {$padding_top}px ;
						padding-bottom : {$padding_bottom}px ;
					}
				}
			" );
		}

		/**
		 * Header Title - Height
		 */
		if ( layers_get_theme_mod( 'header-title-height') ) {

			// Get Values.
			$padding_top = layers_get_theme_mod( 'header-title-height');
			$padding_bottom = ( layers_get_theme_mod( 'header-title-height') ) / 2;


			// Apply Styles.
			layers_inline_styles( "
				@media only screen and ( min-width: 769px ) {
					.title-container .title {
						padding-top : {$padding_top}px ;
						padding-bottom : {$padding_bottom}px ;
					}
				}
			" );
		}

		/**
		 * Header Title - Bottom Spacing
		 */
		if ( layers_get_theme_mod( 'header-title-spacing-after') ) {

			// Set intial.
			$spacing = NULL;

			// Get Values.
			if ( layers_get_theme_mod( 'header-title-spacing-after') ) {
				$spacing = layers_get_theme_mod( 'header-title-spacing-after');
			}

			// Apply Styles.
			layers_inline_styles( '.title-container', array( 'css' => array(
				'margin-bottom'    => "{$spacing}px",
			) ) );
		}

		/**
		 * Archive Excerpt
		 */
		if ( ! (BOOL) layers_get_theme_mod( 'archive-excerpt' ) ) {
			remove_action( 'layers_list_post_content', 'layers_excerpt_action' );
		}

		/**
		 * Archive Excerpt - Length
		 */
		if ( layers_get_theme_mod( 'archive-excerpt' ) && 0 < layers_get_theme_mod( 'archive-excerpt-length' ) ) {
			$this->apply_excerpt_length();
		}

		/**
		 * Archive Read More Buttons - On/Off
		 */
		if ( ! (BOOL) layers_get_theme_mod( 'archive-read-more-button') ) {
			remove_action( 'layers_list_read_more', 'layers_read_more_action' );
		}

		/**
		* Header Background
		*/
		$css = array();

		// Background Color
		$header_color = layers_get_theme_mod( 'header-background-color', FALSE );
		if ( '' != $header_color ) {
			$css['background-color'] = $header_color;
		}

		// Background Image
		$header_image = layers_get_theme_mod( 'header-background-image', FALSE );
		if ( '' != $header_image ) {
			$header_image = wp_get_attachment_image_src( $header_image, 'full' );
			$header_image = $header_image[0];
			$css['background-image'] = "url( '$header_image' )";
			$css['background-repeat'] = layers_get_theme_mod( 'header-background-repeat' );
			$css['background-position'] = layers_get_theme_mod( 'header-background-position' );
			if ( 1 == layers_get_theme_mod( 'header-background-size' ) ) $css['background-size'] = 'cover';
		}

		// Apply Background Styling
		layers_inline_styles( '.header-site, .header-site.header-sticky', array( 'css' => $css ) );

		// Apply Background class-name
		if ( isset( $css['background-color'] ) ) {
			layers_maybe_set_invert( $css['background-color'], 'layers_header_class' );
		}

		/**
		* Footer Colors
		*/
		$footer_color = layers_get_theme_mod( 'footer-background-color', FALSE );
		if( '' != $footer_color ) {
			layers_inline_styles("
				.footer-site {
					background-color: $footer_color;
				}
			");
			layers_maybe_set_invert( $footer_color, 'layers_footer_site_class' );
		}

		/**
		 * Title Container
		 */
		$title_background_color = layers_get_theme_mod( 'title-background-color', TRUE );
		if( '' != $title_background_color ) {
			layers_inline_styles("
				.title-container {
					background-color: $title_background_color;
				}
			");
			layers_maybe_set_invert( $title_background_color, 'layers_title_container_class' );
		}


		// Background Image
		$title_image = layers_get_theme_mod( 'title-background-image', FALSE );
		if ( '' != $title_image ) {
			$title_image = wp_get_attachment_image_src( $title_image, 'full' );
			$title_image = $title_image[0];
			$css['background-image'] = "url( '$title_image' )";
			$css['background-repeat'] = layers_get_theme_mod( 'title-background-repeat' );
			$css['background-position'] = layers_get_theme_mod( 'title-background-position' );
			if ( 1 == layers_get_theme_mod( 'title-background-size' ) ) $css['background-size'] = 'cover';

			layers_inline_styles( '.title-container', array( 'css' => $css ) );
		}

		/**
		 * Section Title - Headings
		 */
		$section_title_heading_color = layers_get_theme_mod( 'section-title-heading-color', TRUE );
		$section_title_heading_color_hover = layers_too_light_then_dark( $section_title_heading_color );
		if( '' != $section_title_heading_color ) {
			layers_inline_styles("
				.title-container .title .heading,
				nav.bread-crumbs a {
					color: $section_title_heading_color;
				}
			");
			layers_inline_styles("
				nav.bread-crumbs a:hover,
				nav.bread-crumbs li {
					color: $section_title_heading_color_hover;
				}
			");
		}

		/**
		 * Section Title - Excerpt
		 */
		$section_title_excerpt_color = layers_get_theme_mod( 'section-title-excerpt-color', TRUE );
		if( '' != $section_title_excerpt_color ) {
			layers_inline_styles("
				.title-container .title div.excerpt {
					color: $section_title_excerpt_color;
				}
			");
		}

		/**
		 * Content - Links
		 */
		$story_link_color = layers_get_theme_mod( 'story-link-color', TRUE );
		$story_link_color_hover = layers_too_light_then_dark( $story_link_color );
		if( '' != $story_link_color ) {
			layers_inline_styles("
				.copy a:not(.button),
				.story a:not(.button) {
					color: $story_link_color;
					border-bottom-color: $story_link_color;
				}
			");
			layers_inline_styles("
				.copy a:not(.button):hover,
				.story a:not(.button):hover {
					color: $story_link_color_hover;
					border-bottom-color: $story_link_color_hover;
				}
			");
		}

		/**
		 * Content Titles
		 */
		$story_title_color = layers_get_theme_mod( 'story-title-color', TRUE );
		$story_title_color_hover = layers_too_light_then_dark( $story_title_color );
		if( '' != $story_title_color ) {
			layers_inline_styles("
				.type-post header.section-title .heading,
				.type-post header.section-title .heading a,
				.type-page header.section-title .heading,
				.type-page header.section-title .heading a,
				.heading.comment-title,
				.heading.comment-title a,
				.comment-reply-title,
				.comment-reply-title a {
					color: $story_title_color;
				}
			");
			layers_inline_styles("
				.type-post header.section-title .heading a:hover,
				.type-page header.section-title .heading a:hover,
				.heading.comment-title a:hover,
				.comment-reply-title .heading a:hover {
					color: $story_title_color_hover;
				}
			");
		}

		/**
		 * Sidebar Well
		 */
		$sidebar_well_color = layers_get_theme_mod( 'sidebar-well-color', TRUE );
		if( '' != $sidebar_well_color ) {
			layers_inline_styles("
				.sidebar .well {
					background-color: $sidebar_well_color;
				}
			");
			layers_maybe_set_invert( $sidebar_well_color, 'layers_body_sidebar_class' );
			layers_maybe_set_invert( $sidebar_well_color, 'layers_left_sidebar_class' );
			layers_maybe_set_invert( $sidebar_well_color, 'layers_right_sidebar_class' );
			layers_maybe_set_invert( $sidebar_well_color, 'layers_left_woocommerce_sidebar_class' );
			layers_maybe_set_invert( $sidebar_well_color, 'layers_right_woocommerce_sidebar_class' );
		}

		/**
		 * Post Meta Color
		 */
		$meta_color = layers_get_theme_mod( 'story-meta-color', TRUE );
		if( '' != $meta_color ) {
			layers_inline_styles("
				.type-post .meta-info,
				.type-page .meta-info,
				.type-post .meta-info a,
				.type-page .meta-info a {
					color: $meta_color;
				}
			");
		}

		/**
		 * Comments
		 */

		$comment_background_color = layers_get_theme_mod( 'comments-background-color', TRUE );
		$comment_indent_background_color = 'rgba(' . implode( ', ' , layers_hex2rgb( $comment_background_color ) ) . ', .15 )';
		if( '' != $comment_background_color ) {
			layers_inline_styles( "
				.comment-list > .comment.well,
				.comment-list > .comment-respond {
					background-color: $comment_background_color;
				}
			");
			layers_maybe_set_invert( $comment_background_color, 'layers_comment_list_class' );
		}

	}

	public function apply_featured_image_settings( $string ){

		if ( is_singular() )
			$option_key = 'single';
		else
			$option_key = 'archive';

		if ( ! ( BOOL ) layers_get_theme_mod( $option_key . '-featured-image' ) ) {
			$string = '';
		}

		return $string;
	}

	public function apply_meta_display_settings( $display_array ){

		if ( is_singular() )
			$option_key = 'single';
		else
			$option_key = 'archive';

		$meta = array(
			'date',
			'author',
			'categories',
			'tags',
		);

		foreach( $meta as $meta_key ){
			if ( ! ( BOOL ) layers_get_theme_mod( $option_key . '-post-meta-' . $meta_key ) )
				$display_array = array_diff( $display_array, array( $meta_key ) );
		}

		return $display_array;
	}

	function apply_excerpt_length(){

		if( !function_exists( 'layers_get_theme_mod' ) ) return;

		if( is_archive() || layers_is_post_list_template() )
			add_action( 'excerpt_length', array( $this, 'layers_excerpt_length' ) );
	}

	/**
	 * Archive Excerpt - Length
	 */
	function layers_excerpt_length( $length ) {

		if( !function_exists( 'layers_get_theme_mod' ) ) return $length;

		// Only apply to the archive page
		return layers_get_theme_mod( 'archive-excerpt-length' );
	}

	/**
	* Read More Buttons - Text
	*/
	public function layers_read_more_text( $text ) {

		if( !function_exists( 'layers_get_theme_mod' ) ) return $text;
		if( '' != layers_get_theme_mod( 'archive-read-more-button-text' ) )
			return layers_get_theme_mod( 'archive-read-more-button-text' );
		else
			return $text;
	}

	/**
	* Body Class
	*/
	public function body_class( $classes ){
		$classes[] = 'layers-pro-active';

		if( TRUE == layers_get_theme_mod( 'enable-animations' ) ){
            $classes[] = 'layers-animate';
            $classes[] = 'opacity-0';
        }

		return $classes;
	}

	/**
	* Header Class
	*/
	public function header_class( $classes ){
		$size = layers_get_theme_mod( 'header-logo-size');
		
		if( FALSE !== $size ){
			$classes[] = 'layers-logo-' . $size;
		}

		return $classes;
	}

	/**
	* Title Container Class
	*/
	public function title_container_class( $classes ){

		return $classes;
	}

	/**
	* Comment Display
	*/
	function comments( $file ){

		if( is_page() && ! ( BOOL ) layers_get_theme_mod( 'single-page-comments' ) ) {
			$file = dirname( __FILE__ ) . '/../includes/empty.php';
		}

		if( is_single() && ! ( BOOL ) layers_get_theme_mod( 'single-post-comments' ) ) {
			$file = dirname( __FILE__ ) . '/../includes/empty.php';
		}

		return $file;
	}

	/**
	* Apply Header Sticky Breakpoint.
	*/
	function apply_sticky_header_breakpoint( $breakpoint ) {

		if ( layers_get_theme_mod( 'header-sticky-breakpoint') ) {
			return layers_get_theme_mod( 'header-sticky-breakpoint');
		}

		return $breakpoint;
	}

	/**
	* Search Button
	*/
	function add_search_button(){

		if ( layers_get_theme_mod( 'header-search-active' ) ) {
			?>
			<div class="header-search">
				<a href="#">
					<i class="l-search"></i>
				</a>
			</div>
			<?php
		}
	}

	/**
	* Search Button
	*/
	function add_search_menu_item( $items, $args ) {

		if ( layers_get_theme_mod( 'header-search-active' ) ) {
			ob_start();
			?>
			<li class="menu-item menu-item-type-search menui-item-layers-search">
				<a href="#">
					<i class="l-search"></i>
				</a>
			</li>
			<?php
			$items .= ob_get_clean();
		}

		return $items;
	}

	/**
	* Search Interface
	*/
	function render_search_interface() {
		?>
		<div class="search-interface-overlay">
			<form role="search" method="get" class="search-interface-holder" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="search-text">
					<?php if( layers_get_theme_mod( 'header-search-label') ) {
						echo layers_get_theme_mod( 'header-search-label');
					} else {
						_e( 'Search:', 'layers-pro' );
					} ?>
				</label>
				<input
					type="text"
					id="layers-modal-search-field"
					class="search-field"
					placeholder="<?php _e( 'Type Something', 'layers-pro' ); ?>"
					value="<?php if ( isset( $_GET['s'] ) ) echo esc_attr( $_GET['s'] ); ?>"
					name="s"
					title="<?php _e( 'Search for:', 'layers-pro' ); ?>"
					autocomplete="off"
					autocapitalize="off"
				>
			</form>
			<a href="#" class="search-close">
				<i class="l-close"></i>
			</a>
		</div>
		<?php
	}

}

// Initialize
Layers_Pro_Controls::get_instance();
