<?php
$tmp_disclaimer_content = '
<h1>Disclaimer</h1>
<p>Disclaimer content .. </p>
          
';

$disclaimer_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'Disclaimer','disclaimer',$tmp_disclaimer_content,"Dynamic disclaimer content");

?>
