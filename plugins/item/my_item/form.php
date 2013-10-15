<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>

<form>
<h1> My Coffee</h1>

      <div class="field" ><label for="image"><?php echo $myItem->name; ?></label><img  src="<?php echo $item_image?>" height="250px" align="right"></div>
     

      <div class="field" ><?php echo $myItem->description; ?></div>


      <div class="field"><label for="unit_price">Unit Price: </label> $<?php echo $myItem->unit_price; ?></div>

      <div class="field"><label for="unit_weight">Unit weight (lbs): </label><?php echo $myItem->unit_weight; ?></div>

      

</form>

