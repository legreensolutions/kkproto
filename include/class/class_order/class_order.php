<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Order {
    var $connection;
    var $id = gINVALID;
    var $order_number = "";
    var $order_date = "";
    var $user_id = gINVALID;
    var $customer_id = gINVALID;
    var $shipping = 1;
    var $shipping_amount = "";
    var $tax = "";
    var $order_amount = "";
    var $commission_amount = "";
    var $order_status_id = 1;
    var $paymentoption_id = 1;
    var $paymentdate = "";
    var $paymentdetail = "";
    var $payment_status_id = 1;
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function get_id(){
    $strSQL = "SELECT id, order_number, order_date, user_id, customer_id, shipping, shipping_amount, tax, order_amount, commission_amount, order_status_id, paymentoption_id, paymentdate, paymentdetail, payment_status_id FROM orders WHERE order_number = '".$this->order_number."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->order_number = mysql_result($rsRES,0,'order_number');
        $this->order_date = mysql_result($rsRES,0,'order_date');
        $this->user_id = mysql_result($rsRES,0,'user_id');
        $this->customer_id = mysql_result($rsRES,0,'customer_id');
        $this->shipping = mysql_result($rsRES,0,'shipping');
        $this->shipping_amount = mysql_result($rsRES,0,'shipping_amount');
        $this->tax = mysql_result($rsRES,0,'tax');
        $this->order_amount = mysql_result($rsRES,0,'order_amount');
        $this->commission_amount = mysql_result($rsRES,0,'commission_amount');
        $this->order_status_id = mysql_result($rsRES,0,'order_status_id');
        $this->paymentoption_id = mysql_result($rsRES,0,'paymentoption_id');
        $this->paymentdate = mysql_result($rsRES,0,'paymentdate');
        $this->paymentdetail = mysql_result($rsRES,0,'paymentdetail');
        $this->payment_status_id = mysql_result($rsRES,0,'payment_status_id');
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This Order doesn't exist";
        return false;
    }
}



function get_detail(){
    $strSQL = "SELECT id, order_number, order_date, user_id, customer_id, shipping, shipping_amount, tax, order_amount, commission_amount, order_status_id, paymentoption_id, paymentdate, paymentdetail, payment_status_id FROM orders WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->order_number = mysql_result($rsRES,0,'order_number');
        $this->order_date = mysql_result($rsRES,0,'order_date');
        $this->user_id = mysql_result($rsRES,0,'user_id');
        $this->customer_id = mysql_result($rsRES,0,'customer_id');
        $this->shipping = mysql_result($rsRES,0,'shipping');
        $this->shipping_amount = mysql_result($rsRES,0,'shipping_amount');
        $this->tax = mysql_result($rsRES,0,'tax');
        $this->order_amount = mysql_result($rsRES,0,'order_amount');
        $this->commission_amount = mysql_result($rsRES,0,'commission_amount');
        $this->order_status_id = mysql_result($rsRES,0,'order_status_id');
        $this->paymentoption_id = mysql_result($rsRES,0,'paymentoption_id');
        $this->paymentdate = mysql_result($rsRES,0,'paymentdate');
        $this->paymentdetail = mysql_result($rsRES,0,'paymentdetail');
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
    $strSQL = "INSERT INTO orders ( order_number, order_date, user_id, customer_id, shipping, shipping_amount, tax, order_amount, commission_amount, order_status_id, paymentoption_id, paymentdate, paymentdetail, payment_status_id) VALUES ('";
    $strSQL .= addslashes(trim($this->order_number)) ."','";
    $strSQL .= addslashes(trim($this->order_date)) ."','";
    $strSQL .= addslashes(trim($this->user_id)) ."','";
    $strSQL .= addslashes(trim($this->customer_id)) ."','";
    $strSQL .= addslashes(trim($this->shipping)) ."','";
    $strSQL .= addslashes(trim($this->shipping_amount)) ."','";
    $strSQL .= addslashes(trim($this->tax)) ."','";
    $strSQL .= addslashes(trim($this->order_amount)) ."','";
    $strSQL .= addslashes(trim($this->commission_amount)) ."','";
    $strSQL .= addslashes(trim($this->order_status_id)) ."','";
    $strSQL .= addslashes(trim($this->paymentoption_id)) ."','";
    $strSQL .= addslashes(trim($this->paymentdate)) ."','";
    $strSQL .= addslashes(trim($this->paymentdetail)) ."','";
    $strSQL .= addslashes(trim($this->payment_status_id)) ."')";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this order_number";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE orders SET order_number = '".addslashes(trim($this->order_number))."',";
    $strSQL .= "order_date = '".addslashes(trim($this->order_date))."',";
    $strSQL .= "user_id = '".addslashes(trim($this->user_id))."',";
    $strSQL .= "customer_id = '".addslashes(trim($this->customer_id))."',";
    $strSQL .= "shipping_amount = '".addslashes(trim($this->shipping_amount))."',";
    $strSQL .= "shipping = '".addslashes(trim($this->shipping))."',";
    $strSQL .= "tax = '".addslashes(trim($this->tax))."',";
    $strSQL .= "order_amount = '".addslashes(trim($this->order_amount))."',";
    $strSQL .= "commission_amount = '".addslashes(trim($this->commission_amount))."',";
    $strSQL .= "order_status_id = '".addslashes(trim($this->order_status_id))."',";
    $strSQL .= "paymentoption_id = '".addslashes(trim($this->paymentoption_id))."',";
    $strSQL .= "paymentdate = '".addslashes(trim($this->paymentdate))."',";
    $strSQL .= "paymentdetail = '".addslashes(trim($this->paymentdetail))."',";
    $strSQL .= "payment_status_id = '".addslashes(trim($this->payment_status_id))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Order";
                return false;
            }
    }
}

function get_list_array(){
        $orders = array();$i=0;
        $strSQL = "SELECT id, order_number, order_date, user_id, customer_id, shipping, shipping_amount, tax, order_amount, commission_amount, order_status_id, paymentoption_id, paymentdate, paymentdetail, payment_status_id FROM orders ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$order_number, $order_date, $user_id, $customer_id, $shipping, $shipping_amount, $tax, $order_amount, $commission_amount, $order_status_id, $paymentoption_id, $paymentdate, $paymentdetail, $payment_status_id) = mysql_fetch_row($rsRES) ){
                $orders[$i]["id"] =  $id;
                $orders[$i]["order_number"] = $order_number;
                $orders[$i]["order_date"] = $order_date;
                $orders[$i]["user_id"] = $user_id;
                $orders[$i]["customer_id"] = $customer_id;
                $orders[$i]["shipping_amount"] = $shipping_amount;
                $orders[$i]["shipping"] = $shipping;
                $orders[$i]["tax"] = $tax;
                $orders[$i]["order_amount"] = $order_amount;
                $orders[$i]["commission_amount"] = $order_commission;
                $orders[$i]["order_status_id"] = $order_status_id;
                $orders[$i]["paymentoption_id"] = $paymentoption_id;
                $orders[$i]["paymentdate"] = $paymentdate;
                $orders[$i]["paymentdetail"] = $paymentdetail;
                $orders[$i]["payment_status_id"] = $payment_status_id;
                $i++;
            }
            return $orders;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Orders";
        return false;
        }
}

function get_list_array_bylimit($id=gINVALID,$order_number="", $order_date="", $user_id=gINVALID, $customer_id=gINVALID, $order_status_id = "", $paymentoption_id ="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT id, order_number, order_date, user_id, customer_id, shipping, shipping_amount, tax, order_amount, commission_amount, order_status_id, paymentoption_id, paymentdate, paymentdetail, payment_status_id FROM orders WHERE 1 ";
        if ( $id != "" && $id != gINVALID ) {
            $str_condition .= " AND id  = '" . $id . "'" ;
        }

        if ( $order_number != "" ) {
            $str_condition .= " AND order_number  LIKE '%" . $order_number . "%'" ;
        }

        if ( $order_date != "" ) {
            $str_condition .= " AND order_date  = '" . $order_date . "'" ;
        }

        if ( $user_id != "" && $user_id != gINVALID  ) {
            $str_condition .= " AND user_id  = '" . $user_id . "'" ;
        }

        if ( $customer_id != "" && $customer_id != gINVALID ) {
            $str_condition .= " AND customer_id  = '" . $customer_id . "'" ;
        }

        if ( $order_status_id != "" ) {
            $str_condition .= " AND order_status_id  = '" . $order_status_id . "'" ;
        }

        if ( $paymentoption_id != "" ) {
            $str_condition .= " AND paymentoption_id  = '" . $paymentoption_id . "'" ;
        }

        if (trim($str_condition) !="") {
            $strSQL .=  $str_condition . "  ";
        }
        $strSQL .= " ORDER BY id";
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
                $limited_data[$i]["order_number"] = $row["order_number"];
                $limited_data[$i]["order_date"] = $row["order_date"];
                $limited_data[$i]["user_id"] = $row["user_id"];
                $limited_data[$i]["customer_id"] = $row["customer_id"];
                $limited_data[$i]["shipping_amount"] = $row["shipping_amount"];
                $limited_data[$i]["shipping"] = $row["shipping"];
                $limited_data[$i]["tax"] = $row["tax"];
                $limited_data[$i]["order_amount"] = $row["order_amount"];
                $limited_data[$i]["commission_amount"] = $row["commission_amount"];
                $limited_data[$i]["order_status_id"] = $row["order_status_id"];
                $limited_data[$i]["paymentoption_id"] = $row["paymentoption_id"];
                $limited_data[$i]["paymentdate"] = $row["paymentdate"];
                $limited_data[$i]["paymentdetail"] = $row["paymentdetail"];
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
        $strSQL = " DELETE FROM orders WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this Order";
            return  false;
        }
    }
}
}


?>
