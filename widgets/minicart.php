<?php
add_action("wp_footer", function () {

	ob_start();
	?>
	<div id="miniCartContainer">
        <div class="miniCartContainer">
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            getCartContent();
            function getCartContent() {
                $.ajax({
                    type: 'POST',
                    url: '<? echo admin_url( 'admin-ajax.php' ); ?>',
                    data: {
                        action: 'get_cart_content'
                    },
                    success: function (response) {
                        document.querySelector("#miniCartContainer .miniCartContainer").innerHTML = response.data;
                        registerDeleteBtns();
                    },
                    error: function (response) {
                        console.log(response.statusText);
                    }
                });
            }

            function registerDeleteBtns() {
                document.querySelectorAll("#miniCartContainer .miniCartItems .removeItemFromCart").forEach((element) => {
                    element.addEventListener("click", function () {
                        jQuery.ajax({
                            type: 'POST',
                            url: '<? echo admin_url( 'admin-ajax.php' ); ?>',
                            data: {
                                action: 'remove_item_from_cart',
                                cartItemKey: this.value
                            },
                            success: function (response) {
                                if(response.success){
                                    console.log(response);
                                    getCartContent();
                                }
                                else {
                                    console.log(response);
                                }
                            },
                            error: function (response) {
                                console.log(response.statusText);
                            }
                        });
                    });
                });
            }
        });
    </script>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	echo $content;
});




