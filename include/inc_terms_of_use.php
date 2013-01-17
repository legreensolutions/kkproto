<?php
$tmp_terms_of_use_content = '
<h1>Terms and Conditions</h1>
<p>Terms and Conditions .. </p>
          
';

$terms_of_use_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'DYNAMIC_INDEX_CONTENT','terms_of_use',$tmp_terms_of_use_content,"Dynamic terms_of_use content");

?>
<?= $terms_of_use_content; ?>
