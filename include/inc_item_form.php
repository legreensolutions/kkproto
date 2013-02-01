<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>

<form method="post" target="_self" action="<?php echo $current_url; ?>" name="frmItem" id="frmItem">


<h1><?php 
        if ( $myItem->id != "" && $myItem->id != gINVALID )
        {echo $CAP_page_caption_edit;}
        else{echo $CAP_page_caption_add;}?> </h1>


        <p><?php echo $myItem->error_description; ?></p>

      <div class="field" ><label for="name">Item Name: </label><input type="text" name="txtname" id="txtname" value="<?php echo $myItem->name; ?>" /></div>
      <div class="field" ><label for="description">Description: </label><input type="text" name="txtdescription" id="txtdescription" value="<?php echo $myItem->description; ?>" /></div>
      <div class="field" ><label for="kewords">Keywords: </label><input type="text" name="txtkeywords" id="txtkeywords" value="<?php echo $myItem->keywords; ?>" /></div>
      <div class="field"><label for="unit_price">Unit Price: </label><input type="text" name="txtunit_price" id="txtunti_price" value="<?php echo $myItem->unit_price; ?>" /></div>
      <div class="field"><label for="tax_item">Tax on Item: </label><input type="text" name="txttax_item" id="txttax_item" value="<?php echo $myItem->tax_item; ?>" /></div>
      <div class="field" ><label for="tax_shipping">Tax on Shipping: </label><input type="text" name="txttax_shipping" id="txttax_shipping" value="<?php echo $myItem->tax_shipping; ?>" /></div>

      <div class="actions" >
        <?php if ($myItem->id != "" && $myItem->id != gINVALID) { ?>
                <input value="<?php echo $CAP_update; ?>" type="submit" name="update" onClick="return validate_item();" />
                <input value="<?php echo $CAP_delete; ?>" type="submit" name="delete" onClick="return confirm_delete();" />
        <?php } else { ?>
                <input value="<?php echo $CAP_insert; ?>" type="submit" name="insert" onClick="return validate_item();" />
        <?php } ?>
        <input name="h_id" value="<?php echo $myItem->id; ?>" type="hidden">
      </div>


 </form>
