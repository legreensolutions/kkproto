<?php 

$myuseritem = new UserItem($myconnection);
$myuseritem->connection = $myconnection;
if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0){

    $myuseritem->item_id = $_REQUEST['id'];
}else{

        
}


$myuseritem->user_id = $_SESSION[SESSION_TITLE.'charity_id'];

$chk_user_item = $myuseritem->get_item_detail();


if ( $chk_user_item == false ){
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

<h1><?php echo  $myuseritem->name ?></h1>
      <div class="item_info">
        <img src="<?php echo $item_image?>">
		<p><?php echo $myuseritem->description; ?></p>
        
      </div>
 <div class="price_buy"><div class="item_price">Price : $<?php echo $myuseritem->user_price; ?></div><a href="buycoffee.php?item_id=<?php echo $myuseritem->item_id; ?>"><div class="buy_button" ></div></a></div>



