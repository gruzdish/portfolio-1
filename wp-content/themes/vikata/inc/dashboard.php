<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'vikata_create_menu' ) ) {
	add_action( 'admin_menu', 'vikata_create_menu' );
	/**
	 * Adds our "Vikata" dashboard menu item
	 *
	 */
	function vikata_create_menu() {
		$vikata_page = add_theme_page( 'Vikata', 'Vikata', apply_filters( 'vikata_dashboard_page_capability', 'edit_theme_options' ), 'vikata-options', 'vikata_settings_page' );
		add_action( "admin_print_styles-$vikata_page", 'vikata_options_styles' );
	}
}

if ( ! function_exists( 'vikata_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the Vikata dashboard page
	 *
	 */
	function vikata_options_styles() {
		wp_enqueue_style( 'vikata-options', get_template_directory_uri() . '/css/admin/admin-style.css', array(), VIKATA_VERSION );
	}
}

if ( ! function_exists( 'vikata_settings_page' ) ) {
	/**
	 * Builds the content of our Vikata dashboard page
	 *
	 */
	function vikata_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="vikata-masthead clearfix">
					<div class="vikata-container">
						<div class="vikata-title">
							<a href="<?php echo esc_url(VIKATA_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Vikata', 'vikata' ); ?></a> <span class="vikata-version"><?php echo esc_html( VIKATA_VERSION ); ?></span>
						</div>
						<div class="vikata-masthead-links">
							<?php if ( ! defined( 'VIKATA_PREMIUM_VERSION' ) ) : ?>
								<a class="vikata-masthead-links-bold" href="<?php echo esc_url(VIKATA_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Premium', 'vikata' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(VIKATA_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'vikata' ); ?></a>
                            <a href="<?php echo esc_url(VIKATA_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'vikata' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * vikata_dashboard_after_header hook.
				 *
				 */
				 do_action( 'vikata_dashboard_after_header' );
				 ?>

				<div class="vikata-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * vikata_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'vikata_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'vikata-settings-group' ); ?>
									<?php do_settings_sections( 'vikata-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="vikata_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'vikata' )
										);
										?>
									</div>

									<?php
									/**
									 * vikata_inside_options_form hook.
									 *
									 */
									 do_action( 'vikata_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Blog' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Colors' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Copyright' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Disable Elements' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Demo Import' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Hooks' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Import / Export' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Menu Plus' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Page Header' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Secondary Nav' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Spacing' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Typography' => array(
											'url' => VIKATA_THEME_URL,
									),
									'Elementor Addon' => array(
											'url' => VIKATA_THEME_URL,
									)
								);

								if ( ! defined( 'VIKATA_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox vikata-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'vikata' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated vikata-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'More info', 'vikata' ); ?></a>
													</div>
												</div>
												<div class="vikata-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * vikata_options_items hook.
								 *
								 */
								do_action( 'vikata_options_items' );
								?>
							</div>

							<div class="vikata-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="vikata_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'vikata' )
									);
									?>
								</div>

								<?php
								/**
								 * vikata_admin_right_panel hook.
								 *
								 */
								 do_action( 'vikata_admin_right_panel' );

								  ?>
                                
                                <div class="wpkoi-doc">
                                	<h3><?php esc_html_e( 'Vikata documentation', 'vikata' ); ?></h3>
                                	<p><?php esc_html_e( 'If You`ve stuck, the documentation may help on WPKoi.com', 'vikata' ); ?></p>
                                    <a href="<?php echo esc_url(VIKATA_DOCUMENTATION); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Vikata documentation', 'vikata' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-social">
                                	<h3><?php esc_html_e( 'WPKoi on Facebook', 'vikata' ); ?></h3>
                                	<p><?php esc_html_e( 'If You want to get useful info about WordPress and the theme, follow WPKoi on Facebook.', 'vikata' ); ?></p>
                                    <a href="<?php echo esc_url(VIKATA_WPKOI_SOCIAL_URL); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Go to Facebook', 'vikata' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-review">
                                	<h3><?php esc_html_e( 'Help with You review', 'vikata' ); ?></h3>
                                	<p><?php esc_html_e( 'If You like Vikata theme, show it to the world with Your review. Your feedback helps a lot.', 'vikata' ); ?></p>
                                    <a href="<?php echo esc_url(VIKATA_WORDPRESS_REVIEW); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Add my review', 'vikata' ); ?></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'vikata_admin_errors' ) ) {
	add_action( 'admin_notices', 'vikata_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function vikata_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_vikata-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'vikata-notices', 'true', esc_html__( 'Settings saved.', 'vikata' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'vikata-notices', 'imported', esc_html__( 'Import successful.', 'vikata' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'vikata-notices', 'reset', esc_html__( 'Settings removed.', 'vikata' ), 'updated' );
		}

		settings_errors( 'vikata-notices' );
	}
}
