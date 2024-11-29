<?php
add_shortcode( 'soegRelatedGuides', 'soegRelatedGuides' );
function soegRelatedGuides() {
	ob_start();
	$guides = get_post_meta( get_the_ID(), 'guides', true );
	if(!is_array($guides)){
		$guides = array($guides);
	}
	echo '<div class="related-guides">';
	foreach ( $guides as $guide ) {
		$guide = get_post( $guide );
		$title = get_post_meta( $guide->ID, 'kort-titel', true );
		$link = get_permalink( $guide->ID );
		$images = get_post_meta( $guide->ID, 'billeder', true );
		$desc = get_post_meta( $guide->ID, 'kort-beskrivelse', true );
		?>
		<div class="related-guide">
			<div>
				<h3><?php echo $title; ?></h3>
				<div class="text"><?php echo $desc; ?></div>
				<a href="<?php echo $link; ?>">Se hele guiden</a>
			</div>
			<img src="<?php if(isset($images[0]["url"])) echo $images[0]["url"]; ?>" alt="<?php echo $title; ?>">
		</div>
		<?php
	}
	echo '</div>';
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

