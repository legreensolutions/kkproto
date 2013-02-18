<h1>FAQ</h1>
<div class="faq">
<?php  if ( $count_data_faq > 0){ ?> 
<?php
        $index = 0;
        while ( $count_data_faq > $index ){ ?>
<p>
<a href="#" class="faq_question" ><?php echo $data_faq[$index]["question"]; ?></a>
<div class="faq_answer" ><?php echo stripslashes(nl2br($data_faq[$index]["answer"])); ?></div>
</p>

<?php $index++;  } ?>
<?php } ?>

</div>



