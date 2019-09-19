<?php
/**
 * The template for displaying the footer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- #content -->
</div><!-- #page -->

<?php
/**
 * vikata_before_footer hook.
 *
 */
do_action( 'vikata_before_footer' );
?>

<div <?php vikata_footer_class(); ?>>
	<?php
	/**
	 * vikata_before_footer_content hook.
	 *
	 */
	do_action( 'vikata_before_footer_content' );

	/**
	 * vikata_footer hook.
	 *
	 *
	 * @hooked vikata_construct_footer_widgets - 5
	 * @hooked vikata_construct_footer - 10
	 */
	do_action( 'vikata_footer' );

	/**
	 * vikata_after_footer_content hook.
	 *
	 */
	do_action( 'vikata_after_footer_content' );
	?>
</div><!-- .site-footer -->

<?php
/**
 * vikata_after_footer hook.
 *
 */
do_action( 'vikata_after_footer' );

wp_footer();
?>

</body>
</html>
