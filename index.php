<?php
session_start();
mb_internal_encoding("UTF-8");
ini_set('display_errors', 1);
ob_start();
include "inc/common.initial.php";

$SETPAGE = array(
	'main' => 'template/login.html',
);

// echo SHA1("Thaiplan2022#A^jblgfdr#Z");
// exit;



$template->set_filenames($SETPAGE);	
$template->pparse('main');
$template->destroy();
?>

