<?php
session_start();
include "inc/common.initial.php";

if($_POST['mode'] == 'add'){
  
    $con3 = Db::query('INSERT INTO tb_type SET type_name=? ',$_POST['name']);

    header("Location: type");
}



if($_POST['mode'] == 'mo'){

    
  

    $con2 = Db::query('UPDATE tb_type SET type_name=? WHERE type_id=?',$_POST['name'],$_POST['id']);
 

    header("Location: type");
}

if($_GET['getId']){
   
    $con = Db::queryOne('SELECT * FROM tb_type WHERE type_id=?',$_GET['getId']);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

if($_GET['del']){
    $con = Db::query('UPDATE tb_type SET deleted_at = NOW() WHERE type_id=?',$_GET['del']);
}




?>

