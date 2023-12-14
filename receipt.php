<?php
session_start();
include "inc/common.initial.php";
include "common_user.php";

$SETPAGE = array(
	'css' => 'template/css.html',
	'main' => 'template/receipt.html',
	
);




$template->set_filenames($SETPAGE);	
$template->assign_var_from_handle('CSS', 'css');
$template->pparse('main');
$template->destroy();
?>

