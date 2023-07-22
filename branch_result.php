<?php
session_start();
include "inc/common.initial.php";

if($_POST['mode'] == 'add'){
  
    $con3 = Db::query('INSERT INTO tb_branch SET branch_name=? ',$_POST['name']);

    header("Location: branch");
}



if($_POST['mode'] == 'mo'){

    
  

    $con2 = Db::query('UPDATE tb_branch SET branch_name=? WHERE branch_id=?',$_POST['name'],$_POST['id']);
 

    header("Location: branch");
}

if($_GET['getId']){
   
    $con = Db::queryOne('SELECT * FROM tb_branch WHERE branch_id=?',$_GET['getId']);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

if($_GET['del']){
    $con = Db::query('UPDATE tb_branch SET deleted_at = NOW() WHERE branch_id=?',$_GET['del']);
}




?>

