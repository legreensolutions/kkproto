<?php
$tmp_privacy_policy_content = '
<h1>Privacy Policy</h1>
<p>privacy policy content .. </p>
          
';

$privacy_policy_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'Privacy Policy','privacy_policy',$tmp_privacy_policy_content,"Dynamic privacy_policy content");

?>
