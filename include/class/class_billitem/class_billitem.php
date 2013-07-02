<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class BillItem {
    var $connection;
    var $id = gINVALID;
    var $bill_id = gINVALID;
    var $item_id = gINVALID;
    var $item_name = "";
    var $quantity = "";
    var $unit_price = "";
    var $amount = "";
    var $shipping_amount = "";
    var $tax = "";
    var $discount = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";



function get_detail(){
    $strSQL = "SELECT id, bill_id, item_id, quantity, unit_price, amount, shipping_amount, tax, discount  FROM billitems WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->bill_id = mysql_result($rsRES,0,'bill_id');
        $this->item_id = mysql_result($rsRES,0,'item_id');
        $this->quantity = mysql_result($rsRES,0,'quantity');
        $this->unit_price = mysql_result($rsRES,0,'unit_price');
        $this->shipping_amount = mysql_result($rsRES,0,'shipping_amount');
        $this->amount = mysql_result($rsRES,0,'amount');
        $this->tax = mysql_result($rsRES,0,'tax');
        $this->discount = mysql_result($rsRES,0,'discount');
        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function get_bill_detail(){
        $billitems = array();$i=0;
        $strSQL = "SELECT BI.id, BI.bill_id, BI.item_id, I.name as item_name, I.image as item_image, BI.quantity, BI.unit_price, BI.amount, BI.shipping_amount, BI.tax, BI.discount  FROM billitems OI, items I WHERE BI.item_id = I.id AND BI.bill_id = '".$this->bill_id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$bill_id,$item_id,$item_name, $item_image, $quantity, $unit_price, $amount, $shipping_amount, $tax, $discount) = mysql_fetch_row($rsRES) ){
                $billitems[$i]["id"] =  $id;
                $billitems[$i]["bill_id"] = $bill_id;
                $billitems[$i]["item_id"] = $item_id;
                $billitems[$i]["item_name"] = $item_id;
                $billitems[$i]["item_image"] = $item_image;
                $billitems[$i]["quantity"] = $quantity;
                $billitems[$i]["unit_price"] = $unit_price;
                $billitems[$i]["amount"] = $amount;
                $billitems[$i]["shipping_amount"] = $shipping_amount;
                $billitems[$i]["tax"] = $tax;
                $billitems[$i]["discount"] = $discount;
                $i++;
            }
            return $billitems;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list billitem";
        return false;
        }
}






function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO billitems (bill_id, item_id, quantity, unit_price, amount,shipping_amount, tax, discount) VALUES ('";
    $strSQL .= addslashes(trim($this->bill_id)) ."','";
    $strSQL .= addslashes(trim($this->item_id)) ."','";
    $strSQL .= addslashes(trim($this->quantity)) ."','";
    $strSQL .= addslashes(trim($this->unit_price)) ."','";
    $strSQL .= addslashes(trim($this->amount)) ."','";
    $strSQL .= addslashes(trim($this->shipping_amount)) ."','";
    $strSQL .= addslashes(trim($this->tax)) ."','";
    $strSQL .= addslashes(trim($this->discount)) ."')";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this bill_id";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE billitems SET bill_id = '".addslashes(trim($this->bill_id))."',";
    $strSQL .= "item_id = '".addslashes(trim($this->item_id))."'";
    $strSQL .= "quantity = '".addslashes(trim($this->quantity))."'";
    $strSQL .= "unit_price = '".addslashes(trim($this->unit_price))."'";
    $strSQL .= "amount = '".addslashes(trim($this->amount))."'";
    $strSQL .= "shipping_amount = '".addslashes(trim($this->shipping_amount))."'";
    $strSQL .= "tax = '".addslashes(trim($this->tax))."'";
    $strSQL .= "discount = '".addslashes(trim($this->discount))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this billitem";
                return false;
            }
    }
}

function get_list_array(){
        $billitems = array();$i=0;
        $strSQL = "SELECT id, bill_id, item_id, quantity, unit_price, amount, shipping_amount, tax, discount FROM billitems WHERE bill_id = '".addslashes(trim($this->bill_id))."'  bill BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$bill_id,$item_id,$quantity, $unit_price,  $amount, $shipping_amount, $tax,  $discount) = mysql_fetch_row($rsRES) ){
                $billitems[$i]["id"] =  $id;
                $billitems[$i]["bill_id"] = $bill_id;
                $billitems[$i]["item_id"] = $item_id;
                $billitems[$i]["quantity"] = $quantity;
                $billitems[$i]["unit_price"] = $unit_price;
                $billitems[$i]["amount"] = $amount;
                $billitems[$i]["shipping_amount"] = $shipping_amount;
                $billitems[$i]["tax"] = $tax;
                $billitems[$i]["discount"] = $discount;
                $i++;
            }
            return $billitems;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list billitems";
        return false;
        }
}



function delete(){
    if($this->id > 0 ) {
        $strSQL = " DELETE FROM billitems WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this billitem";
            return  false;
        }
    }
}


function delete_billitmes(){
    if($this->bill_id > 0 ) {
        $strSQL = " DELETE FROM billitems WHERE bill_id = '".$this->bill_id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete billitems";
            return  false;
        }
    }
}




}


?>
