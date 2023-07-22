<?php
session_start();
include "inc/common.initial.php";
include "common_user.php";

$SETPAGE = array(
	'css' => 'template/css.html',
	'menu' => 'template/menu.html',
	'nav' => 'template/nav.html',
	'main' => 'template/products.html',
	'footer' => 'template/footer.html',
	'js' => 'template/js.html',
);

$con2 = Db::queryAll('SELECT * FROM tb_category  WHERE deleted_at IS NULL ORDER BY category_id DESC');

for($i=0; $i<count($con2); $i++)
{


	$template->assign_block_vars('category',array(

		"num" => ($i+1),
		"id" => $con2[$i]['category_id'],
		"name" => $con2[$i]['category_name'],
		"date" => $con2[$i]['created_at'],


	));

	
}


$con = Db::queryAll('SELECT * FROM tb_products LEFT JOIN tb_category ON category_id = product_category LEFT JOIN tb_branch ON product_branch = branch_id  WHERE tb_products.deleted_at IS NULL ORDER BY product_id  DESC');

for($i=0; $i<count($con); $i++)
{


	$template->assign_block_vars('product',array(

		"num" => ($i+1),
		"id" => $con[$i]['product_id'],
		"category" => $con[$i]['category_name'],
		"branch" => $con[$i]['branch_name'],
		"model" => $con[$i]['product_model'],
		"barcode" => $con[$i]['product_barcode'],
		"amount" => $con[$i]['product_amount'],
		"price" => number_format($con[$i]['product_price'],2),


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

