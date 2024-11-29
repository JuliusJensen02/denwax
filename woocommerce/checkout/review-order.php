<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

use Automattic\Jetpack\Constants;

defined( 'ABSPATH' ) || exit;
?>
<div class="headings">
    <h2><?php esc_html_e( 'Din ordre', 'hefa_child' ); ?></h2>
    <a href="https://denwax.com/kurv/">Redigér kurv</a>
    <svg xmlns="http://www.w3.org/2000/svg" width="11.318" height="22.093" viewBox="0 0 11.318 22.093"><path id="Pil_højre" data-name="Pil højre" d="M19.038,12.7,11.8,5.458A1.579,1.579,0,1,0,9.571,7.7l7.258,7.227a1.578,1.578,0,0,1,0,2.241L9.571,24.393A1.579,1.579,0,0,0,11.8,26.634l7.243-7.243A4.734,4.734,0,0,0,19.038,12.7Z" transform="translate(-9.104 -4.999)" fill="#202020"></path></svg>
</div>
<div class="products">
<?php
do_action( 'woocommerce_review_order_before_cart_contents' );

foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
        ?>
        <div class="product-row">
            <?php
                if($cart_item['variation_id'] != 0) {
                    $product_id = $cart_item['variation_id'];
                } else {
                    $product_id = $cart_item['product_id'];
                }
                $product   = wc_get_product($product_id);
                $image_id  = $product->get_image_id();
                $image_url = wp_get_attachment_image_url( $image_id, 'full' );
            ?>
            <img src="<?php echo $image_url; ?>" alt="<?php echo $product->get_name(); ?>">
            <div class="product-name">
                <?php echo $product->get_name(); ?>
                <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
            <div class="product-total">
                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
        </div>
        <?php
    }
}
?>
</div>

<div class="subtotal">
    <div><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
    <div><?php wc_cart_totals_subtotal_html(); ?></div>
</div>

<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
    <div class="coupon">
        <div><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
        <div><?php wc_cart_totals_coupon_html_custom( $coupon ); ?></div>
    </div>
<?php endforeach; ?>

<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
    <?php $shipping = WC()->cart->calculate_shipping();?>
    <div class="shipping">
        <div><?php echo $shipping[0]->label; ?></div>
        <div><?php echo $shipping[0]->cost." kr."; ?></div>
    </div>
<?php endif; ?>

<div class="total">
    <div><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
    <div><?php wc_cart_totals_order_total_html(); ?></div>
</div>

<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

<?php
/**
* Get coupon display HTML.
*
* @param string|WC_Coupon $coupon Coupon data or code.
*/
function wc_cart_totals_coupon_html_custom( $coupon ) {
if ( is_string( $coupon ) ) {
$coupon = new WC_Coupon( $coupon );
}

$discount_amount_html = '';

$amount               = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );
$discount_amount_html = '-' . wc_price( $amount );

if ( $coupon->get_free_shipping() && empty( $amount ) ) {
$discount_amount_html = __( 'Free shipping coupon', 'woocommerce' );
}

$discount_amount_html = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon );
$coupon_html          = $discount_amount_html . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', rawurlencode( $coupon->get_code() ), Constants::is_defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url() ) ) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr( $coupon->get_code() ) . '">' . __( 'x', 'woocommerce' ) . '</a>';

echo wp_kses( apply_filters( 'woocommerce_cart_totals_coupon_html', $coupon_html, $coupon, $discount_amount_html ), array_replace_recursive( wp_kses_allowed_html( 'post' ), array( 'a' => array( 'data-coupon' => true ) ) ) ); // phpcs:ignore PHPCompatibility.PHP.NewFunctions.array_replace_recursiveFound
}
?>