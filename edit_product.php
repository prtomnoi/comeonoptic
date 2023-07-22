<?php
session_start();
include "inc/common.initial.php";
include "common_user.php";

$SETPAGE = array(
	'css' => 'template/css.html',
	'menu' => 'template/menu.html',
	'nav' => 'template/nav.html',
	'main' => 'template/edit_product.html',
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

$con3 = Db::queryAll('SELECT * FROM tb_type   ORDER BY type_id DESC');

for($i=0; $i<count($con3); $i++)
{


	$template->assign_block_vars('type',array(

		"num" => ($i+1),
		"id" => $con3[$i]['type_id'],
		"name" => $con3[$i]['type_name'],
	));
}


$con4 = Db::queryAll('SELECT * FROM tb_kind  WHERE deleted_at IS NULL  ORDER BY kind_id ASC');

for($i=0; $i<count($con4); $i++)
{


	$template->assign_block_vars('kind',array(

		"num" => ($i+1),
		"id" => $con4[$i]['kind_id'],
		"name" => $con4[$i]['kind_name'],
	));
}


$con = Db::queryOne('SELECT * FROM tb_products   WHERE product_id = ?', $_GET['id']);


	$template->assign_vars(array(

		"id" => $con['product_id'],
		"type" => $con['product_type'],
		"category" => $con['product_category'],
		"kind" => $con['product_kind'],
		"number" => $con['product_number'],
		"model" => $con['product_model'],
		"code" => $con['product_barcode'],
		"amount" => $con['product_amount'],
		"price" => $con['product_price'],
		"cost" => $con['product_cost'],
		"date_lot" => $con['product_lot'],
		"file" => $con['product_file'],
		"branch" => $con['product_branch'],


	));



$template->assign_vars(array(

    "today" => date('Y-m-d'),
));

$template->set_filenames($SETPAGE);	
$template->assign_var_from_handle('CSS', 'css');
$template->assign_var_from_handle('MENU', 'menu');
$template->assign_var_from_handle('NAV', 'nav');
$template->assign_var_from_handle('FOOTER', 'footer');
$template->assign_var_from_handle('JS', 'js');
$template->pparse('main');
$template->destroy();
?>

