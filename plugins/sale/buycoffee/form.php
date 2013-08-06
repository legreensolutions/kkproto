<?php if ( $chk_user_item == false ){
        echo $mesg;
    }else{ 

        $item_image = "../../images/items/item.gif";
        if ( $myuseritem->image != "" ) {
            
            $ext = explode('.', $myuseritem->image);
            $ext = $ext[count($ext)-1];
            $item_image = "../../".ITEM_DIR . $myuseritem->item_id . '.' . $ext;
        }
   } ?>





<?php   /*
    This forms most of the HTML contents of User Sign up page
    */
    ?>
        <!-- form start-->

    <?php //copy ?>
     <br />


         <form  name="frmbuycoffee" id="frmbuycoffee" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">

<h1>1. Please enter quantity of <?php echo $myuseritem->name; ?> required<br /></h1>
<p class="error"><?php echo $mycustomer->error_description; ?></p>

<div class="field_small" >

      <div class="buy_coffee">
        <img src="<?php echo $item_image?>"><br/>
        <?php echo substr($myuseritem->description,0,50); ?>...
      </div>


<?php
$unit_price = $myuseritem->user_price;
if(isset($_POST['txtquantity'])){
    $quantity = $_POST['txtquantity'];
}else{ 
    $quantity = 1 ;
}

$total = $unit_price * $quantity;
?>

      <div class="buy_coffee_div">
        <br /><br />
        <div class="buy_coffee_left_div"><label>Rate</label></div> <div class="buy_coffee_right_div">$<?php echo $unit_price ;  ?></div>
        <br />   <br />     

        <div class="buy_coffee_left_div"><label>Quantity</label></div><div class="buy_coffee_right_div"><input   type="text" name="txtquantity" id="txtquantity" value="<?php echo  $quantity; ?>" /></div>  


        <br /><br />
        <div class="buy_coffee_left_div"><label>Total</label></div> <div class="buy_coffee_right_div"><span id="div_total">$<?php echo $total; ?> </span> <br>(Shipping and Tax extra)</div>
        <br />   <br />  
          
        <input   type="hidden" name="item_id" id="item_id" value="<?php if(isset($_REQUEST['item_id'])){echo $_REQUEST['item_id'];}?>"/>  
        <input   type="hidden" name="unit_price" id="unit_price" value="<?php echo $unit_price; ?>"/>  
      </div>
    
        <br />   <br />     


      <div style="clear:both;"></div>
      

</div>
<br /><br />
<h1>2. Please enter you details<br /></h1>
<div class="field" >
    <label> Email</label>
    <input   type="text" name="txtemail" id="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}else{ echo $mycustomer->emailid;} ?>" >
</div>

<div class="field" >
    <label>First Name</label>
    <input  type="text" name="txtfirstname" id="txtfirstname" value="<?php if(isset($_POST['txtfirstname'])){echo $_POST['txtfirstname'];}else{ echo $mycustomer->first_name;}?>" >
</div>
<div class="field" >
    <label>Last Name</label>
<input  type="text" name="txtlastname" id="txtlastname" value="<?php if(isset($_POST['txtlastname'])){echo $_POST['txtlastname'];}else{ echo $mycustomer->last_name;}?>" >
</div>



<div class="field" >
    <label>Address</label>
    <textarea name="txtaddress" id="txtaddress"><?php if(isset($_POST['txtaddress'])){echo $_POST['txtaddress'];}else{ echo $mycustomer->address;}?></textarea>
</div>

<div class="field" >
    <label>Street</label>
    <input  type="text" name="txtstreet" id="txtstreet" value="<?php if(isset($_POST['txtstreet'])){echo $_POST['txtstreet'];}else{ echo $mycustomer->street;}?>" >
</div>

<div class="field" >
    <label>City</label>
    <input  type="text" name="txtcity" id="txtcity" value="<?php if(isset($_POST['txtcity'])){echo $_POST['txtcity'];}else{ echo $mycustomer->city;}?>" >
</div>

    <div class="field" >
        <label>State</label>
        <?php if(isset($_POST['lststate'])){ $value = $_POST['lststate']; } else{ $value = $mycustomer->state_id;}
             populate_list_array("lststate", $chk_state, "id", "state_name", $defaultvalue=$value,$disable=false);  ?>
    </div>

<div class="field" >
    <label>Country</label>
<?php if(isset($_POST['lstcountry'])){ $value = $_POST['lstcountry']; } else{ $value = $mycustomer->country_id;}
                     populate_list_array("lstcountry", $chk_con, "id", "country", $defaultvalue=$value,$disable=false)
                  ?>
</div>


<div class="field" >
    <label>Zip/Postal Code</label>
    <input  type="text" name="txtpostal_code" id="txtpostal_code" value="<?php if(isset($_POST['txtpostal_code'])){echo $_POST['txtpostal_code'];}else{ echo $mycustomer->postal_code;}?>" >
</div>

<div class="field" >
    <label>Phone</label>
    <input  type="text" name="txtphone" id="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}else{ echo $mycustomer->phone;}?>" >
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


















<div class="actions" >
    <input   type="hidden" name="h_id" id="h_id" value="<?php echo $h_id ?>"/> 
    <input   type="hidden" name="ho_id" id="ho_id" value="<?php echo $ho_id ?>"/> 
    <input type="submit" name="submit" value="<?php echo $CAP_submit; ?>" onClick="return validate_buycoffee();" />
</div>



</form>
                     <!-- form end-->
<script language="javascript" type="text/javascript">
//<!--
        document.getElementById("txtemail").focus();
//-->
</script>


