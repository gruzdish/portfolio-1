<?php // Fetch current user information
$user = wp_get_current_user(); ?>

<?php // Get plugin list
$plugins = get_plugins();
$elementor_plugin_slug = 'elementor/elementor.php';?>

<?php // Instantiate Inputs
$form_elements = new Layers_Form_Elements(); ?>

<?php // Get the API up and running for the plugin listing
$api = new Layers_API(); ?>

<?php // Load up Layers theme info
$theme_info = wp_get_theme( 'layerswp' ); ?>

<section id="layers-dashboard-page" class="l_admin-area-wrapper">

	<?php $this->header( __( 'Dashboard' , 'layerswp' ) ); ?>

	<div class="l_admin-well l_admin-content">
		<div class="l_admin-container-large">
			<div class="l_admin-row">

				<div class="l_admin-column l_admin-span-3">

					<?php if( count( layers_get_builder_pages() ) > 0 ) { ?>
						<div class="l_admin-panel l_admin-push-bottom">
							<div class="l_admin-panel-title">
								<h4 class="l_admin-heading"><?php _e( 'Layers Pages' , 'layerswp' ); ?></h4>
							</div>
							<ul class="l_admin-list l_admin-page-list l_admin-scroll">
								<?php foreach( layers_get_builder_pages() as $page ) { ?>
									<li>
										<a class="l_admin-page-list-title" href="<?php echo admin_url( 'post.php?post=' . $page->ID . '&action=edit' ); ?>"><?php echo $page->post_title; ?></a>
											<a href="<?php echo admin_url( 'post.php?post=' . $page->ID . '&action=edit' ); ?>"><?php _e( 'Edit' , 'layerswp' ); ?></a> |
											<a href="<?php echo get_permalink( $page->ID ); ?>"><?php _e( 'View' , 'layerswp' ); ?></a>
										</span>
									</li>
								<?php }?>
							</ul>
							<div class="l_admin-button-well">
								<a class="button" href="<?php echo admin_url( 'edit.php?action=elementor_new_post&post_type=page' ); ?>">
									<?php _e( 'Add New Page' , 'layerswp' ); ?>
								</a>
							</div>
						</div>
					<?php } else { ?>
						<div class="l_admin-panel l_admin-content l_admin-push-bottom">
							<div class="l_admin-section-title l_admin-small">
								<h3 class="l_admin-heading"><?php _e( 'Start Using Elementor' , 'layerswp' ); ?></h3>
								<p class="l_admin-excerpt">
									<?php _e( 'Start creating beautiful layouts with Elementor Builder.' , 'layerswp' ); ?>
								</p>
							</div>
							<a href="https://elementor.com/" class="button btn-large button-primary">
								<?php _e( 'Get Started &rarr;' , 'layerswp' ); ?>
							</a>
						</div>
					<?php }?>

				</div>
				<?php if( !defined( 'LAYERS_DISABLE_MARKETPLACE' ) && !class_exists( 'Elementor\Plugin' ) ){ ?>
					<div class="l_admin-column l_admin-span-5">
						<div class="l_admin-panel l_admin-push-bottom">
							<div class="l_admin-panel-title">
								<h4 class="l_admin-heading"><?php _e( 'Get Even More with Elementor' , 'layerswp' ); ?></h4>
							</div>
							<div class="l_admin-media l_admin-image-left l_admin-content l_admin-no-push-bottom">
								<div class="l_admin-media l_admin-image-left">
									<div class="l_admin-media-image l_admin-small">
										<img src="<?php echo get_template_directory_uri(); ?>/core/assets/images/thumb-elementor.png" alt="Elementor" />
									</div>
									<div class="l_admin-media-body">
										<div class="l_admin-excerpt">
											<p><?php _e( 'Join millions of professionals who use Elementor to build WordPress websites faster and better than ever before.' , 'layerswp' ); ?></p>
											<ul class="l_admin-ticks-wp">
												<li><?php _e( 'Drag & Drop Editor' , 'layerswp' ); ?></li>
												<li><?php _e( 'No Coding' , 'layerswp' ); ?></li>
												<li><?php _e( 'Incredible Widgets' , 'layerswp' ); ?></li>
												<li><?php _e( 'Mobile Editing' , 'layerswp' ); ?></li>
												<li><?php _e( 'Video Tutorials' , 'layerswp' ); ?></li>
												<li><?php _e( 'Get more control over your blog' , 'layerswp' ); ?></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="l_admin-button-well l_admin-text-right">
								<?php if( isset( $plugins[ $elementor_plugin_slug ] ) ) : ?>
									<a class="l_admin-button btn-primary" href="<?php echo wp_nonce_url( 'plugins.php?action=activate&plugin=' . $elementor_plugin_slug, 'activate-plugin_' . $elementor_plugin_slug ); ?>">
										Activate Elementor
									</a>
								<?php else : ?>
									<a class="l_admin-button btn-primary" href="<?php echo wp_nonce_url( add_query_arg( array( 'action' => 'install-plugin', 'plugin' => 'elementor' ), admin_url( 'update.php' ) ), 'install-plugin_elementor' ); ?>">
										Install Elementor
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="l_admin-column l_admin-span-4">

					<div class="l_admin-panel l_admin-push-bottom">
						<div class="l_admin-panel-title">
							<h4 class="l_admin-heading">
								<a href="http://docs.layerswp.com/">
									<?php _e( 'Quick Help' , 'layerswp' ); ?>
								</a>
							</h4>
						</div>
						<ul class="l_admin-list l_admin-extensions" data-layers-feed="docs" data-laters-feed-count="5">
							<li data-loading="1">
								<?php _e( "Loading feed..." , 'layerswp' ); ?>
							</li>
						</ul>
						<div class="l_admin-button-well">
							<a class="button" href="http://docs.layerswp.com/" target="_blank">
								<?php _e( 'Get more useful tips' , 'layerswp' ); ?>
							</a>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
</section>

<?php $this->footer(); ?>