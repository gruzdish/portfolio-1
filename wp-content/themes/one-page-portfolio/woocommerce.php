<?php
/**
 * The template for displaying woocommerce section.
 *
 * @package One_Page_Portfolio
 */

get_header();
?>
<div class="section service-section">
	<div class="container">
		<div class="row">

				<div class="custom-col-4">
					<header class="entry-header heading">
						<h2 class="entry-title"><?php the_title();?></h2>
					</header>
				</div>	
				<div class="custom-col-8">
					<div class="service-detail-wrapper">				

						<?php woocommerce_content(); ?>						
					</div>
				</div>
		</div>		
	</div>
</div>

<?php

get_footer();