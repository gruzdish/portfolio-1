
			<div id="back-to-top">
				<a href="#top"><?php _e( 'Back to top' , 'layerswp' ); ?></a>
			</div> <!-- back-to-top -->

		</section>


		<?php if( !( is_singular() && 'elementor_library' == get_post_type() ) ) {
			if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
				get_template_part( 'partials/footer' , 'standard' );
			} 
		}?>

	</div><!-- END / MAIN SITE #wrapper -->
	<?php do_action( 'layers_after_site_wrapper' ); ?>
	<?php wp_footer(); ?>
</body>
</html>