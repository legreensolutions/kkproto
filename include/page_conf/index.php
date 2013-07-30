<?php
$tmp_index_content = '<p>Kaffa Karma is a family owned and operated company that was founded on the principles of Paying It Forward.</p>
<p>The owners have been an active part of the Calgary community for four generations and have watched this thriving metropolis take form.</p>
<p>Over the years, as our children have grown and participated in community events, sporting groups and clubs, we&#39;ve been involved in a TON of fund raisers. Kaffa Karma is just that! Fund raising on cruise control!</p><br /><p>We work with your group or organization to raise funds without the early morning bottle drives or hours working in a bingo hall. Kaffa Karma will brand and market Organic Gourmet 100% Arabica Coffee for your group. We handle the order processing and arrange for the delivery of the product... so, all you do is collect a check at the end of the month.</p><br />
          
';

$index_content = $this->gsconf->get_conf(CONF_TYPE_TEXT,'Home Page Content','index',$tmp_index_content,"Dynamic index content");

?>

