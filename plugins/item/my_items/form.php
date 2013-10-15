<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<form>
<h1>My Coffee</h1>
</form>
<table  width="100%"   align="center" border="0" cellpadding="1px" cellspacing="1px">
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
        <td  align="center">&nbsp;</td>
    </tr>

     <?php
     //to number each record in a page
    
     $style = "tbl_row_lite";
     $index = 0;
     $slno = $Mypagination->start_record+1;;

     while ( $count_data_bylimit > $index ){
        $link = "my_item.php?id=".$data_bylimit[$index]["item_id"]."";
         if ( $style == "tbl_row_lite" ){
            $style="tbl_row_dark";
        }
        else{
            $style="tbl_row_lite";
        }

        ?>
    <tr onmouseover="this.className='tbl_row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $slno++ ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["name"]; ?></a></td>
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
