<?php
$tmp_sitemap_content = '
<h1>Sitemap</h1>
<p>sitemap content .. </p>
          
';

$sitemap_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'Sitemap','sitemap',$tmp_sitemap_content,"Dynamic sitemap content");

?>
