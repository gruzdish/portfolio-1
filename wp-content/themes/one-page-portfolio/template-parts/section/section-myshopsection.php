<?php
/**
 * Template for My Shop Section
 *
 * @package One_Page_Portfolio_Pro
 */
$enable_myshop = rt_portfolio_get_option( 'enable_myshop' );

if ( false == $enable_myshop ){
    return;
}
$my_shop_section_title 	= rt_portfolio_get_option( 'myshop_section_title' );
$myshop_page 	= rt_portfolio_get_option( 'myshop_page' );
?>
<div class="section my-shop-section" id="myshopsection">
	<div class="container">
		<div class="row">
			<?php if ( $my_shop_section_title ): ?>
				<div class="custom-col-4">
					<header class="entry-header heading">
						<h2 class="entry-title"><?php echo esc_html( $my_shop_section_title );?></h2>
					</header>
				</div>
			<?php endif;?>
			<div class="custom-col-8">
				<div class="myshop-section-wrapper">
					<div class="myshop-information">
                        <?php $args_intro = array (                         
                            'p'                 => absint( $myshop_page ),
                            'post_status'       => 'publish',
                            'post_type'         => 'page',
                        );

                        $loop = new WP_Query( $args_intro ); 

                        if ( $loop->have_posts() ) : 
                            while ($loop->have_posts()) : $loop->the_post(); ?>							
								<article class="y-shop-wrap">
									<div class="entery-content">
										<?php the_content();?>
									</div>
								</article>
							<?php endwhile;
							wp_reset_postdata();
						endif; ?>
						<?php if ( one_page_portfolio_is_woocommerce_active() ) {
							$shop_page_url = get_permalink( wc_get_page_id ( 'shop' ) ); 
							if ( !empty( $shop_page_url ) ): ?>
								<a href="<?php echo esc_url( $shop_page_url );?>" class="view-btn"><?php echo esc_html__( 'View All Product', 'one-page-portfolio');?></a>
							<?php endif;
						} ?>						
					</div>

				</div>
			</div>
		</div>
	</div>
</div>