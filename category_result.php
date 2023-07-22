<?php
session_start();
include "inc/common.initial.php";

if($_POST['mode'] == 'add'){
  
    $con3 = Db::query('INSERT INTO tb_category SET category_name=? ',$_POST['name']);

    header("Location: category");
}



if($_POST['mode'] == 'mo'){

    
  

    $con2 = Db::query('UPDATE tb_category SET category_name=? WHERE category_id=?',$_POST['name'],$_POST['id']);
 

    header("Location: category");
}

if($_GET['getId']){
   
    $con = Db::queryOne('SELECT * FROM tb_category WHERE category_id=?',$_GET['getId']);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

if($_GET['del']){
    $con = Db::query('UPDATE tb_category SET deleted_at = NOW() WHERE category_id=?',$_GET['del']);
}




?>

