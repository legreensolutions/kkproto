$(document).ready(function(){ 

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
		rate = $('#unit_price').val();
		quantity = $('#txtquantity').val();
		total = rate*quantity;
		$('#div_total').html("$"+total);

	});	

});
