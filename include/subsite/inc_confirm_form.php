
<h1>Please Confirm & Continue...<br /></h1>


<div class="field_small" >
<img src="<?php echo $item_image; ?>"><br/>
<?php echo $orderitem[0]["item_name"]; ?><br/>
$<?php echo $orderitem[0]["unit_price"]; ?><br/>
Quantity <?php echo $orderitem[0]["quantity"]; ?>
</div>


<br/>
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
        <?php echo $mycustomer->state_name; ?>
    </div>

<div class="field" >
    <label>Country : </label>
    <?php echo $mycustomer->country_name;?>
</div>


<div class="field" >
    <label>Zip/Postal Code : </label>
    <?php echo $mycustomer->postal_code;?>
</div>

<div class="field" >
    <label>Phone : </label>
    <?php echo $mycustomer->phone;?>
</div>





<br/><br/>
<form action="<?php echo $current_url; ?>" method="post">
<input type="hidden" name="rm" value="2">

<input type="hidden" name="custom" value="<?php echo $myorder->id; ?>">
<input type="hidden" name="item_name" value= "<?php echo $orderitem[0]["item_name"]; ?>">
<input type="hidden" name="item_number" value="<?php echo $orderitem[0]["item_id"]; ?>">
<input type="hidden" name="amount" value="<?php echo $order->order_amount; ?>">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="CAD">
<input type="hidden" name="lc" value="CA">


<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="email@example.com">
<input type="hidden" name="lc" value="CA">
<input type="hidden" name="custom" value="<?php echo $myorder->id; ?>">
<input type="hidden" name="item_name" value= "<?php echo $orderitem[0]["item_name"]; ?>">
<input type="hidden" name="item_number" value="<?php echo $orderitem[0]["item_id"]; ?>">
<input type="hidden" name="amount" value="<?php echo $order->order_amount; ?>">
<input type="hidden" name="currency_code" value="CAD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="tax_rate" value="5.000">
<input type="hidden" name="shipping" value="5.00">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">






	<br/><br/>
<!--
<input type="image" src="../images/paypal/PayPal_credit_card_logos.jpg" border="0" name="submit1" alt="Make payments with PayPal - it's fast, free and secure!">
-->

</form>










<!--

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="email@example.com">
<input type="hidden" name="lc" value="IN">
<input type="hidden" name="item_name" value="tiem_name">
<input type="hidden" name="item_number" value="item_id">
<input type="hidden" name="amount" value="30.00">
<input type="hidden" name="currency_code" value="CAD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="tax_rate" value="5.000">
<input type="hidden" name="shipping" value="5.00">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

-->












</div>


