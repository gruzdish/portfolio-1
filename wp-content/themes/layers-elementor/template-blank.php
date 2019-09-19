<?php
/**
 * Template Name: Blank Page
 * Template Post Type: post, page
 * The template for displaying a full width, unstyled page
 *
 * @package Layers
 * @since Layers 1.0.0
 */

get_header();

if( have_posts() ) :

    while( have_posts() ) : the_post();
        the_content();
    endwhile; // while has_post();
endif; // if has_post() ?>

<?php get_footer();