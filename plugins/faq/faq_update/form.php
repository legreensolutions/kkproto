<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
        <!-- form start-->
            <form  target="_self" method="post" action="<?php echo $current_url?>" name="frmfaq" id="frmfaq">



<h1><?php 
        if ( $myfaq->id != "" && $myfaq->id != gINVALID )
        {echo $CAP_page_caption_edit;}
        else{echo $CAP_page_caption_add;}?> </h1>


        <p><?php echo $myfaq->error_description; ?></p>


<div class="field">
    <label><?php echo $CAP_question?></label><br>
    <textarea name="txtquestion" id="txtquestion"><?php echo $myfaq->question?></textarea>
</div>

<div class="field">
    <label><?php echo $CAP_answer?></label><br>
    <textarea name="txtanswer" id="txtanswer"><?php echo $myfaq->answer?></textarea>
</div>

<div class="actions">
        <?php if ( $myfaq->id != "" && $myfaq->id != gINVALID ){?>
         <input value="<?php echo $CAP_update ?>" type="submit" name="update" onClick="return validate_faq();" />
         <input value="<?php echo $CAP_delete ?>" type="submit" name="delete" onClick="return confirm_delete();" />
         <?php }else{ ?>
         <input value="<?php echo $CAP_insert ?>" type="submit" name="insert" onClick="return validate_faq();" />
         <?php }?>

         <input name="h_id" value="<?php echo $h_id; ?>" type="hidden">
</div>

               
            </form>

            <!-- form end-->
    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("txtquestion").focus();
   //-->
    </script>   
