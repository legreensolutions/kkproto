<?php
$tmp_about_the_coffee_content = '
<h1>Our Showcase</h1>
Coffee... <br />
          
';

$about_the_coffee_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'Our Showcase','about_the_coffee',$tmp_about_the_coffee_content,"Dynamic about_the_coffee content");

?>
