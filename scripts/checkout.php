<?php
	add_filter( 'woocommerce_cart_item_name', 'ywp_product_image_on_checkout', 10, 3 );
	function ywp_product_image_on_checkout( $name, $cart_item, $cart_item_key ) {

		if (!is_checkout())
			return $name;

		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

		$thumbnail = $_product->get_image();

		$image = '<div class="ywp-product-image" style="width: 52px; height: 45px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
		         . $thumbnail .
		         '</div>';

		return $image . $name;
	}

    function update_shipping() {
        ob_start();
	    do_action('woocommerce_review_order_before_order_total');
        echo ob_get_clean();
        wp_die();
    }
    add_action( 'wp_ajax_update_shipping_method', 'update_shipping' );
    add_action( 'wp_ajax_nopriv_update_shipping_method', 'update_shipping' );


    function update_order_review() {
        ob_start();
	    do_action( 'woocommerce_checkout_order_review' );
        echo ob_get_clean();
        wp_die();
    }
    add_action( 'wp_ajax_update_order_review', 'update_order_review' );
    add_action( 'wp_ajax_nopriv_update_order_review', 'update_order_review' );



add_action('wp_enqueue_scripts', 'enqueue_frontend_custom');

function enqueue_frontend_custom() {
	if (!function_exists('is_woocommerce') && !is_cart() && !is_checkout()) {
		return;
	}

	wp_register_script("webshipper_drop_point_custom", get_stylesheet_directory_uri()."/js/drop_point.js", array('jquery'), WebshipperAPI::VERSION, false);
	wp_enqueue_script("webshipper_drop_point_custom");

	$webshipper_nonce = wp_create_nonce("webshipper_nonce");
	wp_localize_script("webshipper_drop_point", "webshipper_ajax_object", array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'webshipper_nonce' => $webshipper_nonce
	));
}

add_action( 'wp_footer', function () {
		if(get_the_ID() == 6705 || get_the_ID() == 7931 || is_checkout()){
            /*if(!is_user_logged_in() && $_SERVER['REMOTE_ADDR'] != "192.38.10.2"){
                wp_redirect("https://denwax.com/");
            }*/ ?>
			<script>
                jQuery(document).ready(function($){
                    //$("#shipping_method li:last-child").remove();
                    /*waitForElm("#leftCheckout #paymentInfo #correctInfo").then((correctInfo) => {
                        waitForElm("#leftCheckout #paymentInfo #place_order").then((placeOrder) => {
                            if(correctInfo.checked == false){
                                placeOrder.disabled = true;
                            }
                            console.log(correctInfo);
                            console.log(placeOrder);
                            correctInfo.addEventListener("change", function(){
                                if(correctInfo.checked == false){
                                    placeOrder.disabled = true;
                                }
                                else{
                                    placeOrder.disabled = false;
                                }
                                console.log(placeOrder.disabled);
                            });
                        });
                    });*/

                    let correctInfo = document.getElementById("correctInfo");
                    document.querySelector("#billing_email").value = localStorage.getItem("billing_email");
                    document.querySelector("#billing_repeat_email").value = localStorage.getItem("billing_repeat_email");
                    document.querySelector("#billing_first_name").value = localStorage.getItem("billing_first_name");
                    document.querySelector("#billing_last_name").value = localStorage.getItem("billing_last_name");
                    document.querySelector("#billing_company").value = localStorage.getItem("billing_company");
                    document.querySelector("#billing_address_1").value = localStorage.getItem("billing_address_1");
                    document.querySelector("#billing_postcode").value = localStorage.getItem("billing_postcode");
                    document.querySelector("#billing_city").value = localStorage.getItem("billing_city");
                    document.querySelector("#billing_phone").value = localStorage.getItem("billing_phone");

                    document.querySelector("#billing_email").addEventListener("input", function(){
                        localStorage.setItem("billing_email", this.value);
                    });
                    document.querySelector("#billing_repeat_email").addEventListener("input", function(){
                        localStorage.setItem("billing_repeat_email", this.value);
                    });
                    document.querySelector("#billing_first_name").addEventListener("input", function(){
                        localStorage.setItem("billing_first_name", this.value);
                    });
                    document.querySelector("#billing_last_name").addEventListener("input", function(){
                        localStorage.setItem("billing_last_name", this.value);
                    });
                    document.querySelector("#billing_company").addEventListener("input", function(){
                        localStorage.setItem("billing_company", this.value);
                    });
                    document.querySelector("#billing_address_1").addEventListener("input", function(){
                        localStorage.setItem("billing_address_1", this.value);
                    });
                    document.querySelector("#billing_postcode").addEventListener("input", function(){
                        localStorage.setItem("billing_postcode", this.value);
                    });
                    document.querySelector("#billing_city").addEventListener("input", function(){
                        localStorage.setItem("billing_city", this.value);
                    });
                    document.querySelector("#billing_phone").addEventListener("input", function(){
                        localStorage.setItem("billing_phone", this.value);
                    });

                    if(document.querySelector("#shipping_method li:first-child label").textContent == "GLS Pakkeshop"){
                        document.querySelector("#shipping_method li:first-child label").innerHTML = 'GLS Pakkeshop <span class="woocommerce-Price-amount amount">Gratis</span>';
                    }

                    jQuery('body').on('update_checkout', function(){
                        document.querySelector("#order_review .total").style.opacity = "0.5";
                        document.querySelector("#order_review .total bdi").innerHTML = "Opdaterer...";
                    });

                    jQuery('body').on('applied_coupon_in_checkout', function(){
                        document.querySelector("#order_review .total").style.opacity = "1";
                    });

					setInterval(function(){
						$("#billing_postcode").click();
						$("#billing_postcode").keyup();
						$("#billing_postcode").keydown();
						$("#billing_postcode").trigger("input");
						$("#billing_postcode").val($("#billing_postcode").val());
					}, 1000);

                    $("#rightCheckout #order_review .headings").click(function(){
                        $("#rightCheckout #order_review").toggleClass("open");
                    });

                    $("#leftCheckout .accordion .heading").click(function(e){
                        if(correctInfo.checked === false){
                            e.preventDefault();
                            correctInfo.nextSibling.nextSibling.style.color = "red";
                            return;
                        }
                        $(".accordion-open").removeClass("accordion-open");
                        $(this).closest(".accordion").addClass("accordion-open");
                        let mobileOffset = 0;
                        if(window.innerWidth <= 767){
                            mobileOffset = 100;
                        }
                        setTimeout(function(){
                            $('html, body').animate({
                                scrollTop: $(".accordion-open").offset().top - mobileOffset
                            }, 300);
                        }, 510);
                    });
                    $(document.body).on("updated_checkout", function(){
                        $.ajax({
                            type: "POST",
                            url: "/wp-admin/admin-ajax.php",
                            data: {
                                action: "update_shipping_method"
                            },
                            success: function(data){
                                if(document.getElementById("chosenShippingMethod").childNodes.length <= 1) {
                                    document.getElementById("chosenShippingMethod").style.display = "flex";
                                    document.getElementById("chosenShippingMethod").innerHTML = data;
                                }
                            },
                            error: function(data){
                                console.log(data);
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "/wp-admin/admin-ajax.php",
                            data: {
                                action: "update_order_review"
                            },
                            success: function(data){
                                document.getElementById("order_review").innerHTML = data;
                                let shippingPriceElm = document.querySelector("#order_review .shipping div:last-child");
                                if(shippingPriceElm.textContent == "0 kr."){
                                    shippingPriceElm.textContent = "Gratis";
                                }
                                $("#rightCheckout #order_review .headings").click(function(){
                                    $("#rightCheckout #order_review").toggleClass("open");
                                });
                            }
                        });
                        let shippingPriceElm = document.querySelector("#order_review .shipping div:last-child");
                        if(shippingPriceElm.textContent == "0 kr."){
                            shippingPriceElm.textContent = "Gratis";
                        }
                        let shippingMethodDropDownCtn = document.getElementById("chosenShippingMethod");
                        if(shippingMethodDropDownCtn){
                            if(document.querySelector("#shipping_method input:checked").value == "1_WS_PARCELSHOP_217"){
                                shippingMethodDropDownCtn.style.display = "flex";
                            }
                            else{
                                shippingMethodDropDownCtn.style.display = "none";
                            }
                        }
                    });
                    document.querySelector("#leftCheckout form").addEventListener("submit", function(e){
                        e.preventDefault();
                        let requiredFilled = true;
                        document.querySelectorAll("#leftCheckout form p").forEach((elm) => {
                            if(elm.querySelector(".required")){
                                if(elm.querySelector("input").value == ""){
                                    requiredFilled = false;
                                }
                            }
                        });
                    });
                    let shippingMethodDropDownCtn = document.getElementById("chosenShippingMethod");
                    if(shippingMethodDropDownCtn){
                        if(document.querySelector("#shipping_method input:checked").value == "1_WS_PARCELSHOP_217"){
                            shippingMethodDropDownCtn.style.display = "flex";
                        }
                        else{
                            shippingMethodDropDownCtn.style.display = "none";
                        }
                    }
                    document.querySelectorAll("#shipping_method input").forEach((elm) => {
                        elm.addEventListener("change", function(){
                            let shippingMethodDropDownCtn = document.getElementById("chosenShippingMethod");
                            if(shippingMethodDropDownCtn){
                                if(document.querySelector("#shipping_method input:checked").value == "1_WS_PARCELSHOP_217"){
                                    shippingMethodDropDownCtn.style.display = "flex";
                                }
                                else{
                                    shippingMethodDropDownCtn.style.display = "none";
                                }
                            }
                        });
                    });
                });

                function waitForElm(selector) {
                    return new Promise(resolve => {
                        if (document.querySelector(selector)) {
                            return resolve(document.querySelector(selector));
                        }

                        const observer = new MutationObserver(mutations => {
                            if (document.querySelector(selector)) {
                                resolve(document.querySelector(selector));
                                observer.disconnect();
                            }
                        });

                        observer.observe(document.body, {
                            childList: true,
                            subtree: true
                        });
                    });
                }
			</script>
		<?php }} );