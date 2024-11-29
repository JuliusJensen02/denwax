<?php
	add_action( 'wp_footer', function () { ?>
		<style>
            .open-listing-item{
                z-index: 999999;
            }
		</style>
		<script>
            jQuery(document).ready(function($){
                $(document).on("click", ".variation-popup-open", function(){
                    $(".variation-popup").hide();
                    $(this).next(".variation-popup").show();
                    $(this).closest(".jet-listing-grid__item").addClass("open-listing-item");
                });

                $(document).on("click", ".variation-popup-close", function(){
                    $(this).closest(".variation-popup").hide();
                    $(".open-listing-item .variation-after-buttons").hide();
                    $(this).closest(".jet-listing-grid__item").removeClass("open-listing-item");
                });

                /*$(document).on("click", ".variation-popup-close", function(){
					$(this).closest(".variation-popup").hide();
					$(".open-listing-item .variation-after-buttons").hide();
					$(this).closest(".jet-listing-grid__item").removeClass("open-listing-item");
				});*/

                $(document).on("click", ".close-product-popup", function(){
                    $(this).closest(".variation-popup").hide();
                    $(".open-listing-item .variation-after-buttons").hide();
                    $(this).closest(".jet-listing-grid__item").removeClass("open-listing-item");
                });

                $(document).on("click", ".variation-popup>div>div", function(e){
                    e.stopPropagation();
                });

                $(document.body).on("added_to_cart", function(){
                    setTimeout(function(){
                        $(".single_add_to_cart_button.added").html("<? _e("Tilføj til kurv", "custom-string"); ?>");
                        //document.querySelector(".open-listing-item .variation-after-buttons").style.display = "flex";
                    });

                    setTimeout(function(){
                        $(".single_add_to_cart_button.added").html("<? _e("Tilføj til kurv", "custom-string"); ?>");
                        document.querySelector(".open-listing-item .variation-after-buttons").style.display = "flex";
                        $(this).closest(".variation-popup").hide();
                        $(".open-listing-item .variation-after-buttons").hide();
                        $(this).closest(".jet-listing-grid__item").removeClass("open-listing-item");
                        $(".single_add_to_cart_button.added").removeClass("added");
                    }, 1000);

                    setTimeout(function(){
                        $(".open-listing-item .variation-after-buttons").closest(".variation-popup").hide();
                        $(".open-listing-item .variation-after-buttons").hide();
                        $(".open-listing-item .variation-after-buttons").closest(".jet-listing-grid__item").removeClass("open-listing-item");
                    }, 1000);

                });





            });
		</script>
	<?php } );