<form>
<h1>Order Details</h1>
</br>
<div class="field">
<table>
<tr>
<td valign="top">

<table>
<tr><td>Order Number:</td><td><?php echo $myorder->order_number; ?></td></tr>
<tr><td>Order Date:</td><td><?php echo $myorder->order_date; ?></td></tr>
<tr><td>Order Status:</td><td><?php echo $g_orderstatuses[$myorder->order_status_id]; ?></td></tr>
<tr><td>Payment Option:</td><td><?php echo $g_paymentoptions[$myorder->paymentoption_id]; ?></td></tr>
<tr><td>Payment status:</td><td><?php echo $g_paymentstatuses[$myorder->payment_status_id]; ?></td></tr>
<tr><td>Payment date:</td><td><?php echo $myorder->paymentdate; ?></td></tr>
<tr><td>Amount:</td><td><?php echo $myorder->order_amount; ?></td></tr>
<tr><td>Tax:</td><td><?php echo $myorder->tax; ?></td></tr>
<?php if($myorder->shipping == SHIPPING) { ?>
<tr><td>shipping Charge:</td><td><?php echo $myorder->shipping_amount; ?></td></tr>
<?php 
$total = $myorder->order_amount + $myorder->tax;
}else{
$total = $myorder->order_amount + $myorder->tax + $myorder->shipping_amount;
} ?>
<tr><td>Total:</td><td><?php echo $total; ?></td></tr>
</table>

</td>
<td valign="top">


<table>
<tr><td>Customer:</td><td><?php echo $mycustomer->first_name . " " .$mycustomer->last_name ; ?></td></tr>
<tr><td></td><td><?php echo $mycustomer->address ; ?></td></tr>
<tr><td></td><td><?php echo $mycustomer->street ; ?>, <?php echo $mycustomer->city ; ?></td></tr>
<tr><td></td><td><?php echo $mycustomer->postal_code ; ?></td></tr>
<tr><td></td><td><?php echo $array_state[$mycustomer->state_id]["state_name"] ; ?></td></tr>
<tr><td></td><td><?php echo $array_country[$mycustomer->country_id]["country_name"] ; ?></td></tr>
<tr><td>Email</td><td><?php echo $mycustomer->emailid ; ?></td></tr>
<tr><td>Phone</td><td><?php echo $mycustomer->phone ; ?></td></tr>
<?php if($myorder->shipping == SHIPPING) { ?>
<tr><td>Shipping Address: </td><td><?php echo $mycustomer->shipping_address ; ?></td></tr>
<tr><td></td><td><?php echo $mycustomer->shipping_street ; ?>, <?php echo $mycustomer->shipping_city ; ?></td></tr>
<tr><td></td><td><?php echo $mycustomer->shipping_postal_code ; ?></td></tr>
<tr><td></td><td><?php echo $array_state[$mycustomer->shipping_state_id]["state_name"] ; ?></td></tr>
<tr><td></td><td><?php echo $array_country[$mycustomer->shipping_country_id]["country_name"] ; ?></td></tr>
<?php } ?>
</table>

</td>
</tr>

<tr>
<td colspan="2">
<table width="100%">
<tr style="font-weight:bold; text-align:center;">
<td>Item</td> <td>Rate</td> <td>Quantity</td>  <td>Tax</td> <td>Shipping Amount</td> <td>Amount</td>
</tr>
<?php 
$item_total = 0;
foreach ($array_orderitem as $order_item) { ?>
<tr>
	<td><?php echo $order_item["item_name"]; ?></td><td align="right"><?php echo $order_item["unit_price"]; ?></td><td align="right"><?php echo $order_item["quantity"]; ?></td><td align="right"><?php echo $order_item["tax"]; ?></td> <td align="right"><?php echo $order_item["shipping_amount"]; ?></td><td align="right"><?php echo $order_item["amount"]; ?></td>
</tr>
<?php } ?>

<tr style="font-weight:bold;">
<td colspan="4"> </td> <td>Total</td> <td align="right"><?php $item_total = $item_total + ($order_item["amount"]+$order_item["tax"]+$order_item["shipping_amount"]);
echo $item_total;
 ?></td>
</tr>
</table>
</td>
</tr>

</table>
</br>
<div style="text-align:center;">
<input type="hidden" name="id" value="<?php echo $myorder->id; ?>" />
<input style="width:150px;" type="submit" name="submit" value="Process" />
</div>
</br>
</div>


<form>
