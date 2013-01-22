<?php
$tmp_contact_us_content = '
<h1>Contact Information</h1>
Kaffa Karma <br />
Canada<br />
email:  admin@kaffakarma.com<br />
Ph: 123456789<br />
          
';

$contact_us_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'Contact Information','contact_us',$tmp_contact_us_content,"Dynamic contact_us content");

?>
