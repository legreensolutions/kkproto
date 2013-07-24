<?php   /*
    This forms most of the HTML contents of User Sign up page    */
    ?>
<!-- form start-->
    <form name="frmcash_sale" id="frmcash_sale" method="post" action="<?php echo $current_url; ?>"
      enctype="multipart/form-data">
      <h1>1. Please enter item details</h1>
      <p class="error"><?php echo $mycustomer->error_description; ?></p>

      <div class="field_small"> 
<table>
<tr>
<th>Item</th> <th>Rate</th> <th>Quantity</th>
</tr>
<tr>
	<td>
        <?php if(isset($_POST['lstitem'])){ $value = $_POST['lstitem']; } else{ $value = gINVALID;}
             populate_list_array("lstitem", $chk_item, "id", "details", $defaultvalue=$value,$disable=false, 'style = "width:200px;"');  ?>
	</td>
	<td>
        <input name="txtrate" id="txtrate" value="<?php if(isset($_POST['txtrate'])){echo $_POST['txtrate'];} ?>"
          type="text"> 
	</td>
		<td>
		<input name="txtquantity" id="txtquantity" value="<?php if(isset($_POST['txtquantity'])){echo $_POST['txtquantity'];}else{ echo "1";}?>" type="text">
	</td>

</table>
	<div id="div_total"></div>
 </div>
      <br>
      <h1>2. Please enter customer details</h1>
      <div class="field"> <label> Email</label> <input name="txtemail" id="txtemail"
          value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}else{ echo $mycustomer->emailid;} ?>"
          type="text">
      </div>
      <div class="field"> <label>First Name</label> <input name="txtfirstname"
          id="txtfirstname" value="<?php if(isset($_POST['txtfirstname'])){echo $_POST['txtfirstname'];}else{ echo $mycustomer->first_name;}?>"
          type="text">
      </div>
      <div class="field"> <label>Last Name</label>
        <input name="txtlastname" id="txtlastname" value="<?php if(isset($_POST['txtlastname'])){echo $_POST['txtlastname'];}else{ echo $mycustomer->last_name;}?>"
          type="text">
      </div>
      <div class="field"> <label>Address</label> <textarea name="txtaddress" id="txtaddress"><?php
          if(isset($_POST['txtaddress'])){echo $_POST['txtaddress'];}else{ echo
          $mycustomer->address;}?></textarea>
      </div>
      <div class="field"> <label>Street</label> <input name="txtstreet" id="txtstreet"
          value="<?php if(isset($_POST['txtstreet'])){echo $_POST['txtstreet'];}else{ echo $mycustomer->street;}?>"
          type="text">
      </div>
      <div class="field"> <label>City</label> <input name="txtcity" id="txtcity"
          value="<?php if(isset($_POST['txtcity'])){echo $_POST['txtcity'];}else{ echo $mycustomer->city;}?>"
          type="text">
      </div>
      <div class="field"> <label>State</label>
        <?php if(isset($_POST['lststate'])){ $value = $_POST['lststate']; } else{ $value = $mycustomer->state_id;}
        populate_list_array("lststate", $chk_state, "id", "state_name",
        $defaultvalue=$value,$disable=false); ?> </div>
      <div class="field"> <label>Country</label>
        <?php if(isset($_POST['lstcountry'])){ $value = $_POST['lstcountry']; } else{ $value = $mycustomer->country_id;}
        populate_list_array("lstcountry", $chk_con, "id", "country",
        $defaultvalue=$value,$disable=false) ?>
      </div>
      <div class="field"> <label>Zip/Postal Code</label> <input name="txtpostal_code"
          id="txtpostal_code" value="<?php if(isset($_POST['txtpostal_code'])){echo $_POST['txtpostal_code'];}else{ echo $mycustomer->postal_code;}?>"
          type="text">
      </div>
      <div class="field"> <label>Phone</label> <input name="txtphone" id="txtphone"
          value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}else{ echo $mycustomer->phone;}?>"
          type="text">
      </div>



      <div class="field"> <label>Shipping</label> <input type="checkbox" name="chkshipping" id="chkshipping"
          value="<?php if(isset($_POST['chkshipping'])){echo $_POST['chkshipping'];}?>"
          type="text">
      </div>

	<div id="shipping_tab">


      <br>
      <h1>3. Please enter shipping details</h1><br>
      <div class="field"> <label>Use Same Address for Shipping</label> <input type="checkbox" name="chk_use_same_address" id="chk_use_same_address"
          value="<?php if(isset($_POST['chk_use_same_address'])){echo $_POST['chk_use_same_address'];}?>"
          type="text">
      </div>

      <div class="field"> <label>Address</label> <textarea name="txtaddress_shipping" id="txtaddress_shipping"><?php
          if(isset($_POST['txtaddress_shipping'])){echo $_POST['txtaddress_shipping'];}else{ echo
          $mycustomer->shipping_address;}?></textarea>
      </div>
      <div class="field"> <label>Street</label> <input name="txtstreet_shipping" id="txtstreet_shipping"
          value="<?php if(isset($_POST['txtstreet_shipping'])){echo $_POST['txtstreet_shipping'];}else{ echo $mycustomer->shipping_street;}?>"
          type="text">
      </div>
      <div class="field"> <label>City</label> <input name="txtcity_shipping" id="txtcity_shipping"
          value="<?php if(isset($_POST['txtcity_shipping'])){echo $_POST['txtcity_shipping'];}else{ echo $mycustomer->shipping_city;}?>"
          type="text">
      </div>
      <div class="field"> <label>State</label>
        <?php if(isset($_POST['lststate_shipping'])){ $value = $_POST['lststate_shipping']; } else{ $value = $mycustomer->shipping_state_id;}
        populate_list_array("lststate_shipping", $chk_state, "id", "state_name",
        $defaultvalue=$value,$disable=false); ?> </div>
      <div class="field"> <label>Country</label>
        <?php if(isset($_POST['lstcountry_shipping'])){ $value = $_POST['lstcountry_shipping']; } else{ $value = $mycustomer->shipping_country_id;}
        populate_list_array("lstcountry_shipping", $chk_con, "id", "country",
        $defaultvalue=$value,$disable=false) ?>
      </div>
      <div class="field"> <label>Zip/Postal Code</label> <input name="txtpostal_code_shipping"
          id="txtpostal_code_shipping" value="<?php if(isset($_POST['txtpostal_code_shipping'])){echo $_POST['txtpostal_code_shipping'];}else{ echo $mycustomer->shipping_postal_code;}?>"
          type="text">
      </div>





	</div>

      <div class="actions"> <input name="h_id" id="h_id" value="<?php if(isset($h_id)) echo $h_id ?>"
          type="hidden"> <input name="ho_id" id="ho_id" value="<?php if(isset($ho_id)) echo $ho_id ?>"
          type="hidden"> <input name="submit" value="<?php echo $CAP_submit; ?>"
          onclick="return validate_cash_sale();" type="submit">
      </div>
    </form>
    <!-- form end -->


