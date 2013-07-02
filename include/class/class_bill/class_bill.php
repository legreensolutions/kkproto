<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Bill {
    var $connection;
    var $id = gINVALID;
    var $bill_number = "";
    var $bill_date = "";
    var $user_id = gINVALID;
    var $customer_id = gINVALID;
    var $shipping = 1;
    var $shipping_amount = "";
    var $tax = "";
    var $bill_amount = "";
    var $discount = "";
    var $bill_status_id = 1;
    var $paymentoption_id = 1;
    var $paymentdate = "";
    var $payment_status_id = 1;
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function get_id(){
    $strSQL = "SELECT id, bill_number, bill_date, user_id, customer_id, shipping, shipping_amount, tax, bill_amount, discount, bill_status_id, paymentoption_id, paymentdate,  payment_status_id FROM bills WHERE bill_number = '".$this->bill_number."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->bill_number = mysql_result($rsRES,0,'bill_number');
        $this->bill_date = mysql_result($rsRES,0,'bill_date');
        $this->user_id = mysql_result($rsRES,0,'user_id');
        $this->customer_id = mysql_result($rsRES,0,'customer_id');
        $this->shipping = mysql_result($rsRES,0,'shipping');
        $this->shipping_amount = mysql_result($rsRES,0,'shipping_amount');
        $this->tax = mysql_result($rsRES,0,'tax');
        $this->bill_amount = mysql_result($rsRES,0,'bill_amount');
        $this->discount = mysql_result($rsRES,0,'discount');
        $this->bill_status_id = mysql_result($rsRES,0,'bill_status_id');
        $this->paymentoption_id = mysql_result($rsRES,0,'paymentoption_id');
        $this->paymentdate = mysql_result($rsRES,0,'paymentdate');
        $this->payment_status_id = mysql_result($rsRES,0,'payment_status_id');
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This bill doesn't exist";
        return false;
    }
}



function get_detail(){
    $strSQL = "SELECT id, bill_number, bill_date, user_id, customer_id, shipping, shipping_amount, tax, bill_amount, discount, bill_status_id, paymentoption_id, paymentdate, payment_status_id FROM bills WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->bill_number = mysql_result($rsRES,0,'bill_number');
        $this->bill_date = mysql_result($rsRES,0,'bill_date');
        $this->user_id = mysql_result($rsRES,0,'user_id');
        $this->customer_id = mysql_result($rsRES,0,'customer_id');
        $this->shipping = mysql_result($rsRES,0,'shipping');
        $this->shipping_amount = mysql_result($rsRES,0,'shipping_amount');
        $this->tax = mysql_result($rsRES,0,'tax');
        $this->bill_amount = mysql_result($rsRES,0,'bill_amount');
        $this->discount = mysql_result($rsRES,0,'discount');
        $this->bill_status_id = mysql_result($rsRES,0,'bill_status_id');
        $this->paymentoption_id = mysql_result($rsRES,0,'paymentoption_id');
        $this->paymentdate = mysql_result($rsRES,0,'paymentdate');
        $this->payment_status_id = mysql_result($rsRES,0,'payment_status_id');
        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO bills ( bill_number, bill_date, user_id, customer_id, shipping, shipping_amount, tax, bill_amount, discount, bill_status_id, paymentoption_id, paymentdate, payment_status_id) VALUES ('";
    $strSQL .= addslashes(trim($this->bill_number)) ."','";
    $strSQL .= addslashes(trim($this->bill_date)) ."','";
    $strSQL .= addslashes(trim($this->user_id)) ."','";
    $strSQL .= addslashes(trim($this->customer_id)) ."','";
    $strSQL .= addslashes(trim($this->shipping)) ."','";
    $strSQL .= addslashes(trim($this->shipping_amount)) ."','";
    $strSQL .= addslashes(trim($this->tax)) ."','";
    $strSQL .= addslashes(trim($this->bill_amount)) ."','";
    $strSQL .= addslashes(trim($this->discount)) ."','";
    $strSQL .= addslashes(trim($this->bill_status_id)) ."','";
    $strSQL .= addslashes(trim($this->paymentoption_id)) ."','";
    $strSQL .= addslashes(trim($this->paymentdate)) ."','";
    $strSQL .= addslashes(trim($this->payment_status_id)) ."')";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this bill_number";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE bills SET bill_number = '".addslashes(trim($this->bill_number))."',";
    $strSQL .= "bill_date = '".addslashes(trim($this->bill_date))."',";
    $strSQL .= "user_id = '".addslashes(trim($this->user_id))."',";
    $strSQL .= "customer_id = '".addslashes(trim($this->customer_id))."',";
    $strSQL .= "shipping_amount = '".addslashes(trim($this->shipping_amount))."',";
    $strSQL .= "shipping = '".addslashes(trim($this->shipping))."',";
    $strSQL .= "tax = '".addslashes(trim($this->tax))."',";
    $strSQL .= "bill_amount = '".addslashes(trim($this->bill_amount))."',";
    $strSQL .= "discount = '".addslashes(trim($this->discount))."',";
    $strSQL .= "bill_status_id = '".addslashes(trim($this->bill_status_id))."',";
    $strSQL .= "paymentoption_id = '".addslashes(trim($this->paymentoption_id))."',";
    $strSQL .= "paymentdate = '".addslashes(trim($this->paymentdate))."',";
    $strSQL .= "payment_status_id = '".addslashes(trim($this->payment_status_id))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this bill";
                return false;
            }
    }
}

function get_list_array(){
        $bills = array();$i=0;
        $strSQL = "SELECT id, bill_number, bill_date, user_id, customer_id, shipping, shipping_amount, tax, bill_amount, discount, bill_status_id, paymentoption_id, paymentdate, payment_status_id FROM bills bill BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$bill_number, $bill_date, $user_id, $customer_id, $shipping, $shipping_amount, $tax, $bill_amount, $discount, $bill_status_id, $paymentoption_id, $paymentdate, $payment_status_id) = mysql_fetch_row($rsRES) ){
                $bills[$i]["id"] =  $id;
                $bills[$i]["bill_number"] = $bill_number;
                $bills[$i]["bill_date"] = $bill_date;
                $bills[$i]["user_id"] = $user_id;
                $bills[$i]["customer_id"] = $customer_id;
                $bills[$i]["shipping_amount"] = $shipping_amount;
                $bills[$i]["shipping"] = $shipping;
                $bills[$i]["tax"] = $tax;
                $bills[$i]["bill_amount"] = $bill_amount;
                $bills[$i]["discount"] = $bill_commission;
                $bills[$i]["bill_status_id"] = $bill_status_id;
                $bills[$i]["paymentoption_id"] = $paymentoption_id;
                $bills[$i]["paymentdate"] = $paymentdate;
                $bills[$i]["payment_status_id"] = $payment_status_id;
                $i++;
            }
            return $bills;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list bills";
        return false;
        }
}

function get_list_array_bylimit($id=gINVALID,$bill_number="", $bill_date="", $user_id=gINVALID, $customer_id=gINVALID, $bill_status_id = "", $paymentoption_id ="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT id, bill_number, bill_date, user_id, customer_id, shipping, shipping_amount, tax, bill_amount, discount, bill_status_id, paymentoption_id, paymentdate,  payment_status_id FROM bills WHERE 1 ";
        if ( $id != "" && $id != gINVALID ) {
            $str_condition .= " AND id  = '" . $id . "'" ;
        }

        if ( $bill_number != "" ) {
            $str_condition .= " AND bill_number  LIKE '%" . $bill_number . "%'" ;
        }

        if ( $bill_date != "" ) {
            $str_condition .= " AND bill_date  = '" . $bill_date . "'" ;
        }

        if ( $user_id != "" && $user_id != gINVALID  ) {
            $str_condition .= " AND user_id  = '" . $user_id . "'" ;
        }

        if ( $customer_id != "" && $customer_id != gINVALID ) {
            $str_condition .= " AND customer_id  = '" . $customer_id . "'" ;
        }

        if ( $bill_status_id != "" ) {
            $str_condition .= " AND bill_status_id  = '" . $bill_status_id . "'" ;
        }

        if ( $paymentoption_id != "" ) {
            $str_condition .= " AND paymentoption_id  = '" . $paymentoption_id . "'" ;
        }

        if (trim($str_condition) !="") {
            $strSQL .=  $str_condition . "  ";
        }
        $strSQL .= " bill BY id";
        //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
                
            } else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }
    
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $limited_data[$i]["id"] = $row["id"];
                $limited_data[$i]["bill_number"] = $row["bill_number"];
                $limited_data[$i]["bill_date"] = $row["bill_date"];
                $limited_data[$i]["user_id"] = $row["user_id"];
                $limited_data[$i]["customer_id"] = $row["customer_id"];
                $limited_data[$i]["shipping_amount"] = $row["shipping_amount"];
                $limited_data[$i]["shipping"] = $row["shipping"];
                $limited_data[$i]["tax"] = $row["tax"];
                $limited_data[$i]["bill_amount"] = $row["bill_amount"];
                $limited_data[$i]["discount"] = $row["discount"];
                $limited_data[$i]["bill_status_id"] = $row["bill_status_id"];
                $limited_data[$i]["paymentoption_id"] = $row["paymentoption_id"];
                $limited_data[$i]["paymentdate"] = $row["paymentdate"];
                $limited_data[$i]["payment_status_id"] = $row["payment_status_id"];
                $i++;
            }
            return $limited_data;
        }else{
            $this->error_number = 5;
            $this->error_description="Can't get limited data";
            return false;
        }
}

function delete(){
    if($this->id > 0 ) {
        $strSQL = " DELETE FROM bills WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this bill";
            return  false;
        }
    }
}
}


?>
