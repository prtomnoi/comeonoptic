<?php
session_start();
include "inc/common.initial.php";
include "common_user.php";

$SETPAGE = array(
	'css' => 'template/css.html',
	'menu' => 'template/menu.html',
	'nav' => 'template/nav.html',
	'main' => 'template/employee.html',
	'footer' => 'template/footer.html',
	'js' => 'template/js.html',
);

$con2 = Db::queryAll('SELECT * FROM tb_branch  WHERE deleted_at IS NULL ORDER BY branch_id DESC');

for($i=0; $i<count($con2); $i++)
{


	$template->assign_block_vars('branch',array(

		"num" => ($i+1),
		"id" => $con2[$i]['branch_id'],
		"name" => $con2[$i]['branch_name'],
		"date" => $con2[$i]['created_at'],


	));

	
}


$con = Db::queryAll('SELECT * FROM tb_member LEFT JOIN tb_branch ON branch_id = member_branch  WHERE member_role = 2 AND member_status = 0 ORDER BY member_id DESC');

for($i=0; $i<count($con); $i++)
{

	$jobdate = calculateAge($con[$i]['member_jobdate']);

	$template->assign_block_vars('member',array(

		"num" => ($i+1),
		"id" => $con[$i]['member_id'],
		"name" => $con[$i]['member_name'],
		"phone" => $con[$i]['member_phone'],
		"code" => $con[$i]['member_code'],
		"branch" => $con[$i]['branch_name'],
		"date" => $con[$i]['created_at'],
		"jobdate" => $jobdate['years'] ." ปี - ". $jobdate['months'] ." เดือน - ".$jobdate['days'] . " วัน",


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

