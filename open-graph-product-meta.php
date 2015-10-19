<?php 
/* Plugin Name: Woocommerce Open Graph Meta for Products
   Plugin URI: https://techcress.com
   Description: Add open graph meta to Woocommerce products
   Version: 1.0
   Author: Tom Nagle
   Author URI: https://techcress.com
   License: GPL2 */ 
function add_open_graph_meta(){
	if( is_product() ){
		$product = new WC_Product( get_the_ID() );
		echo '<meta property="og:price:amount" content="'.$product->price.'" />';
		echo '<meta property="og:price:currency" content="'.get_woocommerce_currency().'" /> ';
		/* Hardcode a product brand here or get the term from a plugin*/
		echo '<meta property="og:brand" content="Your brand" />';
		// Get the product rating if it has been rated
		if ($product->get_rating_count() > 0){
			echo '<meta property="og:rating" content="'. $product->get_average_rating().'" />';
			echo '<meta property="og:rating_count" content="'. $product->get_rating_count().'" />';
			echo '<meta property="og:rating_scale" content="5" />';	
		}
		// Get in stock & out of stock
		if ( $product->is_in_stock() ) {
        	echo '<meta property="og:availability" content="in stock" />';
    	}else{
			echo '<meta property="og:availability" content="out of stock" />';	
		}
	}
}
/*Add da hook */
add_action( 'wp_head', 'add_open_graph_meta' );
?>