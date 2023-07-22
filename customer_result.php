<?php
session_start();
include "inc/common.initial.php";

if($_POST['mode'] == 'add'){

    $password =  SHA1($_POST['password']."A^jblgfdr#Z");
    
    $con3 = Db::query('INSERT INTO tb_customer SET customer_name=? , customer_phone=? , customer_email=? , customer_birthday=?
    ,customer_address=?  ',$_POST['name'],$_POST['phone'],$_POST['email'],$_POST['birthday'],$_POST['address']);

    header("Location: customer");
}



if($_POST['mode'] == 'mo'){

    $con3 = Db::query('UPDATE tb_customer SET customer_name=? , customer_phone=? , customer_email=? , customer_birthday=?
    ,customer_address=? WHERE customer_id=? ',$_POST['name'],$_POST['phone'],$_POST['email'],$_POST['birthday'],$_POST['address'],$_POST['id']);
 

    header("Location: customer");
}

if($_GET['getId']){
   
    $con = Db::queryOne('SELECT * FROM tb_customer WHERE customer_id=?',$_GET['getId']);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

if($_GET['phone']){
   
    $con = Db::queryOne('SELECT * FROM tb_customer WHERE customer_phone=?',$_GET['phone']);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

if($_GET['del']){
    $con = Db::query('UPDATE tb_customer SET customer_status = 1 WHERE customer_id=?',$_GET['del']);
}




?>

