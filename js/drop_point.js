jQuery(document).ready(function($) {
	$(document.body).on("updated_checkout", function () {
		let address = document.getElementById("billing_address_1").value;
		let city = document.getElementById("billing_city").value;
		let zip = document.getElementById("billing_postcode").value;
		webshipper.search(zip, address, city, function () {
			let drop_points = webshipper.drop_points;
			let drop_point_select = document.getElementById("ws_drop_point_blob");
			drop_point_select.innerHTML = "";
			if(drop_points.length === 0) {
				let option = document.createElement("option");
				option.value = "";
				option.text = "Ingen pakkeshops fundet.";
				drop_point_select.appendChild(option);
			}
			else {
				drop_points.forEach(function (drop_point) {
					let option = document.createElement("option");
					option.value = encodeURIComponent(JSON.stringify({
						drop_point_id: drop_point.drop_point_id,
						address_1: drop_point.address_1,
						zip: drop_point.zip,
						city: drop_point.city,
						country_code: drop_point.country_code,
						name: drop_point.name,
						routing_code: drop_point.routing_code})
					);
					option.text = drop_point.name + ", " + drop_point.address_1 + ", " + drop_point.zip + " " + drop_point.city;
					drop_point_select.appendChild(option);
				});
			}
		});
	});
});


var webshipper = {

	// Variables'
	wp_url: webshipper_ajax_object.ajax_url,
	drop_points: [],
	address: {},
	drop_point: {},

	search: function(zip, adr, city, callback){
		// Make the call
		jQuery.post( webshipper.wp_url, {
			action: "get_shops",
			address: adr,
			city: city,
			zip: zip,
		}, function( response ) {
			if(! response.data || ! response.data.drop_points) {
				window.webshipper.drop_points = []
			} else {
				webshipper.drop_points = response.data.drop_points;
			}

			if(typeof callback !== 'undefined') {
				callback()
			}
		}, "json").fail(function() {
				webshipper.drop_points = [];
		});
	}
};