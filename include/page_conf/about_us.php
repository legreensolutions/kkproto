<?php
$tmp_about_us_content = '
<h1>About Us</h1><br />Kaffa Karma is just ... fund raising on cruise control!<br />
Kaffa Karma is a family owned and operated company that was founded on the principals of paying it forward. The owners have been an active part of the Calgary community for four generations and have watched this thriving metropolis take form. over the years as our children have grown and participated in community events, sporting groups and clubs and as such weâ€™ve been involved in a TON of fund raisers.
  
';

$about_us_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'About Us','about_us',$tmp_about_us_content,"Dynamic about_us content");

?>
