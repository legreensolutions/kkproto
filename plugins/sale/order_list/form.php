<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<form name="frmsearch" id="frmsearch" method="GET" action="user_list.php">
<table align="center">
<tbody>
<tr>
                    <td colspan="5" align="center" class="page_caption">
                    <?php echo $CAP_page_caption?>
                    </td>
</tr>
    <tr>
      <td class="caption" ><?php echo $CAP_search ?></td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35"
 name="txtsearch" value="<?php echo $_GET[txtsearch]; ?>"></td>
    </tr> 
     


 
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;</td>
      <td><input name="submit" value="<?php echo $CAP_submit?>" type="submit"><input type="hidden" name="h_conf_search" value="<?php echo md5("CONF_SEARCH"); ?>"></td>
    </tr>


</tbody>
</table>
</form>


    <table  width="100%"   align="center" border="0" cellpadding="1px" cellspacing="1px">
     <tr><td colspan="6">&nbsp;</td></tr>
    <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="6">&nbsp;</td></tr>
     <tr><td colspan="6" align="center" class="message" ><?php echo $MSG_mesg ?></td></tr>
     <tr><td colspan="6">&nbsp;</td></tr>
    <?php
     }
     else{?>
    <tr class="tableheader">
        <td></td>
        <td>Order Number</td>
        <td>Order Date</td>
        <td>Order Status</td>
        <td>Payment Option</td>
        <td>Payment status</td>
        <td>Customer</td>
        <td>Charity</td>
        <td>Amount</td>

    </tr>

     <?php
     //to number each record in a page
    
     $style = "tbl_row_lite";
     $index = 0;
     $slno = 1;

     while ( $count_data_bylimit > $index ){
        $link = "order.php?id=".$data_bylimit[$index]["id"]."";
         if ( $style == "tbl_row_lite" ){
            $style="tbl_row_dark";
        }
        else{
            $style="tbl_row_lite";
        }

        ?>
    <tr onmouseover="this.className='tbl_row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $slno++ ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["order_number"]; ?> [View]</a></td>
        <td><?php echo $data_bylimit[$index]["order_date"]; ?></td>
        <td><?php echo $g_orderstatuses[$data_bylimit[$index]["order_status_id"]]; ?></td>
        <td><?php echo $g_paymentoptions[$data_bylimit[$index]["paymentoption_id"]]; ?></td>
        <td><?php echo $g_paymentstatuses[$data_bylimit[$index]["payment_status_id"]]; ?></td>
        <td><?php echo $array_customer[$data_bylimit[$index]["customer_id"]]["name"]; ?></td>
        <td><?php echo $array_user[$data_bylimit[$index]["user_id"]]["name"]; ?></td>
        <td><?php echo $data_bylimit[$index]["order_amount"]; ?></td>

    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="6">&nbsp;</td></tr>
    <tr><td colspan="6" align="center">
        <!--For pagination. we can create a  diff style  & use-->
        <?php $Mypagination->pagination_style1(); ?>
        </td></tr>
      <?php } ?>
      </table>
      <br />
<div align="center">* You can Click on a user name to "Update" or"Delete"</div>
