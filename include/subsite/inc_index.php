
                <div style="clear:both;"></div>

<?php if ( $data_bylimit == false ){
        echo $mesg;
    }else{ 

     $index = 0;
     while ( $count_data_bylimit > $index ){
            $item_image = "../../images/items/item.gif";
      if ( $data_bylimit[$index]["image"] != "" ) {
            
            $ext = explode('.', $data_bylimit[$index]["image"]);
            $ext = $ext[count($ext)-1];
            $item_image = "../../".ITEM_DIR . $data_bylimit[$index]["id"] . '.' . $ext;
      }
?>
                <div class="item_div">
                        <div class="item_name"><?php echo $data_bylimit[$index]["name"]; ?></div>
        
            <div class="item_image"><img src="<?php echo $item_image?>"></div>        
        
                        
                        <div class="price_buy"><div class="item_price">$<?php echo $data_bylimit[$index]["user_price"]; ?></div><div class="buy_button" ></div></div>
                        <div style="clear:both;"></div>
                        <div class="item_description">
  <?php echo $data_bylimit[$index]["description"]; ?>
                        </div>
                </div>
                <?php 
                    $index++;
                } ?>
    <?php } ?>