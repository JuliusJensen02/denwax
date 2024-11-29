<?php
	add_action( 'wp_footer', function () {
		if(get_post_type() == "product"){
			$id = get_the_ID();
			?>
			<script>
                jQuery(document).ready(function($){
                    $("#product-extra-options .elementor-tabs-wrapper").wrap("<div class='elementor-tabs-wrapper-wrapper'></div>");
                    $("#product-extra-options").click(function(){
                        if($("#product-extra-options #elementor-tab-title-6171").hasClass("elementor-active")){
                            $(".elementor-element-cbd9aef").show();
                        }
                        else{
                            $(".elementor-element-cbd9aef").hide();
                        }

                        if($("#product-extra-options #elementor-tab-title-6172").hasClass("elementor-active")){
                            $(".elementor-element-adf2592").show();
                        }
                        else{
                            $(".elementor-element-adf2592").hide();
                        }
                    });
					let beforeAfterImagesCond = <?= get_post_meta($id, "show_before_after_images", true) ?>;
					let videoCond = <?= get_post_meta($id, "show_productvideo", true) ?>;
					let datasheetCond = <?= get_post_meta($id, "show_datasheet", true) ?>;
					
					let extraOptions = document.getElementById("product-extra-options");
					
					let beforeAfterImagesMenu = extraOptions.querySelector("#elementor-tab-title-6171");
					let videoMenu = extraOptions.querySelector("#elementor-tab-title-6172");
					let datasheetMenu = extraOptions.querySelector("#elementor-tab-title-6173");
					
					let beforeAfterImagesContent = extraOptions.querySelector("#elementor-tab-content-6171");
					let videoContent = extraOptions.querySelector("#elementor-tab-content-6172");
					let datasheetContent = extraOptions.querySelector("#elementor-tab-content-6173");
					
					if(!beforeAfterImagesCond){
						beforeAfterImagesMenu.style.display = "none";
						beforeAfterImagesContent.style.display = "none";
						document.querySelector(".elementor-element-cbd9aef").style.display = "none";
						setTimeout(function(){
							videoMenu.click();
						}, 1000);
					}
					if(!videoCond){
						videoMenu.style.display = "none";
						videoContent.style.display = "none";
						document.querySelector(".elementor-element-adf2592").style.display = "none";
						setTimeout(function(){
							datasheetMenu.click();
						}, 1000);
					}
					if(!datasheetCond){
						datasheetMenu.style.display = "none";
						datasheetContent.style.display = "none";
					}
                });
			</script>

		<?php }} );