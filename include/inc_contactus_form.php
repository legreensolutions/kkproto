<?= $contact_us_content ?>

<form target="_self" method="post" action="<?php echo $current_url; ?>" name="frmfeedback">

    <div class="notice" >
        		<?php echo $mesg; ?>
    </div>
    <div class="field" >
        <label for="name"> First and Last Name: </label>
        <input type="text" name="txtname" id="txtname"  />
    </div>
    <div class="field" >
        <label for="name"> Email address : </label>
        <input type="text" name="txtemail" id="txtemail"  />
    </div>
    <div class="field" >
        <label for="name"> State or Province : </label>
        <?php if(isset($_POST['lststate'])){ $value = $_POST['lststate']; } else{ $value = -1;}
             populate_list_array("lststate", $chk_state, "state_name", "state_name", $defaultvalue=$value,$disable=false);  ?>
    </div>

    <div class="field" >
        <label> Country: </label>
        <?php if(isset($_POST['lstcountry'])){ $value = $_POST['lstcountry']; } else{ $value = -1;}
         populate_list_array("lstcountry", $chk_country, "id", "country", $defaultvalue=$value,$disable=false);
      ?>
    </div>


    <div class="field" >
        <label> Phone : (with area code) </label>
        <input type="text" name="txtphone" id="txtphone"  />
    </div>

    <div class="field" >
        <label> Time Zone </label>
        <?php if(isset($_POST['lsttime_zone'])){ $value = $_POST['lsttime_zone']; } else{ $value = -1;}
         populate_list_array("lsttime_zone", time_zone_array(), "zone", "zone", $defaultvalue=$value,$disable=false); ?>
    </div>

    <div class="field" >
        <label> The best day and time to call is : (your time zone ) </label>
    <?php if(isset($_POST['lstday'])){ $value = $_POST['lstday']; } else{ $value = -1;}
         populate_list_array("lstday", weekdays_array(), "day", "day", $defaultvalue=$value,$disable=false);
      ?>		
    <br/>
    <?php if(isset($_POST['lsttime'])){ $value = $_POST['lsttime']; } else{ $value = -1;}
         populate_list_array("lsttime", time_array(), "time", "time", $defaultvalue=$value,$disable=false);
      ?>
    </div>

    <div class="field" >
        <label> Questions or Comments: </label>
        <textarea name="txtcontent" id="txtcontent"></textarea>
    </div>


    <div class="actions" >
        <input name="submit" value="Submit" type="submit" onClick="return validate_me(frmfeedback);">
        <input type="hidden" name="h_feedback" value="<?php echo md5("feedback"); ?>">
    </div>



</form>

