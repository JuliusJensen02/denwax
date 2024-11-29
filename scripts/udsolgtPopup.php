<?php
	add_action('wp_footer', function(){
		if(get_the_ID() == 6705){
			global $woocommerce;
			$items = $woocommerce->cart->get_cart();
			$soldOutProducts = array();
			if(count($items) > 0){
				foreach($items as $item => $values) {
					$id = $values['data']->get_id();
					if($id == 34 || $id == 627 || $id == 2211){
						$product =  wc_get_product($id);
						array_push($soldOutProducts, $product->get_name());
					}
				}
				if(count($soldOutProducts) > 0){
					insertSoldOutPopup($soldOutProducts);
				}
			}
		}
	});
	function insertSoldOutPopup($products){ ?>
		<div style="display: none;" id="soldOutPopup">
			<div class="soldOutPopup-overlay"></div>
			<div class="soldOutPopup-body">
				<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><g id="cross" transform="translate(0 0)"><path id="Path_40" data-name="Path 40" d="M7.061,6l4.72-4.719A.75.75,0,0,0,10.719.22h0L6,4.94,1.281.22A.75.75,0,0,0,.22,1.281L4.94,6,.22,10.719A.75.75,0,0,0,1.281,11.78L6,7.061l4.719,4.72a.75.75,0,0,0,1.061-1.061Z" transform="translate(0 0)" fill="#5b5b5b"></path></g></svg>
				<h1>
					<?php
						foreach($products as $index=>$product){
							if($index+1 == count($products)){
								echo $product." ";
							}
							else if($index+2 == count($products)){
								echo $product." og ";
							}
							else{
								echo $product.", ";
							}
						}
					?>
					er udsolgt - levering forventet 15/04
				</h1>
				<p>Hele din ordre forventes leveret 15/04, hvis du bestiller pakke 1. Dette skyldes, at Pink Stone er udsolgt. Bestil dine andre varer separat, hvis du ønsker hurtigere levering. Alle ordrer er dog forsinket pt. pga. enorm efterspørgsel.</p>
				<button>Ok, forstået!</button>
			</div>
		</div>
		<style>
            #soldOutPopup{
                z-index: 9999999999999999999999999;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                align-items: center;
                justify-content: center;
                padding: 0 5%;
            }
            #soldOutPopup .soldOutPopup-overlay{
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #000000aa;
            }
            #soldOutPopup .soldOutPopup-body{
                background-color: #fff;
                position: relative;
                width: 650px;
                padding: 40px;
                border-radius: 18px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            #soldOutPopup .soldOutPopup-body svg{
                background-color: #fff;
                position: absolute;
                top: 20px;
                right: 20px;
                cursor: pointer;
            }
            #soldOutPopup .soldOutPopup-body p{
                margin-top: 10px;
            }
            #soldOutPopup .soldOutPopup-body button{
                border: none;
                width: 100%;
                margin-top: 20px;
            }
		</style>
		<script>
            setTimeout(function(){
                document.getElementById("soldOutPopup").style.display = "flex";
            },1000);

            document.querySelector("#soldOutPopup svg").addEventListener("click", function(){
                document.getElementById("soldOutPopup").style.display = "none";
            });

            document.querySelector("#soldOutPopup button").addEventListener("click", function(){
                document.getElementById("soldOutPopup").style.display = "none";
            });

            document.querySelector("#soldOutPopup .soldOutPopup-overlay").addEventListener("click", function(){
                document.getElementById("soldOutPopup").style.display = "none";
            });
		</script>
	<?php }