<?php
$tmp_index_content = 'Hi <br/><br/>

This is <A href="http://www.legreensolutions.com" target="_blank">LegreenSolutions</A> first attempt to create simple FrameWork called <strong>"Green FrameWork Lite"</strong>. This is not a complete frame work like CAKE PHP, CI, etc... Here we try to separate presentation layer from coding, there by simplifying programmers and designers jobs. <br/>

This project is under testing. We would like to invite your suggestion to make this effort successful.<br/><br/>



Regards,<br/>
Team LegreenSolutions.
';

$index_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'DYNAMIC_INDEX_CONTENT','index',$tmp_index_content,"Dynamic index content");

?>

