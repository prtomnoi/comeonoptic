<?php
session_start();
include "inc/common.initial.php";
include "common_user.php";

$SETPAGE = array(
	'css' => 'template/css.html',
	'menu' => 'template/menu.html',
	'nav' => 'template/nav.html',
	'main' => 'template/customer.html',
	'footer' => 'template/footer.html',
	'js' => 'template/js.html',
);




$con = Db::queryAll('SELECT * FROM tb_customer ORDER BY customer_id DESC');

for($i=0; $i<count($con); $i++)
{

	$age = calculateAge($con[$i]['customer_birthday']);
	$template->assign_block_vars('customer',array(

		"num" => ($i+1),
		"id" => $con[$i]['customer_id'],
		"name" => $con[$i]['customer_name'],
		"phone" => $con[$i]['customer_phone'],
		"address" => $con[$i]['customer_address'],
		"date" => $con[$i]['created_at'],
		"age" => $age['years'],


	));

	
}


$template->set_filenames($SETPAGE);	
$template->assign_var_from_handle('CSS', 'css');
$template->assign_var_from_handle('MENU', 'menu');
$template->assign_var_from_handle('NAV', 'nav');
$template->assign_var_from_handle('FOOTER', 'footer');
$template->assign_var_from_handle('JS', 'js');
$template->pparse('main');
$template->destroy();
?>

