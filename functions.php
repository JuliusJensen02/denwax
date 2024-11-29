<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */

 add_action( 'wp_enqueue_scripts', 'hello_elementor_child_style' );
  function hello_elementor_child_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css',array('parent-style'));
}


add_action("wp_head", function() {
	echo '<script src="https://widget.emaerket.dk/js/dadcb47dc49fb8fe74754d2f226abd6f" async></script>';
});



add_filter( 'woocommerce_email_recipient_cancelled_order', 'bbloomer_cancelled_order_email_to_customer', 9999, 3 );
function bbloomer_cancelled_order_email_to_customer( $email_recipient, $email_object, $email ) {
   if ( is_admin() ) return $email_recipient;
   $email_recipient .= ', ' . $email_object->get_billing_email();
   return $email_recipient;
}

//Allow edit processing order
add_filter( 'wc_order_is_editable', 'bbloomer_custom_order_status_editable', 9999, 2 );
function bbloomer_custom_order_status_editable( $allow_edit, $order ) {
    if ( $order->get_status() === 'processing' ) {
        $allow_edit = true;
    }
    return $allow_edit;
}
/*HER*/
//Set shipping fields in order
add_action('woocommerce_checkout_update_order_meta', function ($order_id) {
	update_post_meta($order_id, '_shipping_custom_method', sanitize_text_field($_POST["shipping_method"][0]));
    if($_POST["shipping_method"][0] != "1_WS_PARCELSHOP_217"){
	    update_post_meta($order_id, '_shipping_first_name', sanitize_text_field(get_post_meta($order_id, '_billing_first_name', true)));
	    update_post_meta($order_id, '_shipping_last_name', sanitize_text_field(get_post_meta($order_id, '_billing_last_name', true)));
	    update_post_meta($order_id, '_shipping_address_1', sanitize_text_field(get_post_meta($order_id, '_billing_address_1', true)));
	    update_post_meta($order_id, '_shipping_address_2', sanitize_text_field(""));
	    update_post_meta($order_id, '_shipping_company', sanitize_text_field(get_post_meta($order_id, '_billing_company', true)));
	    update_post_meta($order_id, '_shipping_city', sanitize_text_field(get_post_meta($order_id, '_billing_city', true)));
	    update_post_meta($order_id, '_shipping_postcode', sanitize_text_field(get_post_meta($order_id, '_billing_postcode', true)));
    }
}, 999);


//Get cart content
function get_cart_content() {
    global $woocommerce;
    $items = $woocommerce->cart->get_cart();
    $array = array();
    foreach($items as $item){
        $product = wc_get_product($item['product_id']);
        $array[] = array(
            'key' => $item['key'],
            'id' => $item['product_id'],
            'name' => $product->get_name(),
            'price' => $product->get_price(),
            'quantity' => $item['quantity'],
            'total' => $product->get_price() * $item['quantity'],
            'image' => wp_get_attachment_image_src($product->get_image_id(), 'thumbnail')[0],
            'variationName' => $item["variation"]["attribute_stoerrelse"]
        );
    }
    ob_start();?>
	<div id="miniCartContainer">
        <div class="miniCartContainer">
            <svg id="miniCartClose" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><g transform="translate(0 0)"><path id="Path_33" data-name="Path 33" d="M8.826,7.5l5.9-5.9A.938.938,0,1,0,13.4.275h0l-5.9,5.9L1.6.275A.938.938,0,0,0,.275,1.6l5.9,5.9-5.9,5.9A.938.938,0,0,0,1.6,14.726l5.9-5.9,5.9,5.9A.938.938,0,0,0,14.726,13.4Z" transform="translate(0)" fill="#202020"/></g></svg>
            <h2><? _e("Kurv", "custom-minicart"); ?></h2>
            <div class="shippingNotice">
                <?
                if(WC()->cart->get_cart_contents_total() >= 300){
                    ?><b><? _e("Du har nu fri fragt til pakkeshop", "custom-minicart"); ?></b><?
                }
                else{
	                ?><b><? _e("Du er kun ", "custom-minicart"); ?><bdi><? echo 300-WC()->cart->get_cart_contents_total(); ?></bdi><? _e("kr fra at få fri fragt!", "custom-minicart"); ?></b>
	                <p><? _e("Tilføj flere varer og spar fragtprisen.", "custom-minicart"); ?></p><?
                }
                ?>
            </div>
            <div class="miniCartItems">
                <?
                foreach($array as $item){
                    ?>
                    <div class="miniCartItem">
                        <img src="<? echo $item['image']; ?>" alt="<? echo $item['name']; ?>">
                        <div class="miniCartItemInfo">
                            <p><? echo $item['name']; ?></p>
                            <p><? if(isset($item["variationName"])) echo $item["variationName"]; ?></p>
                            <p><? echo $item['quantity']; ?> x <? echo $item['price']; ?> kr</p>
                        </div>
                        <button class="removeItemFromCart" type="button" value="<? echo $item["key"]; ?>">Fjern</button>
                    </div>
                    <?
                }
                ?>
            </div>
            <div class="miniCartInfo">
                <div class="miniCartTotal">
                    <p><? _e("Varer", "custom-minicart"); ?></p>
                    <p><? echo WC()->cart->get_cart_contents_total(); ?> kr.</p>
                </div>
                <div class="miniCartShipping">
                    <p><? _e("Levering", "custom-minicart"); ?></p>
                    <p><? echo (WC()->cart->get_cart_shipping_total() == "Gratis!") ? "<strong>Gratis</strong>" : WC()->cart->get_cart_shipping_total(); ?></p>
                </div>
            </div>

        </div>
    </div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	wp_send_json_success($content);
	wp_die();
}
add_action('wp_ajax_get_cart_content', 'get_cart_content');
add_action('wp_ajax_nopriv_get_cart_content', 'get_cart_content');

//Remove item from cart
function remove_item_from_cart() {
	global $woocommerce;
	$cart_items = $woocommerce->cart->get_cart();
    $cartItemKey = $_POST['cartItemKey'];
	foreach ($cart_items as $cart_item_key => $cart_item) {
		$product_name = $cart_item['data']->get_name();
		if ( $cart_item_key == $cartItemKey ) {
			$woocommerce->cart->remove_cart_item( $cart_item_key );
			wp_send_json_success( $product_name );
            wp_die();
		}
	}
    wp_send_json_error("No item found");
    wp_die();
}
add_action('wp_ajax_remove_item_from_cart', 'remove_item_from_cart');
add_action('wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart');

//Material search
function material_search() {
	$search = $_POST['search'];
    $search = explode(" ", $search);

	$materials = get_posts([
		'post_type' => 'soeg',
		'post_status' => 'publish',
		'numberposts' => -1
	]);
    foreach ($materials as $material){
        foreach ($search as $word){
            if(str_contains(strtolower($word), strtolower($material->post_title))){
                $search[] = $material->post_title;
                break;
            }
        }
    }

	foreach ($search as $word){
		if(str_contains(strtolower($word), "alu")){
			$search[] = "Aluminium";
			break;
		}
	}

	$args = array(
		'post_type' => 'soeg',
		'posts_per_page' => -1,
		'meta_query' => array(
			'relation' => 'OR'
        ),
        'orderby' => array(
	        'title' => 'ASC'
        )
	);
    foreach ($search as $word){
        $args['meta_query'][] = array(
            'key' => 'keywords',
            'value' => strtolower($word),
            'compare' => 'LIKE'
        );
    }

	$query = new WP_Query($args);
	$response = array();
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
            $response[] = array(
                'title' => get_post_meta(get_the_ID(), 'title', true),
                'image' => get_post_meta(get_the_ID(), 'image', true),
                'short_desc' => get_post_meta(get_the_ID(), 'short_desc', true),
                'long_desc' => get_post_meta(get_the_ID(), 'long_desc', true),
                'keywords' => get_post_meta(get_the_ID(), 'keywords', true),
                'related_posts' => get_post_meta(get_the_ID(), 'related_posts', true),
                'link' => get_the_permalink()
            );
		}
		wp_reset_postdata();
		wp_send_json_success($response);
	} else {
		wp_send_json_error("No item found");
	}
	wp_die();
}
add_action('wp_ajax_material_search', 'material_search');
add_action('wp_ajax_nopriv_material_search', 'material_search');



require_once "script-handler.php";
require_once "widget-handler.php";

add_action("wp", function (){
	if(is_post_type_archive("soeg")){
		add_action("wp_head", function (){?>
            <style>#header-nav{
                    display: none;
                }</style>
        <? });
	}
});

function remove_url_from_body_tag($html) {
	// Remove the URL from the body tag
	$html = str_replace('>https://denwax.com/', '>', $html);
	return $html;
}

function start_buffering_body_tag() {
	ob_start('remove_url_from_body_tag');
}

function end_buffering_body_tag() {
	ob_end_flush();
}

add_action('wp_head', 'start_buffering_body_tag', 0);
add_action('wp_footer', 'end_buffering_body_tag', 9999);

/*Tracking*/
add_action( 'wp_footer', function () { ?>
	<!-- Facebook Pixel Code -->
	<script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '816109728730537');
        fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	               src="https://www.facebook.com/tr?id=816109728730537&ev=PageView&noscript=1"
		/></noscript>
	<!-- End Facebook Pixel Code -->
	<!-- Other -->
	<script type='text/javascript'>
        var axel = Math.random() + '';
        var a = axel * 10000000000000;
        document.write('<img style="display:none;" src="https://pubads.g.doubleclick.net/activity;dc_iu=/5706918/DFPAudiencePixel;ord=' + a + ';dc_seg=744933825?" width=1 height=1 border=0/>');
	</script>

	<noscript>
		<img style="display:none;" src="https://pubads.g.doubleclick.net/activity;dc_iu=/5706918/DFPAudiencePixel;ord=1;dc_seg=744933825?" width=1 height=1 border=0/>
	</noscript>
	<img src="https://makeinfluence.com/p?bid=b3fb2eee-e2d2-11ea-be7c-9681f5067383&value={order_subtotal}&uid={order_number}">
<?php } );



/*Disable shop page*/
function woocommerce_disable_shop_page() {
	if (is_shop()):
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
	endif;
}
add_action( 'wp', 'woocommerce_disable_shop_page' );



/*add_action('woocommerce_checkout_billing', 'checkout_additional_checkboxes');
function checkout_additional_checkboxes( ){
?>
<p class="form-row validate-required">
    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
        <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="correctInfo" id="correctInfo" required="required" />
        <span class="woocommerce-terms-and-conditions-checkbox-text"><?php _e("Bekræft at dine indtastede oplysninger er korrekte", "hefa_theme"); ?></span>&nbsp;<abbr class="required" title="<?php esc_attr_e( 'required', 'woocommerce' ); ?>">*</abbr>
    </label>
</p>
<?php
}

add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    if ( ! $_POST['correctInfo'] )
        wc_add_notice( __( 'Du mangler at bekræfte dine oplysninger.' ), 'error' );
}*/



add_filter( 'woocommerce_email_attachments', 'bbloomer_attach_pdf_to_emails', 10, 4 );

function bbloomer_attach_pdf_to_emails( $attachments, $email_id, $order, $email ) {
	$email_ids = array( 'new_order', 'customer_processing_order' );
	if ( in_array ( $email_id, $email_ids ) ) {
		$upload_dir = wp_upload_dir();
		$attachments[] = $upload_dir['basedir'] . "/2024/10/Handelsbetingelser.pdf";
	}
	return $attachments;
}
