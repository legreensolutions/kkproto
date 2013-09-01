
<h1>3. Please Confirm & Continue...<br /></h1>


<div class="field_small" >

  <div class="buy_coffee">
    <label><?php echo $orderitem[0]["item_name"]; ?></label><br />
    <img src="<?php echo $item_image; ?>"><br />
  </div>

  <br />
  
  <div class="buy_coffee_div">
      Price: $<?php echo $orderitem[0]["unit_price"]; ?><br />
      Quantity: <?php echo $orderitem[0]["quantity"]; ?><br />
      Amount: $<?php echo $orderitem[0]["amount"]; ?><br />
  </div>
</div>

<div style="clear:both;"></div>

<br/>
<h1>Address<br /></h1>
<hr />
<div class="field" >
    <label> Email : </label>
    <?php echo $mycustomer->emailid; ?>
</div>

<div class="field" >
    <label>First Name : </label>
    <?php echo $mycustomer->first_name;?>
</div>
<div class="field" >
    <label>Last Name : </label>
    <?php echo $mycustomer->last_name;?>
</div>



<div class="field" >
    <label>Address : </label>
    <?php echo $mycustomer->address;?>
</div>

<div class="field" >
    <label>Street : </label>
    <?php echo $mycustomer->street;?>
</div>

<div class="field" >
    <label>City : </label>
    <?php echo $mycustomer->city;?>
</div>

    <div class="field" >
        <label>State : </label>
        <?php echo $array_state[$mycustomer->state_id]["state_name"] ; ?>
    </div>

<div class="field" >
    <label>Country : </label>
    <?php echo $array_country[$mycustomer->country_id]["country_name"] ; ?>
</div>


<div class="field" >
    <label>Zip/Postal Code : </label>
    <?php echo $mycustomer->postal_code;?>
</div>

<div class="field" >
    <label>Phone : </label>
    <?php echo $mycustomer->phone;?>
</div>




<h1>Shipping Address<br /></h1>
<hr />

<div class="field" >
    <label>Address : </label>
    <?php echo $mycustomer->shipping_address;?>
</div>

<div class="field" >
    <label>Street : </label>
    <?php echo $mycustomer->shipping_street;?>
</div>

<div class="field" >
    <label>City : </label>
    <?php echo $mycustomer->shipping_city;?>
</div>

    <div class="field" >
        <label>State : </label>
       <?php echo $array_state[$mycustomer->shipping_state_id]["state_name"] ; ?>
    </div>

<div class="field" >
    <label>Country : </label>
    <?php echo $array_country[$mycustomer->shipping_country_id]["country_name"] ; ?>
</div>


<div class="field" >
    <label>Zip/Postal Code : </label>
    <?php echo $mycustomer->postal_code;?>
</div>
<br/><br/>


<form action="/paypal.php" method="post">

<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="<?php echo PAYPAL_BUSINESS_ACCOUNT ; ?>">

<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">

<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="custom" value="<?php echo $myorder->id; ?>">
<input type="hidden" name="item_name" value= "<?php echo $orderitem[0]["item_name"]; ?>">
<input type="hidden" name="item_number" value="<?php echo $orderitem[0]["item_id"]; ?>">
<input type="hidden" name="quantity" value="<?php echo $orderitem[0]["quantity"]; ?>">
<input type="hidden" name="amount" value="<?php echo $orderitem[0]["unit_price"]; ?>">
<input type="hidden" name="no_shipping" value="<?php echo $myorder->shipping; ?>">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="CAD">
<input type="hidden" name="lc" value="CA">
<input type="hidden" name="tax" value="<?php echo $myorder->tax; ?>">
<input type="hidden" name="shipping" value="<?php echo $myorder->shipping_amount; ?>">
<!-- Display the payment button. -->
<input type="image" name="submit" border="0"
src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
alt="PayPal - The safer, easier way to pay online">
<img alt="" border="0" width="1" height="1"
src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>







</div>

<br class="clear" />
