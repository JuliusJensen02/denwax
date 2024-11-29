<?php
add_action('wp_head','prevent_access_to_product_page');
function prevent_access_to_product_page(){
    if (get_the_ID() == 8946) {
        wp_redirect(site_url());
    }
}

add_action( 'wp_footer', function () { ?>
    <script>
        jQuery(document).ready(function($){
            <?php
            //if(is_user_logged_in()) {?>
            if(document.querySelector("#jet-popup-9963 #Faa_rabat_popup button")){
                document.querySelector("#jet-popup-9963 #Faa_rabat_popup button").addEventListener("click", function(){
                    document.querySelector("#jet-popup-9963 .jet-popup__close-button").click();
                });
            }


	            /*Header*/
                $(".headerMenu .menuItem").hover( function() {
                    $(this).addClass("hover");
                }, function(){
                    $(this).removeClass("hover");
                });

            <?php //}
            ?>

            /*Add to cart*/
            function rudrAddToCart( product_id, quantity = 1, ) {

                // let's check is add-to-cart.min.js is enqueued and parameters are presented
                if ( 'undefined' === typeof wc_add_to_cart_params ) {
                    return false;
                }

                jQuery.post(
                    wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'add_to_cart' ),
                    {
                        product_id: product_id,
                        quantity: quantity,
                    },
                    function( response ) {
                        if ( ! response ) {
                            return;
                        }
                        // redirect is optional and it depends on what is set in WooCommerce configuration
                        if ( response.error && response.product_url ) {
                            window.location = response.product_url;
                            return;
                        }
                        if ( 'yes' === wc_add_to_cart_params.cart_redirect_after_add ) {
                            window.location = wc_add_to_cart_params.cart_url;
                            return;
                        }
                        // refresh cart fragments etc
                        $("#elementor-menu-cart__toggle_button").click();
                        jQuery( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash ] );
                    }
                );
            }
            $('#buy-perfect-set').click(function(e) {
                e.preventDefault();
                rudrAddToCart(8946);
                $("#buy-perfect-set>span>span>svg").remove();
                $("#buy-perfect-set>span>span").html("<? _e("Tilføjet!", "custom-string"); ?>")
                $("#buy-perfect-set>span>span").append('<svg xmlns="http://www.w3.org/2000/svg" width="13.875" height="10.016" viewBox="0 0 13.875 10.016"><g id="Flueben_hvij" data-name="Flueben hvij" transform="translate(0 -73.638)"><path id="Path_32" data-name="Path 32" d="M4.48,80.589a1.483,1.483,0,0,1-1.05-.435L.256,76.981a.875.875,0,0,1,0-1.237h0a.875.875,0,0,1,1.237,0L4.48,78.731l7.9-7.9a.875.875,0,0,1,1.237,0h0a.875.875,0,0,1,0,1.237L5.53,80.154A1.483,1.483,0,0,1,4.48,80.589Z" transform="translate(0 3.065)" fill="#fff"/></g></svg>');
                return false;
            });

        });
    </script>
<?php } );