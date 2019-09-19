<?php
/**
 * The template for displaying the header.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php vikata_body_schema();?> <?php body_class(); ?>>
	<?php
	/**
	 * new WordPress action since version 5.2
	 */
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	
	/**
	 * vikata_before_header hook.
	 *
	 *
	 * @hooked vikata_do_skip_to_content_link - 2
	 * @hooked vikata_top_bar - 5
	 * @hooked vikata_add_navigation_before_header - 5
	 */
	do_action( 'vikata_before_header' );

	/**
	 * vikata_header hook.
	 *
	 *
	 * @hooked vikata_construct_header - 10
	 */
	do_action( 'vikata_header' );

	/**
	 * vikata_after_header hook.
	 *
	 *
	 * @hooked vikata_featured_page_header - 10
	 */
	do_action( 'vikata_after_header' );
	?>

	<div id="page" class="hfeed site grid-container container grid-parent">
		<div id="content" class="site-content">
			<?php
			/**
			 * vikata_inside_container hook.
			 *
			 */
			do_action( 'vikata_inside_container' );
