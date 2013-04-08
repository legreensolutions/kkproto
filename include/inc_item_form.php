<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>

<form method="post" target="_self" action="<?php echo $current_url; ?>" name="frmItem" id="frmItem" enctype="multipart/form-data">


<h1><?php 
        if ( $myItem->id != "" && $myItem->id != gINVALID )
        {echo $CAP_page_caption_edit;}
        else{echo $CAP_page_caption_add;}?> </h1>


        <p><?php echo $myItem->error_description; ?></p>

      <div class="field" ><label for="name">Item Name: </label><input type="text" name="txtname" id="txtname" value="<?php echo $myItem->name; ?>" /></div>
      <div class="field" ><label for="description">Description: </label><input type="text" name="txtdescription" id="txtdescription" value="<?php echo $myItem->description; ?>" /></div>

<div class="field" ><label for="kewords">Status: </label>
<?php
if(isset($_POST['lstitem_status_id'])){
    $item_status_id = $_POST['lstitem_status_id'];
}else{
    $item_status_id = $myItem->item_status_id;
}
populate_list_array("lstitem_status_id", $data_item_status, "id", "name", $defaultvalue=$item_status_id,$disable=false);
?>
</div>

<div class="field" ><label for="kewords">Type: </label>
<?php
if(isset($_POST['lstitem_type_id'])){
    $item_type_id = $_POST['lstitem_type_id'];
}else{
    $item_type_id = $myItem->item_type_id;
}
populate_list_array("lstitem_type_id", $data_item_type, "id", "name", $defaultvalue=$item_type_id,$disable=false);
?>
</div>

      <div class="field" ><label for="kewords">Keywords: </label><input type="text" name="txtkeywords" id="txtkeywords" value="<?php echo $myItem->keywords; ?>" /></div>
      <div class="field"><label for="unit_price">Unit Price: </label><input type="text" name="txtunit_price" id="txtunti_price" value="<?php echo $myItem->unit_price; ?>" /></div>
      <div class="field"><label for="tax_item">Tax on Item: </label><input type="text" name="txttax_item" id="txttax_item" value="<?php echo $myItem->tax_item; ?>" /></div>
      <div class="field" ><label for="tax_shipping">Tax on Shipping: </label><input type="text" name="txttax_shipping" id="txttax_shipping" value="<?php echo $myItem->tax_shipping; ?>" /></div>
      <div class="field" ><label for="commission">Commission: </label><input type="text" name="txtcommission" id="txtcommission" value="<?php echo $myItem->commission; ?>" /></div>

      <div class="field" ><label for="image">Item Image: </label>
<?php if ( $image == "" ) {?>
<input type="file" name="fleimage" id="fleimage" size="30" />
 <?php }else{ ?>
<img  src="<?php echo $item_image?>" height="80px" align="right">
<input type="submit" name="delete_image" value="<?php echo $CAP_delete_image ?>" onClick="return confirm_delete_image();"/>
<input type="hidden" name="h_image" value="<?php echo $image ?>"/>
 <?php } ?>
        </div>
      <div class="actions" >
        <?php if ($myItem->id != "" && $myItem->id != gINVALID) { ?>
                <input value="<?php echo $CAP_update; ?>" type="submit" name="update" onClick="return validate_item();" />
                <input value="<?php echo $CAP_delete; ?>" type="submit" name="delete" onClick="return confirm_delete();" />
        <?php } else { ?>
                <input value="<?php echo $CAP_insert; ?>" type="submit" name="insert" onClick="return validate_item();" />
        <?php } ?>
        <input name="h_id" value="<?php echo $myItem->id; ?>" type="hidden"/>
      </div>


 </form>
