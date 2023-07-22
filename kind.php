<?php
session_start();
include "inc/common.initial.php";
include "common_user.php";

$SETPAGE = array(
	'css' => 'template/css.html',
	'menu' => 'template/menu.html',
	'nav' => 'template/nav.html',
	'main' => 'template/kind.html',
	'footer' => 'template/footer.html',
	'js' => 'template/js.html',
);

$con = Db::queryAll('SELECT * FROM tb_kind  WHERE deleted_at IS NULL ORDER BY kind_id DESC');

for($i=0; $i<count($con); $i++)
{


	$template->assign_block_vars('kind',array(

		"num" => ($i+1),
		"id" => $con[$i]['kind_id'],
		"name" => $con[$i]['kind_name'],
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

