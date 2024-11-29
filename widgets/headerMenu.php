<?php
add_shortcode( 'headerMenu', 'headerMenu' );
function headerMenu() {
	ob_start();
	$productsMega = array(19, 22, 34, 627);
    $bundles = array(627, 2157, 2194, 2211);
	$current_language = apply_filters('wpml_current_language', NULL);
    foreach ($productsMega as $key => $productID) {
        $productsMega[$key] = apply_filters('wpml_object_id', $productID, 'product', true, $current_language);
    }
    foreach ($bundles as $key => $productID) {
        $bundles[$key] = apply_filters('wpml_object_id', $productID, 'product', true, $current_language);
    }
	?>
	<div class="headerMenu">
		<div class="menuItem">
			<a href="<? echo get_home_url(); ?>"><?php _e("Forside", "Hefa_theme"); ?></a>
		</div>
		<div class="menuItem">
			<a href="<? echo get_permalink(130); ?>"><?php _e("Produkter", "Hefa_theme"); ?></a>
			<div class="megaMenu">
				<?
				foreach ($productsMega as $productID) {
					$productPost = get_post($productID);
					$product = wc_get_product($productID);
					?>
					<div class="megaMenuItem <? echo ($productID == 627) ? "highlight" : ""; ?>">
						<a href="<? echo get_permalink($productID); ?>">
                            <div class="stickers">
                                <? echo productStickers($productID); ?>
                            </div>
							<img src="<? echo get_the_post_thumbnail_url($productID); ?>" alt="<? echo $product->post_title; ?>">
							<span>
								<p><? _e($productPost->post_title, "Hefa_theme"); ?></p>
								<p><? echo $product->get_price_html(); ?></p>
							</span>
							<p>
								<? _e(get_post_meta($productID, "mega-menu-desc", true), "Hefa_theme"); ?>
							</p>
						</a>
					</div>
					<?
				}
				?>
				<div class="megaMenuItem megaMenuTextOnly">
					<a href="<? echo get_permalink(130); ?>">
						Se alle produkter
						<svg xmlns="http://www.w3.org/2000/svg" width="29.929" height="29.927" viewBox="0 0 29.929 29.927">
							<path id="arrow-up-right_1_" data-name="arrow-up-right (1)" d="M24.317,0H13.094a1.871,1.871,0,1,0,0,3.741H23.542L.548,26.735A1.871,1.871,0,0,0,3.194,29.38L26.187,6.386V16.835a1.871,1.871,0,0,0,3.741,0V5.612A5.618,5.618,0,0,0,24.317,0Z" transform="translate(0)" fill="#202020"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
		<div class="menuItem">
			<a href="<? echo get_permalink(132); ?>"><?php _e("Pakketilbud", "Hefa_theme"); ?></a>
            <div class="megaMenu">
				<?
				foreach ($bundles as $productID) {
					$productPost = get_post($productID);
					$product = wc_get_product($productID);
					?>
                    <div class="megaMenuItem <? echo ($productID == 627) ? "highlight" : ""; ?>">
                        <a href="<? echo get_permalink($productID); ?>">
                            <div class="stickers">
		                        <? echo productStickers($productID); ?>
                            </div>
                            <img src="<? echo get_the_post_thumbnail_url($productID); ?>" alt="<? echo $product->post_title; ?>">
                            <span>
								<p><? _e($productPost->post_title, "Hefa_theme"); ?></p>
								<p><? echo $product->get_price_html(); ?></p>
							</span>
                            <p>
								<? _e(get_post_meta($productID, "mega-menu-desc", true), "Hefa_theme"); ?>
                            </p>
                        </a>
                    </div>
					<?
				}
				?>
                <div class="megaMenuItem megaMenuTextOnly">
                    <a href="<? echo get_permalink(130); ?>">
                        <?php _e("Se alle pakketilbud", "Hefa_theme"); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="29.929" height="29.927" viewBox="0 0 29.929 29.927">
                            <path id="arrow-up-right_1_" data-name="arrow-up-right (1)" d="M24.317,0H13.094a1.871,1.871,0,1,0,0,3.741H23.542L.548,26.735A1.871,1.871,0,0,0,3.194,29.38L26.187,6.386V16.835a1.871,1.871,0,0,0,3.741,0V5.612A5.618,5.618,0,0,0,24.317,0Z" transform="translate(0)" fill="#202020"/>
                        </svg>
                    </a>
                </div>
            </div>
		</div>
		<!--<div class="menuItem">
			<a href="<? //echo get_post_type_archive_link("guides"); ?>">Guides</a>
		</div>-->
		<div class="menuItem">
			<a href="<? echo get_permalink(3966); ?>"><?php _e("Kundeservice", "Hefa_theme"); ?></a>
			<div class="megaMenu service">
				<div class="megaMenuItem megaMenuTextOnly">
					<a href="<? echo get_permalink(3966); ?>">
                        <img src="https://denwax.com/wp-content/uploads/2024/05/Lotte-og-Michael-Sejr-Denwax-Messe.jpg" alt="Michael Sejr og Lotte Sejr på Denwax lageret" loading="lazy">
                        <h2><?php _e("Kontakt os", "Hefa_theme"); ?></h2>
					</a>
				</div>
				<div class="megaMenuItem megaMenuTextOnly">
					<a href="<? echo get_permalink(4099); ?>">
                        <img src="https://denwax.com/wp-content/uploads/2024/05/Danmark-megamenu-find-forhandler-we7.png" alt="Denmarkskort" loading="lazy">
                        <h2><?php _e("Find forhandler", "Hefa_theme"); ?></h2>
					</a>
				</div>
				<div class="megaMenuItem megaMenuTextOnly">
					<a href="<? echo get_permalink(3730); ?>">
                        <img src="https://denwax.com/wp-content/uploads/2023/01/Denwax-Messe-768x576.jpg" alt="Denwax på messe" loading="lazy">
                        <h2><?php _e("Om os", "Hefa_theme"); ?></h2>
					</a>
				</div>
				<div class="megaMenuItem megaMenuTextOnly">
					<a href="<? echo get_permalink(3953); ?>">
                        <img src="https://denwax.com/wp-content/uploads/2023/01/Pakkekit-4-miljoe-we-768x576.jpg" alt="Denwax Pakke 4 i miljø" loading="lazy">
						<h2><?php _e("Om Denwax produkterne", "Hefa_theme"); ?></h2>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

