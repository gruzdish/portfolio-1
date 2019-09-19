<?php 
/**
 * Woocommerce Hooks and Filter
 * @package One_Page_Portfolio
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

add_action( 'one_page_portfolio_loop_after_thumbnail', 'one_page_portfolio_add_to_favorite_icon', 10 );
function one_page_portfolio_add_to_favorite_icon() {
    if( ! function_exists( 'YITH_WCWL' ) ) {
        return;
    }
    global $product, $post;
    $current_product = $product;
    $product_id = $current_product->get_id();
    $product_type = $current_product->get_type();

    echo '<a href="'.esc_url( add_query_arg( 'add_to_wishlist', $product_id ) ) .'" class="single_add_to_wishlist"><i class="fa fa-heart"></i></a>';
}

add_action( 'one_page_portfolio_loop_after_thumbnail', 'one_page_portfolio_quick_view_icon', 15 );
function one_page_portfolio_quick_view_icon() {
    if( ! function_exists( 'yith_wcqv_init' ) ) {
        return;
    }
    global $product;
    $product_id = $product->get_id();    
    echo '<a href="#" class="btn yith-wcqv-button" data-product_id="'.absint($product_id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';
}


add_action( 'one_page_portfolio_loop_after_thumbnail', 'one_page_portfolio_add_to_cart_button', 5 );
function one_page_portfolio_add_to_cart_button() {
    woocommerce_template_loop_add_to_cart();
}

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'one_page_portfolio_loop_item_title', 10 );
function one_page_portfolio_loop_item_title() {
    echo '<header class="entry-header"><a href="' . esc_url( get_permalink() ) . '"><h3 class="entry-title">' . get_the_title() . '</h3></a></header>';
}

/**
 * Change number of related products output
 */ 
function one_page_portfolio_related_products_limit() {
  global $product;
    
    $args['posts_per_page'] = 6;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'one_page_portfolio_related_products_args' );
  function one_page_portfolio_related_products_args( $args ) {
    $args['posts_per_page'] = 4; // 4 related products
    $args['columns'] = 2; // arranged in 2 columns
    return $args;
}
