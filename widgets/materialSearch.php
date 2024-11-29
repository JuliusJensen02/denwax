<?php
add_shortcode('material_search', 'materialSearch');
function materialSearch() {
	ob_start();
    static $count = 0;?>
	<div class="materialSearchContainer materialSearchContainer_<? echo $count; ?>"></div>
	<script>
        jQuery(document).ready(function($) {
            let container = document.querySelector(".materialSearchContainer_<? echo $count; ?>");
            let form = document.createElement("form");
            let input = document.createElement("input");
            input.type = "text";
            input.name = "materialSearch";
            input.classList.add("materialSearch");
            input.placeholder = "Hvad skal du pleje / rense?";
            let button = document.createElement("button");
            button.classList.add("materialSearchBtn");
            button.type = "submit";
            button.innerHTML = "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 20 20'><path id='search_4_' data-name='search (4)' d='M19.724,18.547,14.757,13.58a8.336,8.336,0,1,0-1.177,1.177l4.968,4.968a.832.832,0,1,0,1.177-1.177ZM8.317,14.975a6.658,6.658,0,1,1,6.658-6.658,6.658,6.658,0,0,1-6.658,6.658Z' transform='translate(0.032 0.032)' fill='#f1eee9'/></svg>";
            let results = document.createElement("div");
            results.classList.add("materialSearchResults");
            form.append(input, button);
            container.append(form, results);

            let query = null;
            document.body.addEventListener("click", function (e) {
                if ($(e.target).closest(".materialSearchContainer_<? echo $count; ?>").length) {
                    document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").classList.add("active");
                }
                else{
                    document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").classList.remove("active");
                }
            });

            document.querySelector(".materialSearchContainer_<? echo $count; ?> form").addEventListener("submit", function (e) {
                e.preventDefault();
                materialSearch();
            });

            document.querySelector(".materialSearchContainer_<? echo $count; ?> input").addEventListener("input", function () {
                if (this.value.length > 1) {
                    materialSearch();
                }
                else{
                    if(query != null){
                        query.abort();
                        query = null;
                    }
                    document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").innerHTML = "";
                }
            });

            function materialSearch() {
                if(query != null){
                    query.abort();
                    query = null;
                }
                let search = document.querySelector(".materialSearchContainer_<? echo $count; ?> input").value;
                query = $.ajax({
                    type: 'POST',
                    url: '<? echo admin_url( 'admin-ajax.php' ); ?>',
                    data: {
                        action: 'material_search',
                        search: search
                    },
                    success: function (response) {
                        console.log(response.data);
                        if(response.statusText != "abort") {
                            document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").innerHTML = "";
                            if(response.data != "No item found") {
                                response.data.forEach((material) => {
                                    let materialDiv = document.createElement("a");
                                    materialDiv.href = material.link;
                                    materialDiv.classList.add("materialSearchResult");
                                    materialDiv.innerHTML = "<img src='" + material.image + "' alt='" + material.title + "'><div><h3>" + material.title + "</h3><p>" + material.short_desc + "</p></div>";
                                    document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").appendChild(materialDiv);
                                    if (!document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").classList.contains("active")){
                                        document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").classList.add("active");
                                    }
                                });
                            }
                            else{
                                let materialDiv = document.createElement("a");
                                materialDiv.classList.add("materialSearchResult");
                                materialDiv.innerHTML = "<div><h3>Ingen resultater fundet.</h3></div>";
                                document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").appendChild(materialDiv);
                                if (!document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").classList.contains("active")){
                                    document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").classList.add("active");
                                }
                            }
                        }
                    },
                    error: function (response) {
                        if(response.statusText != "abort") {
                            document.querySelector(".materialSearchContainer_<? echo $count; ?> .materialSearchResults").innerHTML = "";
                        }
                    }
                });
            }
        });
	</script>
	<?php
	$count++;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


?>
