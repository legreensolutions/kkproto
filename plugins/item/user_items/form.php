<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>

<form method="post" target="_self" action="<?php echo $current_url; ?>" name="frmItem" id="frmItem" enctype="multipart/form-data">
<h1><?php echo $myuser->user_name; ?> Coffee</h1>

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
        <th></th>
        <td  align="center">&nbsp;</td>
        <th></th>
    </tr>

     <?php
     //to number each record in a page
    
     $style = "tbl_row_lite";
     $index = 0;
     $slno = $Mypagination->start_record+1;
     while ( $count_data_bylimit > $index ){
        $link = "item.php?id=".$data_bylimit[$index]["id"]."";
        if(isset($user_item_array[$data_bylimit[$index]["id"]])){
            $checked = " checked ";
        }else{
            $checked = "";
        }
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
        <td><input type="checkbox" name="user_item[]" value="<?php echo $data_bylimit[$index]['id']; ?>" <?php echo $checked; ?> />

<input type="hidden" name="user_price[]" value="<?php echo $data_bylimit[$index]['unit_price']; ?>" />
        </td>
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
<div class="actions" >
                <input value="Update" type="submit" name="update"  />
<input name="id" value="<?php echo $_REQUEST['id']; ?>" type="hidden"/>
      </div>
</form>
