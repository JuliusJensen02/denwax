<?php
add_shortcode('material_description', 'materialDescription');
function materialDescription() {
	$productsMega = array(22, 19, 34, 628);
	$ID = get_the_ID();
	$longDesc = get_post_meta($ID, "long_desc", true);
	if($longDesc == "") {
		$materialDesc = "<p>Her er vist de produkter, du kan bruge til " . get_the_title() . ". ";
		foreach ( $productsMega as $index => $productID ) {
			$productMaterials = get_post_meta( $productID, "materials", true );
			if ( $productMaterials == "" ) {
				$productMaterials = array();
			}

			if ( in_array( $ID, $productMaterials ) ) {

				if ( $index == 0 ) {
					$materialDesc .= "<br>";
				}
				switch ( $productID ) {
					case '19':
						$materialDesc .= "<strong>Denwax Care</strong> bruges til pleje og imprægnering af " . get_the_title() . ". ";
						break;
					case '22':
						$materialDesc .= "<strong>Denwax Clean</strong> bruges til rens af " . get_the_title() . ". ";
						break;
					case '34':
						$materialDesc .= "<strong>Denwax Pink Stone</strong> kan bruges til at fjerne genstridigt kalk og skidt på " . get_the_title() . ". ";
						break;
					case '628':
						$materialDesc .= "<strong>Denwax Imprægneringsspray</strong> kan bruges til effektiv imprægnering af " . get_the_title() . ". ";
						break;
				}
			}
		}
	}
	else {
		$materialDesc = "<p>".$longDesc;
	}
	if($materialDesc != "Her er vist de produkter, du kan bruge til ". get_the_title() .".") {
		$materialDesc .= "<br>Klik ind på det enkelte produkt og få et mere detaljeret overblik.</p>";
	}
	else{
		$materialDesc .= "</p>";
	}
	return $materialDesc;
}