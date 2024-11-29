<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_payment_custom', 'woocommerce_checkout_payment', 20 );


?>
<div id="checkoutPageWrap">
    <div id="checkoutPage">
        <div id="leftCheckout">
            <?php
            if(isset($_GET["e"])){ ?>
                <div class="woocommerce-error">
                    <?php _e("Vælg udleveringssted til pakkeshop.", "custom-string"); ?>
                </div>
            <?php }
            ?>
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
                <?php if ( $checkout->get_checkout_fields() ) : ?>
                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                        <div id="myInformation" class="accordion accordion-open">
                            <div class="heading">
                                <h2 class="number">1</h2>
                                <h2 class="text"><?php _e("Mine oplysninger", "hefa_theme"); ?></h2>
                                <svg xmlns="http://www.w3.org/2000/svg" width="11.318" height="22.093" viewBox="0 0 11.318 22.093"><path id="Pil_højre" data-name="Pil højre" d="M19.038,12.7,11.8,5.458A1.579,1.579,0,1,0,9.571,7.7l7.258,7.227a1.578,1.578,0,0,1,0,2.241L9.571,24.393A1.579,1.579,0,0,0,11.8,26.634l7.243-7.243A4.734,4.734,0,0,0,19.038,12.7Z" transform="translate(-9.104 -4.999)" fill="#202020"></path></svg>
                            </div>
                            <div class="container">
                                <?php do_action( 'woocommerce_checkout_billing' ); ?>
                                <p class="form-row validate-required">
                                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                        <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="correctInfo" id="correctInfo" required="required" />
                                        <span class="woocommerce-terms-and-conditions-checkbox-text"><?php _e("Bekræft at dine indtastede oplysninger er korrekte", "hefa_theme"); ?></span>&nbsp;<abbr class="required" title="<?php esc_attr_e( 'required', 'woocommerce' ); ?>">*</abbr>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div id="shippingInfo" class="accordion">
                            <div class="heading">
                                <h2 class="number">2</h2>
                                <h2 class="text"><?php _e("Vælg leveringsmetode", "hefa_theme"); ?></h2>
                                <svg xmlns="http://www.w3.org/2000/svg" width="11.318" height="22.093" viewBox="0 0 11.318 22.093"><path id="Pil_højre" data-name="Pil højre" d="M19.038,12.7,11.8,5.458A1.579,1.579,0,1,0,9.571,7.7l7.258,7.227a1.578,1.578,0,0,1,0,2.241L9.571,24.393A1.579,1.579,0,0,0,11.8,26.634l7.243-7.243A4.734,4.734,0,0,0,19.038,12.7Z" transform="translate(-9.104 -4.999)" fill="#202020"></path></svg>
                            </div>
                            <div class="container">
                                    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() && is_array(WC()->shipping()->get_packages()) ) : ?>
                                        <?php wc_cart_totals_shipping_html(); ?>
                                    <?php endif; ?>
                                    <div id="chosenShippingMethod">
                                        <?php do_action('woocommerce_review_order_before_order_total'); ?>
                                    </div>
                            </div>
                        </div>
                        <div id="paymentInfo" class="accordion">
                            <div class="heading">
                                <h2 class="number">3</h2>
                                <h2 class="text"><?php _e("Betaling", "hefa_theme"); ?></h2>
                                <svg xmlns="http://www.w3.org/2000/svg" width="11.318" height="22.093" viewBox="0 0 11.318 22.093"><path id="Pil_højre" data-name="Pil højre" d="M19.038,12.7,11.8,5.458A1.579,1.579,0,1,0,9.571,7.7l7.258,7.227a1.578,1.578,0,0,1,0,2.241L9.571,24.393A1.579,1.579,0,0,0,11.8,26.634l7.243-7.243A4.734,4.734,0,0,0,19.038,12.7Z" transform="translate(-9.104 -4.999)" fill="#202020"></path></svg>
                            </div>
                            <div class="container">
                                <?php do_action( 'woocommerce_checkout_payment_custom' ); ?>
                            </div>
                        </div>

                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <?php endif; ?>
            </form>
        </div>
        <div id="rightCheckout">
            <?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
            <div id="order_review">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
            <div class="icon-text-list">
                <div class="icon-text-list-item">
                    <div class="icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="60" viewBox="0 0 60 60"><defs><clipPath id="clip-path"><path id="path2803" d="M0-682.665H40v40H0Z" transform="translate(0 682.665)" fill="#202020"></path></clipPath></defs><g id="Fragt_og_levering" data-name="Fragt og levering" transform="translate(-1149 -325)"><circle id="Ellipse_17" data-name="Ellipse 17" cx="30" cy="30" r="30" transform="translate(1149 325)" fill="#f2eeea"></circle><g id="express-delivery" transform="translate(1159 334.998)"><g id="g2793" transform="translate(0 0.002)"><g id="g2795" transform="translate(15.8 28.948)"><path id="path2797" d="M-203.159,0H-215.8" transform="translate(215.803)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2799"><g id="g2801" clip-path="url(#clip-path)"><g id="g2807" transform="translate(26.605 13.852)"><path id="path2809" d="M-153.258-242.547h2.684v-8.15l-6.722-6.946h-5.5v15.022" transform="translate(162.797 257.643)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2811" transform="translate(26.604 20.798)"><path id="path2813" d="M-196.393,0h-12.224" transform="translate(208.617)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2815" transform="translate(8.334 25.039)"><path id="path2817" d="M-17.263-17.264a3.668,3.668,0,0,1,5.188,0,3.669,3.669,0,0,1,0,5.188,3.668,3.668,0,0,1-5.188,0A3.669,3.669,0,0,1-17.263-17.264Z" transform="translate(18.338 18.339)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2819" transform="translate(28.781 25.039)"><path id="path2821" d="M-17.263-17.264a3.668,3.668,0,0,1,5.188,0,3.669,3.669,0,0,1,0,5.188,3.668,3.668,0,0,1-5.188,0A3.669,3.669,0,0,1-17.263-17.264Z" transform="translate(18.337 18.339)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2823" transform="translate(4.872 7.624)"><path id="path2825" d="M0,0V21.311H3.31" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2827" transform="translate(4.872 7.624)"><path id="path2829" d="M-349.705-100.219v-6.238h-21.766" transform="translate(371.471 106.457)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2831" transform="translate(4.872 7.624)"><path id="path2833" d="M-130.637,0h-8.131" transform="translate(138.768)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2835" transform="translate(2.813 12.312)"><path id="path2837" d="M-163.718,0h-10.19" transform="translate(173.908)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g><g id="g2839" transform="translate(1.172 17.001)"><path id="path2841" d="M-176.272,0h-10.971" transform="translate(187.243)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path></g></g></g></g></g></g></svg>
                    </div>
                    <div class="text-container">
                        <h3><?php _e("Fragt og levering", "hefa_theme"); ?></h3>
                        <p><?php _e("Fri fragt til GLS pakkeshop v. køb fra 350 kr. Mulighed for andre forsendelsesmuligheder og afhentning v. aftale.", "hefa_theme"); ?></p>
                    </div>
                </div>
                <div class="icon-text-list-item">
                    <div class="icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"><g id="_14_dages_fri_returret" data-name="14 dages fri returret" transform="translate(-1149 -325)"><circle id="Ellipse_17" data-name="Ellipse 17" cx="30" cy="30" r="30" transform="translate(1149 325)" fill="#f2eeea"></circle><g id="two-thin-arrows-forming-a-circle" transform="translate(1046 257.262)"><g id="Group_175" data-name="Group 175" transform="translate(113 81.738)"><path id="Path_34" data-name="Path 34" d="M30.892,94.447a15.407,15.407,0,0,1-26.3-10.878l3.142,3.146a.531.531,0,0,0,.751-.751L4.32,81.8.156,85.964a.53.53,0,0,0,0,.751.53.53,0,0,0,.749,0L3.55,84.069A16.457,16.457,0,0,0,31.64,95.2a.531.531,0,0,0,0-.75A.525.525,0,0,0,30.892,94.447Z" transform="translate(0 -67.022)" fill="#010002"></path><path id="Path_35" data-name="Path 35" d="M68.492,29.045a.531.531,0,0,0-.75,0L65.1,31.69A16.459,16.459,0,0,0,37.007,20.562a.53.53,0,0,0,.75.75A15.409,15.409,0,0,1,64.06,32.19l-3.144-3.146a.531.531,0,0,0-.751.751l4.165,4.165L68.494,29.8A.531.531,0,0,0,68.492,29.045Z" transform="translate(-28.609 -15.738)" fill="#010002"></path></g></g></g></svg>
                    </div>
                    <div class="text-container">
                        <h3><?php _e("14 dages fri returret", "hefa_theme"); ?></h3>
                        <p><?php _e("Du har 14 dages fuld returret v. køb af produkter på vores webshop.", "hefa_theme"); ?></p>
                    </div>
                </div>
                <div class="icon-text-list-item">
                    <div class="icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"><g id="Sikker_online_betaling" data-name="Sikker online betaling" transform="translate(-1149 -325)"><circle id="Ellipse_17" data-name="Ellipse 17" cx="30" cy="30" r="30" transform="translate(1149 325)" fill="#f2eeea"></circle><g id="Credit_Card" transform="translate(1141 283)"><path id="Path_36" data-name="Path 36" d="M50.053,194.4a3.067,3.067,0,0,1-3.067,3.067H23.067A3.067,3.067,0,0,1,20,194.4V179.067A3.067,3.067,0,0,1,23.067,176h23.92a3.067,3.067,0,0,1,3.067,3.067Z" transform="translate(0 -110.8)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path><path id="Path_37" data-name="Path 37" d="M100,59.067A3.067,3.067,0,0,1,103.067,56h23.92a3.067,3.067,0,0,1,3.067,3.067V74.4a3.067,3.067,0,0,1-3.067,3.067H123.92" transform="translate(-73.867 0)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></path><line id="Line_24" data-name="Line 24" x2="24" transform="translate(26 71)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></line><line id="Line_25" data-name="Line 25" x2="6" transform="translate(38 80)" fill="none" stroke="#202020" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1"></line></g></g></svg>
                    </div>
                    <div class="text-container">
                        <h3><?php _e("Sikker online betaling", "hefa_theme"); ?></h3>
                        <p><?php _e("Du kan betale sikkert via. kortbetaling eller mobilepay på vores webshop.", "hefa_theme"); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>