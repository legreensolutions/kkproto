<?php   /*
    This forms most of the HTML contents of User Sign up page
    */
    ?>
        <!-- form start-->

    <?php //copy ?>
     <br />
         <form  name="frmsignup" id="frmsignup" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">

<h1><?php echo $CAP_page_caption?><br /></h1>
<p class="error"><?php echo $myuser->error_description; ?></p>

<div class="field" >
    <label><?php echo $CAP_username ?> </label>
    <input  type="text" name="txtusername" id="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}?>" >
    <input id="chk" type="submit" value="<?php echo $CAP_check ?>" />
    <div id="results"></div>
</div>

<div class="field" >
    <label><?php echo $CAP_email ?></label>
    <input   type="text" name="txtemail" id="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}?>" >
</div>

<div class="field" >
    <label><?php echo $CAP_password ?></label>
    <input   type="password" name="txtpasswd" id="txtpasswd" value="<?php if(isset($_POST['txtpasswd'])){echo $_POST['txtpasswd'];}?>" >
</div>

<div class="field" >
    <label><?php echo $CAP_repassword ?></label>
    <input type="password" name="txtrepasswd" id="txtrepasswd" value="<?php if(isset($_POST['txtrepasswd'])){echo $_POST['txtrepasswd'];}?>" >
</div>

<div class="field" >
    <label><?php echo $CAP_firstname ?></label>
    <input  type="text" name="txtfirstname" id="txtfirstname" value="<?php if(isset($_POST['txtfirstname'])){echo $_POST['txtfirstname'];}?>" >
</div>

<div class="field" >
    <label><?php echo $CAP_lastname ?></label>
    <input  type="text" name="txtlastname" id="txtlastname" value="<?php if(isset($_POST['txtlastname'])){echo $_POST['txtlastname'];}?>" >
</div>

<div class="field" >
    <label><?php echo $CAP_address ?></label>
    <input  type="text" name="txtaddress" id="txtaddress" value="<?php if(isset($_POST['txtaddress'])){echo $_POST['txtaddress'];}?>" >
</div>

<div class="field" >
    <label><?php echo $CAP_city ?></label>
    <input  type="text" name="txtcity" id="txtcity" value="<?php if(isset($_POST['txtcity'])){echo $_POST['txtcity'];}?>" >
</div>

    <div class="field" >
        <label><?php echo $CAP_state ?></label>
        <?php if(isset($_POST['lststate'])){ $value = $_POST['lststate']; } else{ $value = -1;}
             populate_list_array("lststate", $chk_state, "id", "state_name", $defaultvalue=$value,$disable=false);  ?>
    </div>

<div class="field" >
    <label><?php echo $CAP_country ?></label>
<?php if(isset($_POST['lstcountry'])){ $value = $_POST['lstcountry']; } else{ $value = -1;}
                     populate_list_array("lstcountry", $chk_con, "id", "country", $defaultvalue=$value,$disable=false)
                  ?>
</div>

<div class="field" >
    <label> <?php echo $CAP_image ?></label>
    <input type="file" name="fleimage" id="fleimage" size="20" />
</div>

<div class="field" >
    <label><?php echo $CAP_sec_que ?></label>
<?php if(isset($_POST['lstsec_que'])){ $value = $_POST['lstsec_que']; } else{ $value = -1;}
                         populate_list_array("lstsec_que", $chk_que, "id", "question", $defaultvalue=$value,$disable=false)?>
</div>

<div class="field" >
    <label><?php echo $CAP_sec_ans ?></label>
    <input  type="text" name="txtsec_ans" id="txtsec_ans" value="<?php if(isset($_POST['txtsec_ans'])){echo $_POST['txtsec_ans'];}?>" />
</div>

<div class="field" >
    <label><?php echo $MSG_enter_security_code?></label>
    <input id="security_code" name="security_code" type="text" />
    <small><?php echo $MSG_text_in_image?></small>
</div>
<div id="div_captcha" style="width:200px;height:40px;"><img alt="." src="gfwcaptcha.php?width=120&height=40&characters=5" />&nbsp;&nbsp; <input type="image" alt="Reload" title="Try another?" src="images/gfw/reload.gif"  style="cursor:pointer;" onclick="return captcha_reaload();" /></div>




<div class="actions" >
    <input type="submit" name="submit" value="<?php echo $CAP_submit?>" onClick="return validate_signup();" />
</div>



</form>
                     <!-- form end-->
<script language="javascript" type="text/javascript">
//<!--
        document.getElementById("txtusername").focus();
//-->
</script>

