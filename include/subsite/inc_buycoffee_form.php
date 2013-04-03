<?php if ( $chk_user_item == false ){
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


         <form  name="frmbuycoffee" id="frmbuycoffee" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">

<h1>Buy Coffee <?php echo $myuseritem->name; ?><br /></h1>
<p class="error"><?php echo $mycustomer->error_description; ?></p>

<div class="field_small" >
<img src="<?php echo $item_image?>"><br/>
$<?php echo $myuseritem->user_price; ?><br/>
<?php echo $myuseritem->description; ?>
</div>


<div class="field_small" >
<label> Quantity</label>  
<input   type="text" name="txtquantity" id="txtquantity" value="<?php if(isset($_POST['txtquantity'])){echo $_POST['txtquantity'];} ?>" />  
<input   type="hidden" name="item_id" id="item_id" value="<?php if(isset($_REQUEST['item_id'])){echo $_REQUEST['item_id'];}?>"/>  
</div>

<br/>
<div class="field" >
    <label> Email</label>
    <input   type="text" name="txtemail" id="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}else{ echo $mycustomer->emailid;} ?>" >
</div>

<div class="field" >
    <label>First Name</label>
    <input  type="text" name="txtfirstname" id="txtfirstname" value="<?php if(isset($_POST['txtfirstname'])){echo $_POST['txtfirstname'];}?>" >
</div>
<div class="field" >
    <label>Last Name</label>
<input  type="text" name="txtlastname" id="txtlastname" value="<?php if(isset($_POST['txtlastname'])){echo $_POST['txtlastname'];}?>" >
</div>



<div class="field" >
    <label>Address</label>
    <textarea name="txtaddress" id="txtaddress"><?php if(isset($_POST['txtaddress'])){echo $_POST['txtaddress'];}?></textarea>
</div>

<div class="field" >
    <label>Street</label>
    <input  type="text" name="txtstreet" id="txtstreet" value="<?php if(isset($_POST['txtstreet'])){echo $_POST['txtstreet'];}?>" >
</div>

<div class="field" >
    <label>City</label>
    <input  type="text" name="txtcity" id="txtcity" value="<?php if(isset($_POST['txtcity'])){echo $_POST['txtcity'];}?>" >
</div>

    <div class="field" >
        <label>State</label>
        <?php if(isset($_POST['lststate'])){ $value = $_POST['lststate']; } else{ $value = -1;}
             populate_list_array("lststate", $chk_state, "id", "state_name", $defaultvalue=$value,$disable=false);  ?>
    </div>

<div class="field" >
    <label>Country</label>
<?php if(isset($_POST['lstcountry'])){ $value = $_POST['lstcountry']; } else{ $value = -1;}
                     populate_list_array("lstcountry", $chk_con, "id", "country", $defaultvalue=$value,$disable=false)
                  ?>
</div>


<div class="field" >
    <label>Zip/Postal Code</label>
    <input  type="text" name="txtpostal_code" id="txtpostal_code" value="<?php if(isset($_POST['txtpostal_code'])){echo $_POST['txtpostal_code'];}?>" >
</div>

<div class="field" >
    <label>Phone</label>
    <input  type="text" name="txtphone" id="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}?>" >
</div>




<div class="actions" >
    <input   type="hidden" name="h_id" id="h_id" value="<?php echo $h_id ?>"/> 
    <input   type="hidden" name="ho_id" id="ho_id" value="<?php echo $ho_id ?>"/> 
    <input type="submit" name="submit" value="<?php echo $CAP_submit; ?>" onClick="return validate_buycoffee();" />
</div>



</form>
                     <!-- form end-->
<script language="javascript" type="text/javascript">
//<!--
        document.getElementById("txtemail").focus();
//-->
</script>


