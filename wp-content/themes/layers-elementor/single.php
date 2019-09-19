<?php
/**
 * The template for displaying a single post
 *
 * @package Layers
 * @since Layers 1.0.0
 */

get_header();

// Set the page type to check that we're using the right template here
if( ! $page_type = get_post_meta( get_the_ID(), '_elementor_template_type', true  ) ) $page_type = 'single';

// If we are in the Elementor editor, then load "the_content()" in order to show the page correctly
if( 'elementor_library' == get_post_type() ) { 
	while( have_posts() ) : the_post();
		the_content();
	endwhile;
} else {
	// Elementor Pro support for custom Single
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( $page_type ) ) { ?>

		<div <?php post_class( 'layers-content-main clearfix' ); ?>>
			<?php do_action('layers_before_post_loop'); ?>
			<div class="grid">
				<?php get_sidebar( 'left' ); ?>

				<?php if( have_posts() ) : ?>

					<?php while( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php layers_center_column_class(); ?>>
							<?php get_template_part( 'partials/content', 'single' ); ?>
						</article>
					<?php endwhile; // while has_post(); ?>

				<?php endif; // if has_post() ?>

				<?php get_sidebar( 'right' ); ?>
			</div>
			<?php do_action('layers_after_post_loop'); ?>
		</div>
	<?php } // Elementor Pro support for custom Single
}
get_footer();