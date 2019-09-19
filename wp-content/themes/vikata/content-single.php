<?php
/**
 * The template for displaying single posts.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php vikata_article_schema( 'CreativeWork' ); ?>>
	<div class="inside-article">
		<?php
		/**
		 * vikata_before_content hook.
		 *
		 *
		 * @hooked vikata_featured_page_header_inside_single - 10
		 */
		do_action( 'vikata_before_content' );
		?>

		<header class="entry-header">
			<?php
			/**
			 * vikata_before_entry_title hook.
			 *
			 */
			do_action( 'vikata_before_entry_title' );

			if ( vikata_show_title() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			}

			/**
			 * vikata_after_entry_title hook.
			 *
			 *
			 * @hooked vikata_post_meta - 10
			 */
			do_action( 'vikata_after_entry_title' );
			?>
		</header><!-- .entry-header -->

		<?php
		/**
		 * vikata_after_entry_header hook.
		 *
		 *
		 * @hooked vikata_post_image - 10
		 */
		do_action( 'vikata_after_entry_header' );
		?>

		<div class="entry-content" itemprop="text">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'vikata' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php
		/**
		 * vikata_after_entry_content hook.
		 *
		 *
		 * @hooked vikata_footer_meta - 10
		 */
		do_action( 'vikata_after_entry_content' );

		/**
		 * vikata_after_content hook.
		 *
		 */
		do_action( 'vikata_after_content' );
		?>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
