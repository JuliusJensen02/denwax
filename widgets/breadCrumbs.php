<?php
add_shortcode('custom_breadcrumbs', 'customBreadcrumbs');
function customBreadcrumbs() {
	ob_start();
	$current = get_post(get_the_ID())->post_title;
	?>
	<div class="breadcrumbs">
		<a href="<?php echo get_post_type_archive_link('soeg'); ?>">Søg</a>
		<span>&nbsp;//&nbsp;</span>
		<p><?php echo ucfirst($current); ?></p>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


?>
