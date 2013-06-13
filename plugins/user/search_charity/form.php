<?php 
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>


    <table  width="100%"   align="center" border="0" cellpadding="1px" cellspacing="1px">
     <tr><td colspan="6">&nbsp;</td></tr>
    <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="6">&nbsp;</td></tr>
     <tr><td colspan="6" align="center" class="message" ><?php echo $MSG_mesg ?></td></tr>
     <tr><td colspan="6">&nbsp;</td></tr>
    <?php
     }
     else{?>
 
     <?php
     //to number each record in a page
    
     $style = "tbl_row_lite";
     $index = 0;
     $slno = 1;

     while ( $count_data_bylimit > $index ){

      if ( $data_bylimit[$index]["image"] != "" ) {
            $user_image = "";
            $ext = explode('.', $data_bylimit[$index]["image"]);
            $ext = $ext[count($ext)-1];
            $user_image = USER_DIR . $data_bylimit[$index]["id"] . '.' . $ext;
      }
        $link = SUBSITE_WEB_URL."?charity=".$data_bylimit[$index]["user_name"]."";

         if ( $style == "tbl_row_lite" ){
            $style="tbl_row_dark";
        }
        else{
            $style="tbl_row_lite";
        }

        ?>
    <tr onmouseover="this.className='tbl_row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $slno++ ?>.</td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["user_name"]; ?></a></td>
        <?php if ( $data_bylimit[$index]["image"] != "" ){?>
        <td>
            <img  src="<?php echo $user_image?>" height="48px" align="left">
        </td>
        
        <?php }?>
        <td></td>

    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="6">&nbsp;</td></tr>
    <tr><td colspan="6" align="center">
        <!--For pagination. we can create a  diff style  & use-->
        <?php $Mypagination->pagination_style1(); ?>
        </td></tr>
      <?php } ?>
      </table>
      <br />
<div align="center">* You can Click on a Charity name to go Charity Page.</div><br/><br/>
