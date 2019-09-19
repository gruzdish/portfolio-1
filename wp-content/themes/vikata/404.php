<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php vikata_content_class(); ?>>
		<main id="main" <?php vikata_main_class(); ?>>
			<?php
			/**
			 * vikata_before_main_content hook.
			 *
			 */
			do_action( 'vikata_before_main_content' );
			?>

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
					<h1 class="entry-title" itemprop="headline"><?php echo esc_html( apply_filters( 'vikata_404_title', __( 'Oops! That page can&rsquo;t be found.', 'vikata' ) ) ); // WPCS: XSS OK. ?></h1>
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
					echo '<p>' . esc_html( apply_filters( 'vikata_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'vikata' ) ) ) . '</p>'; // WPCS: XSS OK.

					get_search_form();
					?>
				</div><!-- .entry-content -->

				<?php
				/**
				 * vikata_after_content hook.
				 *
				 */
				do_action( 'vikata_after_content' );
				?>

			</div><!-- .inside-article -->

			<?php
			/**
			 * vikata_after_main_content hook.
			 *
			 */
			do_action( 'vikata_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * vikata_after_primary_content_area hook.
	 *
	 */
	 do_action( 'vikata_after_primary_content_area' );

	 vikata_construct_sidebars();

get_footer();
