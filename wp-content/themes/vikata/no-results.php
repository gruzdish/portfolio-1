<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="no-results not-found">
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
			<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'vikata' ); // WPCS: XSS OK. ?></h1>
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

		<div class="entry-content">

				<?php if ( is_search() ) : ?>

					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vikata' ); // WPCS: XSS OK. ?></p>
					<?php get_search_form(); ?>

				<?php else : ?>

					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'vikata' ); // WPCS: XSS OK. ?></p>
					<?php get_search_form(); ?>

				<?php endif; ?>

		</div><!-- .entry-content -->

		<?php
		/**
		 * vikata_after_content hook.
		 *
		 */
		do_action( 'vikata_after_content' );
		?>
	</div><!-- .inside-article -->
</div><!-- .no-results -->
