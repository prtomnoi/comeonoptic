<?php
session_start();
include "inc/common.initial.php";

if($_POST['mode'] == 'add'){
  
    $con3 = Db::query('INSERT INTO tb_kind SET kind_name=? ',$_POST['name']);

    header("Location: kind");
}



if($_POST['mode'] == 'mo'){

    $con2 = Db::query('UPDATE tb_kind SET kind_name=? WHERE kind_id=?',$_POST['name'],$_POST['id']);
 

    header("Location: kind");
}

if($_GET['getId']){
   
    $con = Db::queryOne('SELECT * FROM tb_kind WHERE kind_id=?',$_GET['getId']);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

if($_GET['del']){
    $con = Db::query('UPDATE tb_kind SET deleted_at = NOW() WHERE kind_id=?',$_GET['del']);
}




?>

