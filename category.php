<?php
session_start();
include "inc/common.initial.php";
include "common_user.php";

$SETPAGE = array(
	'css' => 'template/css.html',
	'menu' => 'template/menu.html',
	'nav' => 'template/nav.html',
	'main' => 'template/category.html',
	'footer' => 'template/footer.html',
	'js' => 'template/js.html',
);

$con = Db::queryAll('SELECT * FROM tb_category  WHERE deleted_at IS NULL ORDER BY category_id DESC');

for($i=0; $i<count($con); $i++)
{


	$template->assign_block_vars('category',array(

		"num" => ($i+1),
		"id" => $con[$i]['category_id'],
		"name" => $con[$i]['category_name'],
		"date" => $con[$i]['created_at'],


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

