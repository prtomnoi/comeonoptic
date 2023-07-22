<?php
session_start();
include "inc/common.initial.php";
include "common_user.php";

$SETPAGE = array(
	'css' => 'template/css.html',
	'menu' => 'template/menu.html',
	'nav' => 'template/nav.html',
	'main' => 'template/index.html',
	'footer' => 'template/footer.html',
	'js' => 'template/js.html',
);


$con = Db::queryAll('SELECT * FROM tb_products LEFT JOIN tb_category ON category_id = product_category  WHERE product_amount < 10 AND tb_products.deleted_at IS NULL ORDER BY product_id  DESC');

for($i=0; $i<count($con); $i++)
{


	$template->assign_block_vars('product',array(

		"num" => ($i+1),
		"id" => $con[$i]['product_id'],
		"category" => $con[$i]['category_name'],
		"model" => $con[$i]['product_model'],
		"code" => $con[$i]['product_barcode'],
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

