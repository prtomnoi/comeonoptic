<?php
session_start();
include "inc/common.initial.php";

    // print_R($_POST); exit;
    if($_POST['customerId'] == ""){
        $con = Db::queryOne('SELECT * FROM tb_customer WHERE customer_phone=? ',$_POST['customerPhone']);
        if($con['customer_phone'] == ""){
            Db::query('INSERT INTO tb_customer SET customer_name=? , customer_phone=? ',$_POST['customerName'],$_POST['customerPhone']);
            $last = Db::getLastId();
        }else{
            $last = $con['customer_id'];
        }
        // echo $last; exit;
    }


   

    // header("Location: kind");








?>

