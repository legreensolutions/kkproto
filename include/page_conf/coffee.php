<?php
$tmp_coffee_content = '
<h1>Coffee</h1><br />Coffee!<br />
Coffee .....  
';

$coffee_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'coffee','coffee',$tmp_coffee_content,"Dynamic coffee content");

?>
