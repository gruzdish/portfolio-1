<?php
/**
 * The template for displaying post archives
 *
 * @package Layers
 * @since Layers 1.0.0
 */

get_header(); 
					
// Elementor Pro support for custom Archive
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) { 
	
	get_template_part( 'partials/header' , 'page-title' ); ?>

	<div class="container layers-content-main archive clearfix">
		<div class="grid">
			<?php get_sidebar( 'left' ); ?>

			<?php if( have_posts() ) : ?>
				<div id="post-list" <?php layers_center_column_class(); ?>>
					<?php while( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'partials/content' , 'list' ); ?>
					<?php endwhile; // while has_post(); ?>

					<?php the_posts_pagination(); ?>
				</div>
			<?php endif; // if has_post() ?>

			<?php get_sidebar( 'right' ); ?>
		</div>
	</div>
<?php } // Elementor Pro support for custom Archive
get_footer();