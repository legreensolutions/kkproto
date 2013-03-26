	<!-- form update start-->
	<form target="_self" method="post" action="<?php echo $current_url; ?>" name="frmprohibited">

<h1> <?php echo $page_headding; ?><br /></h1>
<p id="notice"><?php echo $error_msg ?></p>

<div class="field" >
    <label>Words</label>
    <textarea name="txt_words"><?php echo $strwords; ?></textarea>
</div>



<div class="actions" >
    <input type="submit" name="submit" value="Update Prohibited Words" />
    <input type="hidden" name="h_wordinfo" value="<?php echo md5("WORD_INFO"); ?>">
	<input type="hidden" name="h_id" value="<?= $int_id ?>" >
</div>



	</form> <!-- form update ends-->	
