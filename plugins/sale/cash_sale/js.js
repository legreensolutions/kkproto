$(document).ready(function(){ 

	$("#lstitem").focus();

	$('#lstitem').change(function() {
		id = $('#lstitem').val();
		//alert(id);
		$.get("/api/item/price.php", { id: id })
			.done(function(data) {
			//alert("Data Loaded: " + data);
			$('#txtrate').val(data);
		});
	});

	$("#chkshipping").click(function(){
		$("#shipping_tab").toggle();
	});	
	$("#chk_use_same_address").click(function(){
		$('#txtaddress_shipping').val($('#txtaddress').val());
		$('#txtstreet_shipping').val($('#txtstreet').val());
		$('#txtcity_shipping').val($('#txtcity').val());
		$('#lststate_shipping').val($('#lststate').val());
		$('#lstcountry_shipping').val($('#lstcountry').val());
		$('#txtpostal_code_shipping').val($('#txtpostal_code').val());
	});	

	$('#txtquantity').change(function() {
		rate = $('#txtrate').val();
		quantity = $('#txtquantity').val();
		total = rate*quantity;
		$('#div_total').html("Total : $"+total+" (Shipping and Tax extra)");

	});	

});
