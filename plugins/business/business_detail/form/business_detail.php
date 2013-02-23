<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
        <!-- form start-->
            <form  target="_self" method="post" action="<?php echo $current_url?>" name="frmbusiness" id="frmbusiness">



<h1><?php echo $CAP_page_caption; ?> </h1>
<p><?php echo $mybusiness->error_description; ?></p>

<?php echo " <br/>
 Posted on ::". $mybusiness->date_formatted ." <br/><br/>
 Comments or Questions  <br/>
 <hr size=\"1\"><br/>".nl2br( html_entity_decode($mybusiness->comments))." <br/><br/>
 Name       :: ". $mybusiness->name ." <br/>
 Phone       :: ". $mybusiness->phone ." <br/>
 Day       :: ". $mybusiness->day ." <br/>
 Time       :: ". $mybusiness->time ." <br/>
 Time Zone   :: ". $mybusiness->time_zone ." <br/><br/>
 State/Province       :: ". $mybusiness->state ." <br>
 Country     :: ". $mybusiness->country ." <br><br>
 Email       :: ". $mybusiness->email ." <br>"; 


 ?>

<div class="actions">
        <?php if ( $mybusiness->id != "" && $mybusiness->id != gINVALID ){?>
         <input value="<?php echo $CAP_delete ?>" type="submit" name="delete" onClick="return confirm_delete();" />
         <?php } ?>

         <input name="h_id" value="<?php echo $h_id; ?>" type="hidden">
</div>

               
            </form>

            <!-- form end-->
