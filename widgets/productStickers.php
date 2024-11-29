<?php
add_shortcode( 'product_stickers', 'productStickers' );
function productStickers($productID = null) {
	if($productID == null) {
		$productID = get_the_ID();
	}
	$product = wc_get_product($productID);
	ob_start();
	if(get_post_meta($productID, "slaa-sticker-til--fra_copy", true) == "true"){
		?>
		<div class="product-sticker sticker">
			<p><? echo get_post_meta($productID, "sticker-tekst", true); ?></p>
		</div>
		<?
	}
	if(get_post_meta($productID, "vis-udsolgt-label", true) == "true"){
		?>
		<div class="product-sticker udsolgt">
			<p><? echo get_post_meta($productID, "udsolgt-label-tekst", true); ?></p>
		</div>
		<?
	}
	if(get_post_meta($productID, "vis-restordre-label", true) == "true"){
		?>
		<div class="product-sticker restordre">
			<p><? echo get_post_meta($productID, "restordre-text", true); ?></p>
		</div>
		<?
	}
	if($product->is_on_sale()){
		?>
		<div class="product-sticker sale">
			<p><? echo "Spar " . ($product->get_regular_price() - $product->get_sale_price()) . " kr."; ?></p>
		</div>
		<?
	}
	if(get_post_meta($productID, "vis-quotset-i-loevens-hulequot", true) == "true"){
		?>
		<div class="product-sticker loevenshule">
			<p>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29.172" height="31.173" viewBox="0 0 29.172 31.173"><defs><linearGradient id="linear-gradient1" y1="0.463" x2="1" y2="0.464" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#f5bd02"></stop><stop offset="1" stop-color="#f59802"></stop></linearGradient></defs><g id="Løve_mini" data-name="Løve mini" transform="translate(-94.83 -95.947)"><g id="Group_94" data-name="Group 94" transform="translate(95.28 96.404)"><path id="Path_44" data-name="Path 44" d="M109.415,97.07a8.44,8.44,0,0,0,2.341-.37c6.586-1.534,8.94,3.4,8.94,3.4a3.5,3.5,0,0,0-2.856-.859,14.545,14.545,0,0,1,5.713,10.21s-1-2.578-2.724-3.372a9.734,9.734,0,0,1,.754,9.72,3.259,3.259,0,0,0-1.256-1.839s.913,5.145-2.83,7.921a8.445,8.445,0,0,0,.08-4.589s-.211,3.98-2.856,5.78a6.357,6.357,0,0,0,.146-3.624s-1.574,5.1-5.449,7.221c-3.875-2.115-5.449-7.221-5.449-7.221a6.357,6.357,0,0,0,.146,3.624c-2.645-1.8-2.856-5.78-2.856-5.78a8.43,8.43,0,0,0,.08,4.589c-3.743-2.778-2.83-7.921-2.83-7.921A3.259,3.259,0,0,0,97.25,115.8a9.734,9.734,0,0,1,.754-9.72c-1.719.793-2.724,3.372-2.724,3.372a14.545,14.545,0,0,1,5.713-10.21,3.5,3.5,0,0,0-2.856.859s2.354-4.932,8.94-3.4a8.44,8.44,0,0,0,2.341.37Z" transform="translate(-95.28 -96.404)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path><path id="Path_45" data-name="Path 45" d="M162.872,208.98s-3.426,4.239-.66,6.6a1.2,1.2,0,0,0,1.283.164l2.214-1.044a2.164,2.164,0,0,1,1.845,0l2.214,1.044a1.2,1.2,0,0,0,1.283-.164c2.766-2.366-.66-6.6-.66-6.6" transform="translate(-152.497 -194.216)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path><path id="Path_46" data-name="Path 46" d="M179.15,260.59v1.252a.911.911,0,0,0,1.309.82,4.183,4.183,0,0,1,3.654,0,.911.911,0,0,0,1.309-.82V260.59" transform="translate(-168.151 -239.058)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path><path id="Path_47" data-name="Path 47" d="M152.747,152.512l2.087-2.216a4.4,4.4,0,0,0,1.031-4.24c-.711-2.455-2.687-5.524-8.189-4.469-5.5-1.054-7.478,2.016-8.187,4.469a4.4,4.4,0,0,0,1.031,4.24l2.087,2.216" transform="translate(-133.54 -135.475)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path></g><path id="Path_48" data-name="Path 48" d="M192.668,233.37a2.8,2.8,0,0,0-1.568-2.67h3.137A2.8,2.8,0,0,0,192.668,233.37Z" transform="translate(-83.254 -116.684)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path><path id="Path_49" data-name="Path 49" d="M161.286,175.657l.174-.923a1.285,1.285,0,0,0-1.023-1.5l-2.568-.484" transform="translate(-54.382 -66.333)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path><path id="Path_50" data-name="Path 50" d="M168.288,176.056l-1.513-.286a1.284,1.284,0,0,1-1.023-1.5" transform="translate(-61.21 -67.654)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path><path id="Path_51" data-name="Path 51" d="M220.9,175.657l-.174-.923a1.285,1.285,0,0,1,1.023-1.5l2.568-.484" transform="translate(-108.971 -66.333)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path><path id="Path_52" data-name="Path 52" d="M220.87,176.056l1.513-.286a1.283,1.283,0,0,0,1.023-1.5" transform="translate(-109.119 -67.654)" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" fill="url(#linear-gradient1)"></path></g></svg>
                <? echo "Set i Løvens hule"; ?>
			</p>
		</div>
		<?
	}
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

