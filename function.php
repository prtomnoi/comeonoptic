<?php
session_start();
include "inc/common.initial.php";
include_once('./vendor/autoload.php');
header("Content-Type: application/json; charset=UTF-8");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


    $password =  SHA1($_POST['password']."A^jblgfdr#Z");
    $username = $_POST['username'];
	$con1 = Db::queryOne('SELECT * FROM tb_member WHERE  member_username = ? and member_password = ?  ',$username,$password);


	$resultArray = array();
        if($con1['member_id'] == ""){
         
            $template = array(
	
                "success" => false,
                "member_name" => NULL,  

            );

        }else{
           
            $key = 'ffcgmksaccn13244349ismsd$dsdsmasdfs1324#';
            $data = array(
                'id' => $con1['member_id'],
                'name' => $con1['member_name'],
                'email' => $con1['member_email'],
                'role' => $con1['member_role']
            );
            $payload = array(
                'iss' => 'https://comeonoptic.com/',
                'aud' => 'https://comeonoptic.com/',
                'iat' => time(),
                'exp' => time() + 36000*24, // 1 ชม.
                'data' => $data
            );

            $jwt = JWT::encode($payload, $key, 'HS256');

            if($con1['member_role'] == 1){
                $direct = "main";
            }else{
                $direct = "sale_page";
            }
         
            $template = array(
                "success" => true,
                "_token" => $jwt,
                "direct" => $direct,  
            );
            $_SESSION['auth-admin'] = $jwt;

        
        }
	
	    $arr2 = array("data" => $template);
	    echo json_encode($arr2);

