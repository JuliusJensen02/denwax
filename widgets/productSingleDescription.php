<?php
add_shortcode('custom_product_description', 'customProductDescription');
function customProductDescription() {
	ob_start();
	$current = get_post(get_the_ID())->post_content;
	?>
	<p><?= $current ?></p>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}