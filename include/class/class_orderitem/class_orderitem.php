<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Orderitem {
    var $connection;
    var $id = gINVALID;
    var $order_id = gINVALID;
    var $item_id = gINVALID;
    var $quantity = "";
    var $unit_price = "";
    var $shipping_amount = "";
    var $tax_item = "";
    var $tax_shipping = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";



function get_detail(){
    $strSQL = "SELECT id, order_id, item_id, quantity, unit_price, shipping_amount, tax_item, tax_shipping  FROM orderitems WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->order_id = mysql_result($rsRES,0,'order_id');
        $this->item_id = mysql_result($rsRES,0,'item_id');
        $this->quantity = mysql_result($rsRES,0,'quantity');
        $this->unit_price = mysql_result($rsRES,0,'unit_price');
        $this->shipping_amount = mysql_result($rsRES,0,'shipping_amount');
        $this->tax_item = mysql_result($rsRES,0,'tax_item');
        $this->tax_shipping = mysql_result($rsRES,0,'tax_shipping');
        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function get_order_detail(){
        $orderitems = array();$i=0;
        $strSQL = "SELECT id, order_id, item_id, quantity, unit_price, shipping_amount, tax_item, tax_shipping  FROM orderitems WHERE order_id = '".$this->order_id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$order_id,$item_id) = mysql_fetch_row($rsRES) ){
                $orderitems[$i]["id"] =  $id;
                $orderitems[$i]["order_id"] = $order_id;
                $orderitems[$i]["item_id"] = $item_id;
                $orderitems[$i]["quantity"] = $quantity;
                $orderitems[$i]["unit_price"] = $unit_price;
                $orderitems[$i]["shipping_amount"] = $shipping_amount;
                $orderitems[$i]["tax_item"] = $tax_item;
                $orderitems[$i]["tax_shipping"] = $tax_shipping;
                $i++;
            }
            return $orderitems;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Orderitem";
        return false;
        }
}






function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO orderitems (order_id, item_id, quantity, unit_price, shipping_amount, tax_item, tax_shipping) VALUES ('";
    $strSQL .= addslashes(trim($this->order_id)) ."','";
    $strSQL .= addslashes(trim($this->item_id)) ."','";
    $strSQL .= addslashes(trim($this->quantity)) ."','";
    $strSQL .= addslashes(trim($this->unit_price)) ."','";
    $strSQL .= addslashes(trim($this->shipping_amount)) ."','";
    $strSQL .= addslashes(trim($this->tax_item)) ."','";
    $strSQL .= addslashes(trim($this->tax_shipping)) ."')";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this order_id";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE orderitems SET order_id = '".addslashes(trim($this->order_id))."',";
    $strSQL .= "item_id = '".addslashes(trim($this->item_id))."'";
    $strSQL .= "quantity = '".addslashes(trim($this->quantity))."'";
    $strSQL .= "unit_price = '".addslashes(trim($this->unit_price))."'";
    $strSQL .= "shipping_amount = '".addslashes(trim($this->shipping_amount))."'";
    $strSQL .= "tax_item = '".addslashes(trim($this->tax_item))."'";
    $strSQL .= "tax_shipping = '".addslashes(trim($this->tax_shipping))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Orderitem";
                return false;
            }
    }
}

function get_list_array(){
        $orderitems = array();$i=0;
        $strSQL = "SELECT id, order_id, item_id, quantity, unit_price, shipping_amount, tax_item, tax_shipping FROM orderitems ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$order_id,$item_id) = mysql_fetch_row($rsRES) ){
                $orderitems[$i]["id"] =  $id;
                $orderitems[$i]["order_id"] = $order_id;
                $orderitems[$i]["item_id"] = $item_id;
                $orderitems[$i]["quantity"] = $quantity;
                $orderitems[$i]["unit_price"] = $unit_price;
                $orderitems[$i]["shipping_amount"] = $shipping_amount;
                $orderitems[$i]["tax_item"] = $tax_item;
                $orderitems[$i]["tax_shipping"] = $tax_shipping;
                $i++;
            }
            return $orderitems;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Orderitem";
        return false;
        }
}



function delete(){
    if($this->id > 0 ) {
        $strSQL = " DELETE FROM orderitems WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this Orderitem";
            return  false;
        }
    }
}
}


?>
