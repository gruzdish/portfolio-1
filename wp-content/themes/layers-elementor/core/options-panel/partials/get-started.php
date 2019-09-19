<?php
// Fetch current user information
$user = wp_get_current_user();

// Get the Elementor Activation URL
$elementor_activation_link = layers_get_elementor_install_link();

// Instantiate Inputs
$form_elements = new Layers_Form_Elements();

// Instantiate the widget migrator
$layers_migrator = new Layers_Widget_Migrator(); ?>
<section class="l_admin-area-wrapper">

	<div class="l_admin-onboard-wrapper">

		<div class="l_admin-onboard-controllers">
			<div class="onboard-nav-dots l_admin-pull-left" id="layers-onboard-anchors"></div>
			<a class="button btn-link l_admin-pull-right" href="" id="layers-onboard-skip"><?php _e( 'Skip' , 'layerswp' ); ?></a>
		</div>

		<div class="l_admin-onboard-slider l_admin-row">

			<!-- Welcome -->
			<div class="l_admin-onboard-slide l_admin-animate l_admin-onboard-slide-current">
				<div class="l_admin-column l_admin-span-8 postbox">
					<div class="l_admin-content-large">
						<!-- Your content goes here -->
						<div class="l_admin-section-title l_admin-no-push-bottom">
							<h3 class="l_admin-heading">
								<?php _e( 'Welcome to Layers!' , 'layerswp' ); ?>
							</h3>
							<div class="l_admin-excerpt">
								<p>
									<?php _e( 'Layers is a revolutionary WordPress theme that along with Elementor, makes website building a dream come true.' , 'layerswp' ); ?>
								</p>
								<p>
									<?php _e( 'The following short steps are designed to help you get going as quickly as possible with Layers.' , 'layerswp' ); ?>
								</p>
								<p>
									<?php _e( 'Enjoy the ride!' , 'layerswp' ); ?>
								</p>

							</div>
						</div>
					</div>
					<div class="l_admin-button-well">
						<a class="l_admin-button btn-primary l_admin-pull-right onboard-next-step" href=""><?php _e( 'Let\'s get started &rarr;' , 'layerswp' ); ?></a>
					</div>
				</div>
				<div class="l_admin-column l_admin-span-4 no-gutter">
					<div class="l_admin-content">
						<!-- Your helpful tips go here -->
						<ul class="l_admin-help-list">
							<li class="pro-tip"><?php _e( 'For the Pros: Layers will automatically assign the tagline to Settings &rarr; General.' , 'layerswp' ); ?></li>
						</ul>
					</div>
				</div>
			</div>

			<!-- Capture site details (previously 'Give your site a Name') -->
			<div class="l_admin-onboard-slide l_admin-animate l_admin-onboard-slide-inactive">
				<div class="l_admin-column l_admin-span-8 postbox">

					<div class="l_admin-content-large ">

						<!-- Heading -->
						<div class="l_admin-section-title">
							<h3 class="l_admin-heading">
								<?php _e( 'Let&rsquo;s do some quick setup' , 'layerswp' ); ?>
							</h3>
							<p class="l_admin-excerpt">
								<?php _e( 'Tell us a bit about your site so that we can give you the best website building experience possible.' , 'layerswp' ); ?>
							</p>
						</div>

						<div class="l_admin-form-item">
							<label>
								<?php _e( 'What is the name of your website?' , 'layerswp' ); ?>
								<i class="fa fa-question-circle" data-tip="<?php echo esc_attr( __( 'Enter your website name below. We&apos;ll use this in your site title and in search results.' , 'layerswp' ) ); ?>"></i>
							</label>
							<?php
							echo $form_elements->input( array(
								'type' => 'text',
								'name' => 'blogname',
								'id' => 'blogname',
								'placeholder' => get_bloginfo( 'name' ),
								'value' => get_bloginfo( 'name' ),
								'class' => 'layers-text l_admin-large',
							) );
							?>
						</div>

						<div class="l_admin-form-item">
							<label>
								<?php _e( 'How would you describe your site?' , 'layerswp' ); ?>
								<i class="fa fa-question-circle" data-tip="<?php _e( 'A tagline describes who and what you are in just a few simple words. For example Layers is a &ldquo;WordPress Site Builder&rdquo; - simple, easy, quick to read. Now you try:' , 'layerswp' ); ?>"></i>
							</label>
							<?php
							echo $form_elements->input( array(
								'type' => 'text',
								'name' => 'blogdescription',
								'id' => 'blogdescription',
								'placeholder' => get_bloginfo( 'description' ),
								'value' => get_bloginfo( 'description' ),
								'class' => 'layers-text l_admin-large'
							) );
							?>
						</div>

						<div class="l_admin-form-item">
							<label>
								<?php _e( 'What will your site be used for?' , 'layerswp' ); ?>
								<i class="fa fa-question-circle" data-tip="<?php _e( 'This will help us better tailor your experience.' , 'layerswp' ); ?>"></i>
							</label>
							<?php
							echo $form_elements->input( array(
								'type' => 'select',
								'name' => 'info_site_usage',
								'id' => 'info_site_usage',
								'value' => get_option( 'info_site_usage' ),
								'options' => array(
									'' => __( '-- Pick a Category --', 'layerswp' ),
									'activism' => __( 'Activism', 'layerswp' ),
									'art' => __( 'Art', 'layerswp' ),
									'blog-magazine' => __( 'Blog / Magazine', 'layerswp' ),
									'buddypress' => __( 'BuddyPress', 'layerswp' ),
									'business' => __( 'Business', 'layerswp' ),
									'charity' => __( 'Charity', 'layerswp' ),
									'children' => __( 'Children', 'layerswp' ),
									'churches' => __( 'Churches', 'layerswp' ),
									'corporate' => __( 'Corporate', 'layerswp' ),'personal' => __( 'Personal', 'layerswp' ),
									'creative' => __( 'Creative', 'layerswp' ),
									'directory-listings' => __( 'Directory &amp; Listings', 'layerswp' ),
									'education' => __( 'Education', 'layerswp' ),
									'entertainment' => __( 'Entertainment', 'layerswp' ),
									'environmental' => __( 'Environmental', 'layerswp' ),
									'events' => __( 'Events', 'layerswp' ),
									'experimental' => __( 'Experimental', 'layerswp' ),
									'fashion' => __( 'Fashion', 'layerswp' ),
									'film-tv' => __( 'Film &amp; TV', 'layerswp' ),
									'food' => __( 'Food', 'layerswp' ),
									'health-beauty' => __( 'Health &amp; Beauty', 'layerswp' ),
									'hosting' => __( 'Hosting', 'layerswp' ),
									'just-testing' => __( 'Just Testing', 'layerswp' ),
									'news-editorial' => __( 'News / Editorial', 'layerswp' ),
									'nightlife' => __( 'Nightlife', 'layerswp' ),
									'nonprofit' => __( 'Nonprofit', 'layerswp' ),
									'marketing' => __( 'Marketing', 'layerswp' ),
									'miscellaneous' => __( 'Miscellaneous', 'layerswp' ),
									'mobile' => __( 'Mobile', 'layerswp' ),
									'music-and-bands' => __( 'Music and Bands', 'layerswp' ),
									'photography' => __( 'Photography', 'layerswp' ),
									'political' => __( 'Political', 'layerswp' ),
									'portfolio' => __( 'Portfolio', 'layerswp' ),
									'retail' => __( 'Retail', 'layerswp' ),
									'shopping' => __( 'Shopping', 'layerswp' ),
									'software' => __( 'Software', 'layerswp' ),
									'sport' => __( 'Sport', 'layerswp' ),
									'travel' => __( 'Travel', 'layerswp' ),
									'technology' => __( 'Technology', 'layerswp' ),
									'restaurants-cafes' => __( 'Restaurants &amp; Cafes', 'layerswp' ),
									'real-estate' => __( 'Real Estate', 'layerswp' ),
									'wedding' => __( 'Wedding', 'layerswp' ),
								),
								'class' => 'l_admin-large',
							) );
							?>


						</div>

						<div class="l_admin-form-item">
							<label for="layers-info-developer">
								<?php _e( 'What is your skill level?', 'layerswp' ); ?>
							</label>
							<?php
							echo $form_elements->input( array(
								'type' => 'select',
								'name' => 'layers_info_developer',
								'id' => 'layers_info_developer',
								'value' => get_option( 'layers_info_developer' ),
								'options' => array(
									'beginner' => __( 'I\'m not a designer / developer. I just need a website for myself.', 'layerswp' ),
									'learning' => __( 'I am learning to become a designer / developer.', 'layerswp' ),
									'wordpress_developer' => __( 'I am a theme / plugin developer.', 'layerswp' ),
									'freelance' => __( 'I am a freelance designer / developer.', 'layerswp' ),
									'agency' => __( 'I am  a designer / developer at an agency or organization.', 'layerswp' ),
								),
								'class' => 'l_admin-large',
							) );
								?>
						</div>

						<div class="l_admin-form-item">
							<label>
								<?php _e( 'Choose a primary color?' , 'layerswp' ); ?>
								<i class="fa fa-question-circle" data-tip="<?php _e( 'We\'ll use this color in select places around your website.' , 'layerswp' ); ?>"></i>
							</label>
							<?php
							echo $form_elements->input( array(
								'type' => 'color',
								'name' => 'site_color',
								'id' => 'site_color',
								'value' => ( layers_get_theme_mod( 'header-background-color' ) ) ? layers_get_theme_mod( 'header-background-color' ) : '#009eec',
							) );
							?>
						</div>


						<?php echo $form_elements->input( array(
							'type' => 'hidden',
							'name' => 'action',
							'id' => 'action',
							'value' => 'layers_onboarding_update_options'
						) ); ?>

					</div>

					<div class="l_admin-button-well">
						<span class="l_admin-save-progress l_admin-hide l_admin-button btn-link" data-busy-message="<?php _e( 'Saving your Site Name' , 'layerswp' ); ?>"></span>
						<a class="l_admin-button btn-primary l_admin-pull-right onboard-next-step" href="">
							<?php _e( 'Next Step &rarr;' , 'layerswp' ); ?>
						</a>
					</div>
				</div>
				<div class="l_admin-column l_admin-span-4 no-gutter">
					<div class="l_admin-content">
						<!-- Your helpful tips go here -->
						<ul class="l_admin-help-list">
							<li>
								<?php _e( sprintf( 'For tips on how best to name your website, we suggest reading <a href="%s" rel="nofollow">this post</a>', '//docs.layerswp.com' ) , 'layerswp' ); ?>
							</li>
							<li class="pro-tip">
								<?php _e( 'For the Pros: Layers will automatically assign this site name to Settings &rarr; General' , 'layerswp' ); ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Create Default Pages -->
			<div class="l_admin-onboard-slide l_admin-animate l_admin-onboard-slide-inactive">
				<div class="l_admin-column l_admin-span-8 postbox">
					<div class="l_admin-content-large">
						<!-- Your content goes here -->
						<div class="l_admin-section-title">
							<h3 class="l_admin-heading">
								<?php _e( 'Create Starter Page(s)', 'layerswp' ); ?>
							</h3>
							<p class="l_admin-excerpt">
								<?php _e( "There are some standard pages that nearly all websites need. We recommend that you let us create these for you and apply settings to make them work best with Layers. *these can easily be deleted later if you're not sure", 'layerswp' ); ?>
							</p>
						</div>

						<?php echo $form_elements->input( array(
							'type' => 'hidden',
							'name' => 'action',
							'id' => 'action',
							'value' => 'layers_onboarding_create_pages'
						) ); ?>

						<div class="l_admin-checkbox-wrapper l_admin-large l_admin-form-item">
							<input id="layers-create-page-blog" name="create-page-blog" value="Blog" type="checkbox" checked="checked" />
							<label for="layers-create-page-blog">
								<?php _e( 'Blog Page', 'layerswp' ); ?>
								<i class="fa fa-question-circle" data-tip="<?php _e( 'Blog page shows your blog posts.' , 'layerswp' ); ?>"></i>
							</label>
						</div>

					</div>
					<div class="l_admin-button-well">
						<span class="l_admin-save-progress l_admin-hide l_admin-button btn-link" data-busy-message="<?php _e( 'Creating Page(s)', 'layerswp' ); ?>"></span>
						<a class="l_admin-button btn-primary l_admin-pull-right onboard-next-step" href=""><?php _e( 'Next Step &rarr;' , 'layerswp' ); ?></a>
					</div>
				</div>
				<div class="l_admin-column l_admin-span-4 no-gutter">
					<div class="l_admin-content">

						<!-- Your helpful tips go here -->
						<ul class="l_admin-help-list">
							<li><?php _e( 'Get advice on the right theme for your site.' , 'layerswp' ); ?></li>
							<li><?php _e( 'Help choosing extensions.' , 'layerswp' ); ?></li>
							<li><?php _e( 'Feedback? Let us know as soon as it comes to mind.' , 'layerswp' ); ?></li>
							<li><?php _e( 'Have a problem? We\'ll send you the best link to solve your issues.' , 'layerswp' ); ?></li>
							<li><?php _e( 'Allow Layers to collect non-sensitive diagnostic data and usage information to help us improve our theme and best assist you.' , 'layerswp' ); ?></li>
						</ul>
					</div>
				</div>
			</div>

			<!-- Upload a Logo -->
			<div class="l_admin-onboard-slide l_admin-animate l_admin-onboard-slide-inactive">
				<div class="l_admin-column l_admin-span-8 postbox">
					<div class="l_admin-content-large">
						<!-- Your content goes here -->
						<div class="l_admin-section-title">
							<h3 class="l_admin-heading">
								<?php _e( 'Would you like to add your logo?' , 'layerswp' ); ?>
							</h3>
							<p class="l_admin-excerpt">
								 <?php _e( 'Layers will add your logo and position it properly. If you don&apos;t have one yet, no problem, you can add it later, or skip this step if you&apos;d just prefer to use text.' , 'layerswp' ); ?>
							</p>
						</div>
						<?php if( function_exists( 'the_custom_logo' ) ) {
							$site_logo[ 'id' ] =  get_theme_mod( 'custom_logo' );
						} else {
							$site_logo = get_option( 'site_logo' );
						} ?>

						<div class="l_admin-logo-wrapper">
							<div class="l_admin-logo-upload-controller">
								<?php
								   echo $form_elements->input( array(
										'label' => __( 'Choose Logo' , 'layerswp' ),
										'type' => 'image',
										'name' => 'site_logo',
										'id' => 'site_logo',
										'value' => ( '' != $site_logo ? $site_logo[ 'id' ] : 0 )
								   ) );
								?>
							</div>
						</div>
						<?php echo $form_elements->input( array(
							'type' => 'hidden',
							'name' => 'action',
							'id' => 'action',
							'value' => 'layers_onboarding_update_options'
						) ); ?>
					</div>
					<div class="l_admin-button-well">
						<span class="l_admin-save-progress l_admin-proceed-to-customizer l_admin-hide l_admin-button btn-link" data-busy-message="<?php _e( 'Updating your Logo' , 'layerswp' ); ?>"></span>
						<a class="l_admin-button btn-primary l_admin-pull-right onboard-next-step" href="">
							<?php if( !class_exists( 'Elementor\Plugin' ) ) {
								_e( 'Next Step &rarr;' , 'layerswp' );
							} else {
								_e( 'Save &amp; Finish' , 'layerswp' );
							} ?>
						</a>
					</div>
				</div>
				<div class="l_admin-column l_admin-span-4 no-gutter">
					<div class="l_admin-content">
						<!-- Your helpful tips go here -->
						<ul class="l_admin-help-list">
							<li><?php _e( 'For best results, use an image between 40px and 200px tall and not more than 1000px wide' , 'layerswp' ); ?></li>
							<li><?php _e( 'PNGs with a transparent background work best but GIFs or JPGs are fine too' , 'layerswp' ); ?></li>
							<li><?php _e( 'Try keep your logo file size below 500kb' , 'layerswp' ); ?></li>
						</ul>
					</div>
				</div>
			</div>
			
			<?php if( !class_exists( 'Elementor\Plugin' ) && !class_exists( 'ElementorPro\Plugin' ) ) : ?>
				<!-- Create Default Pages -->
				<div class="l_admin-onboard-slide l_admin-animate l_admin-onboard-slide-inactive">
					<div class="l_admin-column l_admin-span-8 postbox">
						<div class="l_admin-content-large">
							<!-- Your content goes here -->
							<div class="l_admin-section-title">
								<div class="l_admin-push-right">
									<h3 class="l_admin-heading">
										<?php _e( 'Elementor', 'layerswp' ); ?>
									</h3>
									<div class="l_admin-pull-right">
										<img class="l_admin-pull-left" src="<?php echo get_template_directory_uri(); ?>/core/assets/images/thumb-elementor.png" alt="Elementor" />
									</div>
									<p class="l_admin-excerpt">
										<?php _e( "Join millions of professionals who use Elementor to build WordPress websites faster and better than ever before.", 'layerswp' ); ?>
									</p>
								</div>
							</div>

							<?php if ( current_user_can( 'update_plugins' ) ) : ?>
								<div class="l_admin-checkbox-wrapper l_admin-large l_admin-form-item">
									<a class="l_admin-button btn-primary" href="<?php echo $elementor_activation_link[ 'url' ]; ?>">
										<?php echo $elementor_activation_link[ 'label' ]; ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
						<div class="l_admin-button-well">
							<span class="l_admin-save-progress l_admin-hide l_admin-button btn-link" data-busy-message="<?php _e( 'Creating Page(s)', 'layerswp' ); ?>"></span>
							<a class="l_admin-button btn-primary l_admin-pull-right onboard-next-step" href=""><?php echo $elementor_activation_link[ 'label' ]; ?></a>

						</div>
					</div>
					<div class="l_admin-column l_admin-span-4 no-gutter">
						<div class="l_admin-content">

							<!-- Your helpful tips go here -->
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
			<?php endif; ?>
		</div>

	</div>

</section>
