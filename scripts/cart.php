<?php
add_action("wp_footer", function () {
if(get_the_ID() == 15 || get_the_ID() == 7930){?>
 <script>
     jQuery(document).ready(function($){
         /***************Fri fragt ændring***************/
         let shipping = 350;
         let price, firstTime=0, last=0;
         /***********************************************/


         /***************Timeout for focus***************/
         let wait = 100;
         let timeout = 3000+wait;
         /***********************************************/


         /***********Fri fragt one time insert***********/
         $(".woocommerce .e-cart__column-end").prepend("<div id='shipping-check-box'><div><b></b><p></p></div></div>");
         $("#shipping-check-box").prepend('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24.667" height="24.667" viewBox="0 0 24.667 24.667"> <defs> <clipPath id="clip-path"> <path id="path2803" d="M0-682.665H24.667V-658H0Z" transform="translate(0 682.665)" fill="#fff"/> </clipPath> </defs> <g id="Du_har_opnået_fri_fragt_hvid" data-name="Du har opnået fri fragt hvid" transform="translate(254 -25)"> <g id="g2793" transform="translate(-254 25)"> <g id="g2795" transform="translate(9.743 17.851)"> <path id="path2797" d="M-208.006,0h-7.8" transform="translate(215.803)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2799"> <g id="g2801" clip-path="url(#clip-path)"> <g id="g2807" transform="translate(16.406 8.542)"> <path id="path2809" d="M-156.915-248.334h1.655v-5.026l-4.146-4.283H-162.8v9.264" transform="translate(162.797 257.643)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2811" transform="translate(16.406 12.825)"> <path id="path2813" d="M-201.079,0h-7.538" transform="translate(208.617)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2815" transform="translate(5.139 15.441)"> <path id="path2817" d="M-17.675-17.676a2.262,2.262,0,0,1,3.2,0,2.262,2.262,0,0,1,0,3.2,2.262,2.262,0,0,1-3.2,0A2.262,2.262,0,0,1-17.675-17.676Z" transform="translate(18.338 18.339)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2819" transform="translate(17.748 15.441)"> <path id="path2821" d="M-17.674-17.676a2.262,2.262,0,0,1,3.2,0,2.262,2.262,0,0,1,0,3.2,2.262,2.262,0,0,1-3.2,0A2.262,2.262,0,0,1-17.674-17.676Z" transform="translate(18.337 18.339)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2823" transform="translate(3.004 4.701)"> <path id="path2825" d="M0,0V13.142H2.041" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2827" transform="translate(3.004 4.701)"> <path id="path2829" d="M-358.049-102.61v-3.847h-13.422" transform="translate(371.471 106.457)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2831" transform="translate(3.004 4.701)"> <path id="path2833" d="M-133.754,0h-5.014" transform="translate(138.768)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2835" transform="translate(1.735 7.593)"> <path id="path2837" d="M-167.624,0h-6.284" transform="translate(173.908)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> <g id="g2839" transform="translate(0.723 10.484)"> <path id="path2841" d="M-180.478,0h-6.766" transform="translate(187.243)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.4"/> </g> </g> </g> </g> </g></svg>');
         /***********************************************/

         $("#info-box-reserved").appendTo(".e-cart__column-start");
         $("<div id='nav-buttons'><a href='https://denwax.com/produkter/'><? _e("Tilbage til alle produkter", "custom-string"); ?></a><a href='https://denwax.com/kasse/' id='last-to-checkout'><? _e("Fortsæt til kassen", "custom-string"); ?></a></div>").appendTo(".e-cart__column-start");


         update_cart_content();
         firstTime=1;
         $(document.body).on('updated_cart_totals', function(){
             update_cart_content();
         });

         $("#checkout-pointer-table, #last-to-checkout").click(function(){
             $(".checkout-button").click();
         });

         function update_cart_content(){
             let shippingPriceElm = document.querySelector("#shipping_method label");
             if(shippingPriceElm.textContent == "0 kr." || shippingPriceElm.innerHTML == "GLS Pakkeshop"){
                 shippingPriceElm.innerHTML = "GLS Pakkeshop"+'<span class="woocommerce-Price-amount amount">Gratis</span>';
             }
             $("thead .product-thumbnail>span").html("<? _e("Produktbillede", "custom-string"); ?>");
             $("thead .product-name>span").html("<? _e("Produktnavn", "custom-string"); ?>");
             $("thead .product-price").html("<? _e("Pris", "custom-string"); ?>");
             $("thead .product-quantity").html("<? _e("Antal", "custom-string"); ?>");
             $("thead .product-subtotal").html("<? _e("Total", "custom-string"); ?>");
             $("<a href='<? _e("https://denwax.com/kasse/", "custom-string"); ?>' id='checkout-pointer-table'><? _e("Fortsæt til kassen", "custom-string"); ?></a>").appendTo(".e-cart__column-start .coupon .form-row");
             $("<strong class='total-text'><? _e("Total", "custom-string"); ?></strong>").insertBefore(".order-total td strong");
             $(".cart-collaterals .cart_totals h2").html("<? _e("Kurv total", "custom-string"); ?>");
             $("a.checkout-button").html("<? _e("Fortsæt til kassen", "custom-string"); ?>");

             $(".shop_table .cart_item .product-name").each(function(){
                 let text = $(this).find("a").html().split(/-(.*)/s);
                 if(text[1] != undefined){
                     $(this).find("a").html(text[0] + "<br><bdi>" + text[1] + "</bdi>");
                 }
             });

             price = parseInt($(".cart-subtotal .woocommerce-Price-amount bdi").html().split(/<(.*)/s)[0].replace(".", ""));
             price = shipping-price;
             if(price <= 0){
                 $("#shipping-check-box b").html("<? _e("Du har nu fri fragt til pakkeshop", "custom-string"); ?>");
                 $("#shipping-check-box b").html("Du har nu fri fragt til pakkeshop");
                 $("#shipping-check-box p").html("");
                 $("#shipping-check-box").addClass("active");
                 $("label[for='shipping_method_0_shipmondo2']").html("<? _e("Gratis", "custom-string"); ?>").addClass("bold");
                 if(firstTime && last != 1){
                     focus_box();
                 }
                 last=1;
             }
             else{
                 $("#shipping-check-box b").html("<? _e("Du er kun ", "custom-string"); ?><bdi>"+price+"</bdi><? _e("kr fra at få fri fragt!", "custom-string"); ?>");
                 $("#shipping-check-box p").html("<? _e("Tilføj flere varer og spar fragtprisen.", "custom-string"); ?>");
                 $("#shipping-check-box").removeClass("active");
                 $("label[for='shipping_method_0_shipmondo2']").html("45 kr.").removeClass("bold");
                 if(firstTime && last != 2){
                     focus_box();
                 }
                 last=2;
             }
         }

         function focus_box(){
             setTimeout(function(){
                 $("#shipping-check-box").addClass("focus");
             }, wait);

             setTimeout(function(){
                 $("#shipping-check-box").removeClass("focus");
             }, timeout);
         }

     });
 </script>
<?php }} );