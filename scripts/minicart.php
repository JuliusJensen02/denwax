<?php

	add_action( 'wp_footer', function () {
		if(get_the_ID() != 6705){?>
			<style>
                /*Mini cart bundles*/


                .woosb-cart-child .elementor-menu-cart__product-price{
                    display: none !important;
                }

                .woosb-cart-child .elementor-menu-cart__product-image{
                    width: 80%;
                }

                #header-nav .woosb-cart-child .elementor-menu-cart__product-name a, .woosb-cart-child .elementor-menu-cart__product-variation{
                    font-size: 13px !important;
                }

                #header-nav .woosb-cart-child .elementor-menu-cart__product-name, .woosb-cart-child .elementor-menu-cart__product-variation{
                    padding-left: 0 !important;
                    line-height: 1em;
                }

                #header-nav .woosb-cart-child .elementor-menu-cart__product-name{
                    margin-top: 5px;
                }

                .woosb-cart-child{
                    padding-left: 20px !important;
                    padding-top: 5px !important;
                    padding-bottom: 5px !important;
                }

                .woosb-item-parent{
                    padding-bottom: 10px !Important;
                }

                .woosb-item-parent .elementor-menu-cart__product-image{
                    overflow: hidden;
                }

                .woosb-item-parent .elementor-menu-cart__product-image a{
                    height: 100%;
                }

                .woosb-item-parent .elementor-menu-cart__product-image img{
                    height: 100%;
                    object-fit: cover;
                }
			</style>
			<script>
                jQuery(document).ready(function($){
                    /***************Fri fragt ændring***************/
                    var shipping = 350;
                    var price_mini_cart, firstTime=0, last=0, run=false;
                    /***********************************************/


                    /***************Timeout for focus***************/
                    var wait = 100;
                    var timeout = 3000+wait;
                    /***********************************************/


                    /***********Fri fragt one time insert***********/
                    $(".elementor-menu-cart__main .elementor-menu-cart__close-button").after("<div id='shipping-check-box-mini-cart'><div><b></b><p></p></div></div>");
                    /***********************************************/

                    /***********************************************/
                    $("#mini-cart-lower-listing").insertAfter(".elementor-menu-cart__main .widget_shopping_cart_content").show();
                    $("#mini-cart-upper-listing").insertAfter(".elementor-menu-cart__main .widget_shopping_cart_content").show();
                    $("#mini-cart-lower-listing form").each(function(){
                        $(this).removeAttr("action");
                    });

                    $("#mini-cart-upper-listing form").each(function(){
                        $(this).removeAttr("action");
                    });
                    /***********************************************/
                    $("#elementor-menu-cart__toggle_button").after("<h3 class='cart-text'><span><? _e("Kurv", "custom-string"); ?></span></h3>");
                    $("#menu-1-e87011d a").after("<h3 class='lang-text'><span><? _e("Sprog", "custom-string"); ?></span></h3>");



                    waitForElm("#header-lang").then((elm) => {
                        let langes = elm.querySelectorAll("a");
                        let lang1 = langes[0].href;
                        let lang2 = langes[1].href;
                        langes[0].href = lang2;
                        langes[1].href = lang1;
                    });


                    waitForElm('.elementor-menu-cart__main .elementor-menu-cart__subtotal .woocommerce-Price-amount bdi').then((elm) => {
                        update_cart_content();

                        firstTime=1;

                        setInterval(function(){
                            update_cart_content();
                        },100);

                        $(document.body).on('removed_from_cart added_to_cart adding_to_cart cart_page_refreshed cart_totals_refreshed', function(){
                            setTimeout(function(){
                                update_cart_content();
                            },10);
                        });
                        $(document.body).on('added_to_cart', function(response){
                            $.ajax({
                                type: 'POST',
                                url: '<? echo admin_url('admin-ajax.php'); ?>',
                                data: {
                                    action: 'get_cart_content'
                                },
                                success: function(response) {
                                    console.log(response);
                                }.bind(this)
                            });
                        });
                    });








                    function update_cart_content(){
                        let empty = 0;
                        $(".widget_shopping_cart_content>div").each(function(){
                            if($(this).hasClass("woocommerce-mini-cart__empty-message")){
                                empty = 1;
                            }
                        });

                        if(empty){
                            $("#shipping-check-box-mini-cart").hide();
                            $("#mini-cart-upper-listing").hide();
                            $("#mini-cart-lower-listing").hide();
                        }
                        else if(!empty){
                            $("#shipping-check-box-mini-cart").show();
                            $("#mini-cart-upper-listing").show();
                            $("#mini-cart-lower-listing").show();
                        }

                        if($(".elementor-menu-cart__products").hasClass("updated")){}
                        else if(!empty){
                            $(".elementor-menu-cart__products").addClass("updated");
                            $(".elementor-button--checkout>span").html("<? _e("Gå til kassen", "custom-string"); ?>");
                            $(".elementor-menu-cart__main .remove_from_cart_button").each(function(){
                                $(this).html("<? _e("Fjern", "custom-string"); ?>");
                            });

                            $(".elementor-menu-cart__main .elementor-menu-cart__product-name").each(function(){
                                var text = $(this).find("a").html().split(/-(.*)/s);
                                if(text[1] != undefined){
                                    $(this).after("<div class='elementor-menu-cart__product-variation'>" + text[1] + "</div>");
                                    $(this).find("a").html(text[0]);
                                }
                            });
                            $(".elementor-menu-cart__subtotal strong").html("Total");



                            price_mini_cart = parseInt($(".elementor-menu-cart__main .elementor-menu-cart__subtotal .woocommerce-Price-amount bdi").html().split(/<(.*)/s)[0].replace(".", ""));
                            let price = price_mini_cart;

                            price_mini_cart = shipping-price_mini_cart;

                            if(price_mini_cart <= 0){
                                $("#shipping-check-box-mini-cart b").html("<? _e("Du har nu fri fragt til pakkeshop", "custom-string"); ?>");
                                $("#shipping-check-box-mini-cart p").html("");

                                $(".elementor-menu-cart__subtotal").before("<div id='mini-cart-subtotal-custom'><div><p><? _e("Varer", "custom-string"); ?></p><p id='mini-cart-price'></p></div><div><p>Levering</p><p class='bold'>Gratis</p></div></div>");
                                $(".elementor-menu-cart__main .elementor-menu-cart__subtotal .woocommerce-Price-amount bdi").html(parseInt(price) + " <span class='woocommerce-Price-currencySymbol'>kr.</span>");
                                $("#shipping-check-box-mini-cart").addClass("active");
                                if(firstTime && last != 1){
                                    focus_box();
                                }
                                last=1;
                            }
                            else{
                                $("#shipping-check-box-mini-cart b").html("<? _e("Du er kun", "custom-string") ?> <bdi>"+price_mini_cart+"</bdi>kr <? _e("fra at få fri fragt!", "custom-string"); ?>");
                                $("#shipping-check-box-mini-cart p").html("<? _e("Tilføj flere varer og spar fragtprisen.", "custom-string"); ?>");

                                $(".elementor-menu-cart__subtotal").before("<div id='mini-cart-subtotal-custom'><div><p>Varer</p><p id='mini-cart-price'></p></div><div><p><? _e("Levering", "custom-string"); ?></p><p>45 kr.</p></div></div>");
                                $(".elementor-menu-cart__main .elementor-menu-cart__subtotal .woocommerce-Price-amount bdi").html(parseInt(price+45) + " <span class='woocommerce-Price-currencySymbol'>kr.</span>");
                                $("#shipping-check-box-mini-cart").removeClass("active");
                                if(firstTime && last != 2){
                                    focus_box();
                                }
                                last=2;
                            }
                            $("#mini-cart-price").html(price + " kr.");
                        }
                    }

                    function focus_box(){
                        setTimeout(function(){
                            $("#shipping-check-box-mini-cart").addClass("focus");
                        }, wait);

                        setTimeout(function(){
                            $("#shipping-check-box-mini-cart").removeClass("focus");
                        }, timeout);
                    }

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

                });
			</script>
		<?php }} );