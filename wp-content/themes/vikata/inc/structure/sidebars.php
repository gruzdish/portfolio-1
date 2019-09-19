<?php
/**
 * Build the sidebars.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'vikata_construct_sidebars' ) ) {
	/**
	 * Construct the sidebars.
	 *
	 */
	function vikata_construct_sidebars() {
		$layout = vikata_get_layout();

		// When to show the right sidebar.
		$rs = array( 'right-sidebar', 'both-sidebars', 'both-right', 'both-left' );

		// When to show the left sidebar.
		$ls = array( 'left-sidebar', 'both-sidebars', 'both-right', 'both-left' );

		// If left sidebar, show it.
		if ( in_array( $layout, $ls ) ) {
			get_sidebar( 'left' );
		}

		// If right sidebar, show it.
		if ( in_array( $layout, $rs ) ) {
			get_sidebar();
		}
	}
}
