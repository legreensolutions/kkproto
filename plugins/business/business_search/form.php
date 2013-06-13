<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<form target="_self" method="GET" action="<?php echo $current_url; ?>" name="frmbusiness_search" class="Search_form">

<h1><?php echo $CAP_page_caption?></h1>

<div class="field">
    <label><?php echo $CAP_Name?></label><br>
    <input  name="txtname" value="<?php echo $_GET[txtname]; ?>">
</div>
<div class="field">
    <label><?php echo $CAP_Phone?></label><br>
    <input  name="txtphone" value="<?php echo $_GET[txtphone]; ?>">
</div>
<div class="field">
    <label><?php echo $CAP_Email?></label><br>
    <input  name="txtemail" value="<?php echo $_GET[txtemail]; ?>">
</div>

<div class="field">
    <label><?php echo $CAP_IPAddress?></label><br>
    <input  name="txtipaddress" value="<?php echo $_GET[txtipaddress]; ?>">
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
        <td  align="center"><?php echo $CAP_Date?></td>
        <td  align="center"><?php echo $CAP_Name?></td>
        <td  align="center"><?php echo $CAP_Phone?></td>
        <td  align="center"><?php echo $CAP_State?></td>
        <td  align="center"><?php echo $CAP_Country?></td>

        <td  align="center"><?php echo $CAP_Email?></td>

        <td  align="center"><?php echo $CAP_IPAddress?></td>
    </tr>

     <?php
     //to number each record in a page
    
     $style = "tbl_row_lite";
     $index = 0;
     $slno = $Mypagination->start_record+1;;

     while ( $count_data_bylimit > $index ){
        $link = "business_detail.php?id=".$data_bylimit[$index]["id"]."";
         if ( $style == "tbl_row_lite" ){
            $style="tbl_row_dark";
        }
        else{
            $style="tbl_row_lite";
        }

        ?>
    <tr onmouseover="this.className='tbl_row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $slno++ ?></td>
        <td><?php echo $data_bylimit[$index]["date"]; ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["name"]; ?></a></td>
        <td><?php echo $data_bylimit[$index]["phone"]; ?></td>
        <td><?php echo $data_bylimit[$index]["state"]; ?></td>
        <td><?php echo $data_bylimit[$index]["country"]; ?></td>
        <td><?php echo $data_bylimit[$index]["email"]; ?></td>
        <td><?php echo $data_bylimit[$index]["ipaddress"]; ?></td>

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
