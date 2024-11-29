<?php
add_shortcode('soegTags', 'soegTags');
function soegTags() {
	ob_start();
	$tags = get_post_meta(get_the_ID(), 'keywords', true);
	$tags = explode(", ", $tags);
	$altTags = get_post_meta(get_the_ID(), 'soegeord-vises-paa-siden', true);
	$altTags = explode(", ", $altTags);

	if(is_array($altTags) && count($altTags) > 1){
		$tags = $altTags;
	}
	echo "<div class='tags'>";
	foreach($tags as $tag){
		echo '<div class="tag">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12.994" viewBox="0 0 18 12.994"><g id="check_7_" data-name="check (7)" transform="translate(0 -70.573)"><path id="Path_29" data-name="Path 29" d="M5.812,83.567A1.923,1.923,0,0,1,4.45,83L.332,78.886a1.135,1.135,0,0,1,0-1.6h0a1.135,1.135,0,0,1,1.6,0l3.875,3.875L16.063,70.905a1.135,1.135,0,0,1,1.6,0h0a1.135,1.135,0,0,1,0,1.6L7.174,83A1.923,1.923,0,0,1,5.812,83.567Z" fill="#324803"/></g></svg>
			    <p>'.ucfirst($tag).'</p>
			  </div>';
	}
	echo "</div>";
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

