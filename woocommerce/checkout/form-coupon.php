<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<h2 class="coupon-heading"><?php _e("Har du en rabatkode?", "hefa_custom"); ?></h2>

<form class="checkout_coupon" method="post">
    <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Skriv her..', 'hefa_custom' ); ?>" id="coupon_code" value="" />
    <button type="submit" class="button" name="apply_coupon" value="1"><?php esc_html_e( 'Anvend', 'hefa_custom' ); ?></button>
</form>
