<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<form target="_self" method="GET" action="<?php echo $current_url; ?>" name="frmfaq_search">

<h1><?php echo $CAP_page_caption?></h1>

<div class="field">
    <label><?php echo $CAP_Question?></label><br>
    <input  name="txtquestion" value="<?php echo $_GET[txtquestion]; ?>">
</div>



<div class="actions">
        <input name="submit" value="<?php echo $CAP_submit_search?>" type="submit">
        <input type="hidden" name="h_conf_search" value="<?php echo md5("CONF_SEARCH"); ?>">
</div>

</form>

<table  width="100%"   align="center" border="0" cellpadding="1px" cellspacing="1px">
     <tr><td colspan="2">&nbsp;</td></tr>
   <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="2">&nbsp;</td></tr>
     <tr><td colspan="2" align="center" class="message" ><?php echo $mesg ?></td></tr>
     <tr><td colspan="2">&nbsp;</td></tr>
    <?php
     }
     else{?>
    <tr class="tableheader">
        <td></td>
        <td  align="center"><?php echo $CAP_Question?></td>
    </tr>

     <?php
     //to number each record in a page
    
     $style = "tbl_row_lite";
     $index = 0;
     $slno = $Mypagination->start_record+1;;

     while ( $count_data_bylimit > $index ){
        $link = "faq_update.php?id=".$data_bylimit[$index]["id"]."";
         if ( $style == "tbl_row_lite" ){
            $style="tbl_row_dark";
        }
        else{
            $style="tbl_row_lite";
        }

        ?>
    <tr onmouseover="this.className='tbl_row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $slno++ ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["question"]; ?></a></td>
    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2" align="center">
        <!--For pagination. we can create a  diff style  & use-->
        <?php $Mypagination->pagination_style1(); ?>
        </td></tr>
      <?php } ?>
      </table>
