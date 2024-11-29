<?php
add_shortcode( 'soegTextRepeater', 'soegTextRepeater' );
function soegTextRepeater() {
	ob_start();
	$repeater = get_post_meta( get_the_ID(), 'text_boxes', true );
	if(is_array($repeater) && count($repeater) > 0){
		echo '<div class="text-boxes">';
		foreach ( $repeater as $box ) {
			echo '<div class="text-box">
					<h3>' . $box['heading'] . '</h3>
					<p>' . $box['text'] . '</p>
				  </div>';
		}
		echo '</div>';
	}
	else{
		?>
			<div id="removeThis"></div>
			<script>
                let remove = document.getElementById('removeThis');
                remove.closest(".e-parent").remove();
			</script>
		<?php
	}
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

