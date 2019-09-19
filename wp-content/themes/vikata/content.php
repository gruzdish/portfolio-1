<?php
/**
 * The template for displaying posts within the loop.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php vikata_article_schema( 'CreativeWork' ); ?>>
	<div class="inside-article">
    	<div class="article-holder">
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

			the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

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

		if ( vikata_show_excerpt() ) : ?>

			<div class="entry-summary" itemprop="text">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		<?php else : ?>

			<div class="entry-content" itemprop="text">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'vikata' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->

		<?php endif;

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
        </div>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
