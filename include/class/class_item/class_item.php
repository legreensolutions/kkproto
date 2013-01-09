<?php
// prevent execution of this code by direct call from browser
if ( !defined('CHECK_INCLUDED') ){
  exit();
}
/**
 * id
 * name
 * description
 * item_status_id
 * item_type_id
 * image
 * keywords
 * unit_price
 * tax_item
 * tax_shipping
 **/

class Item {
  public $connection;
  public $id = gINVALID;
  public $name = "";
  public $description = "";
  public $item_status_id = -1;
  public $item_type_id = -1;
  public $image = "";
  public $keywords = "";
  public $unit_price = 0.00;
  public $tax_item = 0.00;
  public $tax_shipping = 0.00;

  var $error = false;
  var $error_number = gINVALID;
  var $error_description = "";
  //for pagination
  var $total_records = "";

  // retireve the id of a particular item
  function get_id() {
    $strSQL = "SELECT I.id ";
    $strSQL .= "FROM items ";
    $strSQL .= "WHERE I.name = '" . $this->name . "' ";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if (mysql_num_rows($rsRES) > 0) {
      $this->id = mysql_result($rsRES,0,"id");
      return $this->id;
    }
    else {
      $this->error_number = 1;
      $this->error_description="The item named * $this->name * doesn't exist";
      return false;
    }
  }

  // retireve one row from the items table
  function get_detail() {
    $strSQL = "SELECT * FROM items WHERE id = '" . $this->id . "'";
    $rsRES = @mysql_query($strSQL, $this->connection);
    if (mysql_num_rows($rsRES) > 0) {
      $this->id = mysql_result($rsRES,0,"id");
      $this->name = mysql_result($rsRES,0,"name");
      $this->description = mysql_result($rsRES,0,"description");
      $this->image = mysql_result($rsRES,0,"image");
      $this->keywords = mysql_result($rsRES,0,"keywords");
      $this->unit_price = mysql_result($rsRES,0,"unit_price");
      $this->tax_item = mysql_result($rsRES, 0, "tax_item");
      $this->tax_shipping = mysql_result($rsRES, 0, "tax_shipping");
      return $this;
    }
    else {
      $this->error_number = 2;
      $this->error_description = "Contact administrator to get details";
      return false;
    }
  }
  
  // retrieve all the rows in the items table
  function get_list_array() {
    $items = array();
    $intIndex = 0;
    $strSQL = "SELECT * FROM items ORDER BY id";
    $rsRES = @mysql_query($strSQL, $this->connection);
    if (mysql_num_rows($rsRES) > 0) {
      while ($arrRES = mysql_fetch_assoc($rsRES)) {
        $items[$intIndex]["id"] =  $arrRES["id"];
        $items[$intIndex]["name"] = $arrRES["name"];
        $items[$intIndex]["description"] = $arrRES["description"];
        $items[$intIndex]["image"] = $arrRES["image"];
        $items[$intIndex]["keywords"] = $arrRES["keywords"];
        $items[$intIndex]["unit_price"] = $arrRES["unti_price"];
        $items[$intIndex]["tax_item"] = $arrRES["tax_item"];
        $items[$intIndex]["tax_shipping"] = $arrRES["tax_shipping"];
        $items[$intIndex]["item_status_id"] = $arrRES["item_status_id"];
        $items[$intIndex]["item_type_id"] = $arrRES["item_type_id"];
        
        $intIndex++;
      }
      return $items;
    }
    else{
      $this->error_number = 4;
      $this->error_description="Unable to list items";
      return false;
    }
  }

  function get_list_array_bylimit($start_record=0, $max_records=25){
    // retrieve a set of rows from the table 
    // $start_record is starting record of a page 
    // $max_records num of records in that page
    $items = array();
    $intIndex = 0;
    $str_condition = "";
    $strSQL = "SELECT * FROM items ORDER BY id";
    $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
    $rsRES = @mysql_query($strSQL_limit, $this->connection);
    if (mysql_num_rows($rsRES) > 0) {
      /*
       * i do not understand WHY this code in if block below is required
       * so i have commented it
       *
       * 
      //without limit  , result of that in $all_rs
      if (trim($this->total_records) != "" && $this->total_records > 0) {

      } else {
        $all_rs = @mysql_query($strSQL, $this->connection); 
        $this->total_records = mysql_num_rows($all_rs);
      }
      */
      
      $all_rs = @mysql_query($strSQL, $this->connection); 
      $this->total_records = mysql_num_rows($all_rs);

      while ($arrRES = mysql_fetch_assoc($rsRES)) {
        $items[$intIndex]["id"] =  $arrRES["id"];
        $items[$intIndex]["name"] = $arrRES["name"];
        $items[$intIndex]["description"] = $arrRES["description"];
        $items[$intIndex]["image"] = $arrRES["image"];
        $items[$intIndex]["keywords"] = $arrRES["keywords"];
        $items[$intIndex]["unit_price"] = $arrRES["unti_price"];
        $items[$intIndex]["tax_item"] = $arrRES["tax_item"];
        $items[$intIndex]["tax_shipping"] = $arrRES["tax_shipping"];
        $items[$intIndex]["item_status_id"] = $arrRES["item_status_id"];
        $items[$intIndex]["item_type_id"] = $arrRES["item_type_id"];
        
        $intIndex++;
      }
      return $items;
    } else {
      $this->error_number = 5;
      $this->error_description = "Unable to get data";
      return false;
    }
  }

  // INSERT / UPDATE item details
  function update() {
    if ($this->id == "" || $this->id == gINVALID) {
      $strSQL = "INSERT INTO items (name, description, image, keywords, ";
      $strSQL .= "unit_price, tax_item, tax_shipping) VALUES (";
      $strSQL .= "'" . mysql_real_escape_string(trim($this->name)) ."',";
      $strSQL .= "'" . mysql_real_escape_string(trim($this->description)) ."',";
      $strSQL .= "'" . mysql_real_escape_string(trim($this->image)) ."',";
      $strSQL .= "'" . mysql_real_escape_string(trim($this->keywords)) ."',";
      $strSQL .= "'" . floatval(trim($this->unit_price)) ."',";
      $strSQL .= "'" . floatval(trim($this->tax_item)) ."',";
      $strSQL .= "'" . floatval(trim($this->tax_shipping)) ."',";
      $strSQL .= ")";
      $rsRES = mysql_query($strSQL,$this->connection);
      if (mysql_affected_rows($this->connection) > 0) {
        $this->id = mysql_insert_id();
        return $this->id;
      }
      else {
        $this->error_number = 3;
        $this->error_description="Can't insert this Message";
        return false;
      }
    }
    elseif ($this->id > 0) {
      $strSQL = "UPDATE items SET ";
      $strSQL .= "name = '" . mysql_real_escape_string(trim($this->name)) . "', ";
      $strSQL .= "description = '" . mysql_real_escape_string(trim($this->description)) . "', ";
      $strSQL .= "image = '" . mysql_real_escape_string(trim($this->image)) ."', ";
      $strSQL .= "keywords = '" . mysql_real_escape_string(trim($this->keywords)) . "', ";
      $strSQL .= "unit_price = " . floatval(trim($this->unit_price)) . ",";
      $strSQL .= "tax_item = " . floatval(trim($this->tax_item)) .",";
      $strSQL .= "tax_shipping = " . floatval(trim($this->tax_shipping)) . ", ";
      $strSQL .= "item_status_id = " . intval(trim($this->item_status_id)) .", ";
      $strSQL .= "item_type_id = " . intval(trim($this->item_type)) . " ";
      $strSQL .= "WHERE id = ".$this->id;
      $rsRES = @mysql_query($strSQL, $this->connection);
      if (mysql_affected_rows($this->connection) >= 0) {
        return true;
      }
      else {
        $this->error_number = 3;
        $this->error_description="Unable to update this Item now";
        return false;
      }
    }
  }
}
?>
