<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<div class="outer_box">
  <div class="inner_box">
    <div class="page_caption">
      <?php if ($myItem->id != "" && $myItem->id != gINVALID) { 
              echo "UPDATE Item Details";
            }
            else { 
              echo "Add New Item";
            }
      ?>
    </div>
    <div class="errormessage">
      <?php echo $myItem->error_description; ?>
    </div>
    <form method="post" target="_self" action="<?php echo $current_url; ?>" name="frmItem" id="frmItem">
      <div><label for="name">Item Name: </label><input type="text" name="txtname" id="txtname" value="<?php echo $myItem->name; ?>" /></div>
      <div><label for="description">Description: </label><input type="text" name="txtdescription" id="txtdescription" value="<?php echo $myItem->description; ?>" /></div>
      <div><label for="kewords">Keywords: </label><input type="text" name="txtkeywords" id="txtkeywords" value="<?php echo $myItem->keywords; ?>" /></div>
      <div><label for="unit_price">Unit Price: </label><input type="text" name="txtunit_price" id="txtunti_price" value="<?php echo $myItem->unit_price; ?>" /></div>
      <div><label for="tax_item">Tax on Item: </label><input type="text" name="txttax_item" id="txttax_item" value="<?php echo $myItem->tax_item; ?>" /></div>
      <div><label for="tax_shipping">Tax on Shipping: </label><input type="text" name="txttax_shipping" id="txttax_shipping" value="<?php echo $myItem->tax_shipping; ?>" /></div>
      
      <div class="clear_float"></div>
      <div>
        <?php if ($myItem->id != "" && $myItem->id != gINVALID) { ?>
                <input value="UPDATE" type="submit" name="update" onClick="return validate_item();" />
                <input value="DELETE" type="submit" name="delete" onClick="return confirm_delete();" />
        <?php } else { ?>
                <input value="INSERT" type="submit" name="insert" onClick="return validate_item();" />
        <?php } ?>
        <input name="h_id" value="<?php echo $myItem->id; ?>" type="hidden">
      </div>
  </div>
</div>

