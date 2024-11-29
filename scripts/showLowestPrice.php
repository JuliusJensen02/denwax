<?php
// Show only lowest prices in WooCommerce variable products

	add_filter( 'woocommerce_variable_sale_price_html', 'wpglorify_variation_price_format', 10, 2 );
	add_filter( 'woocommerce_variable_price_html', 'wpglorify_variation_price_format', 10, 2 );

	function wpglorify_variation_price_format( $price, $product ) {
		// Main Price
		$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
		$price = $prices[0] !== $prices[1] ? sprintf( __( 'Fra %1$s', 'custom-string' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

		// Sale Price
		$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
		sort( $prices );
		$saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'Fra %1$s', 'custom-string' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

		if ( $price !== $saleprice ) {
			$price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
		}
		return $price;
	}
