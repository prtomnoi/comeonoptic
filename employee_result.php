<?php
session_start();
include "inc/common.initial.php";

function uploadAndResizeImage($file, $uploadDir, $maxWidth, $maxHeight) {
    if ($file['name'] != "") {
        $originalFileName = $file['name'];
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '.' . $extension;
    
        $uploadPath = $uploadDir . $uniqueName;
        move_uploaded_file($file['tmp_name'], $uploadPath);
    
        list($width, $height) = getimagesize($uploadPath);
    
        $aspectRatio = $width / $height;
        if ($width > $maxWidth || $height > $maxHeight) {
            if ($maxWidth / $maxHeight > $aspectRatio) {
                $newWidth = $maxHeight * $aspectRatio;
                $newHeight = $maxHeight;
            } else {
                $newWidth = $maxWidth;
                $newHeight = $maxWidth / $aspectRatio;
            }
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }
    
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
    
        // Load the original image
        $originalImage = imagecreatefromjpeg($uploadPath); // Change the function based on the image type
    
        // Resize the image
        imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
        // Save the resized image
        $resizedImagePath = $uploadDir . 'file_' . $uniqueName;
        imagejpeg($resizedImage, $resizedImagePath); // Change the function based on the desired output format
    
        // Free up memory
        imagedestroy($originalImage);
        imagedestroy($resizedImage);
    
        // Remove the original uploaded file
        unlink($uploadPath);

        return $resizedImagePath;
    }

    return null; // Return null if no file was uploaded
}



if($_POST['mode'] == 'add'){

    $password =  SHA1($_POST['password']."A^jblgfdr#Z");
    $uploadDir = 'uploads/';
    $maxWidth = 800;
    $maxHeight = 600;

    if ($_FILES['personal']['name'] != "") {
      
        $personalfile = uploadAndResizeImage($_FILES['personal'], $uploadDir, $maxWidth, $maxHeight);
    }

    if ($_FILES['idcard']['name'] != "") {
        
        $idcardfile = uploadAndResizeImage($_FILES['idcard'], $uploadDir, $maxWidth, $maxHeight);
    }
    
    $con3 = Db::query('INSERT INTO tb_member SET member_branch=? , member_name=? , member_code=? 
    ,member_phone=? ,member_username=? ,member_password=? , member_role = ? , member_birthday = ?, member_jobdate = ?, member_personal = ?, member_idcard = ?'
    ,$_POST['branch'],$_POST['name'],$_POST['code'],$_POST['phone'],$_POST['username'],$password ,2,$_POST['birthday'],$_POST['jobdate'],$personalfile, $idcardfile);

    header("Location: employee");
}



if($_POST['mode'] == 'mo'){
    
    $uploadDir = 'uploads/';
    $maxWidth = 800;
    $maxHeight = 600;

    if ($_FILES['personal']['name'] != "") {
      
        $personalfile = uploadAndResizeImage($_FILES['personal'], $uploadDir, $maxWidth, $maxHeight);
    }else{
        $personalfile = $_POST['old1'];
    }

    if ($_FILES['idcard']['name'] != "") {
        
        $idcardfile = uploadAndResizeImage($_FILES['idcard'], $uploadDir, $maxWidth, $maxHeight);
    }else{
        $idcardfile = $_POST['old2'];
    }

    if($_POST['password'] == ""){
        $con3 = Db::query('UPDATE tb_member SET member_branch=? , member_name=? , member_code=? ,member_phone=? ,member_username=?, member_birthday = ?, member_jobdate = ?, member_personal = ?, member_idcard = ? WHERE member_id = ?
        ',$_POST['branch'],$_POST['name'],$_POST['code'],$_POST['phone'],$_POST['username'],$_POST['birthday'],$_POST['jobdate'],$personalfile,$idcardfile,$_POST['id']);
    }else{
        $password =  SHA1($_POST['password']."A^jblgfdr#Z");
        $con3 = Db::query('UPDATE tb_member SET member_branch=? , member_name=? , member_code=? ,member_phone=? ,member_username=? , member_password=?, member_birthday = ?, member_jobdate = ?, member_personal = ?, member_idcard = ? WHERE member_id = ?
        ',$_POST['branch'],$_POST['name'],$_POST['code'],$_POST['phone'],$_POST['username'],$password,$_POST['birthday'],$_POST['jobdate'],$personalfile,$idcardfile,$_POST['id']);
    }

 

    header("Location: employee");
}

if($_GET['getId']){
   
    $con = Db::queryOne('SELECT * FROM tb_member WHERE member_id=?',$_GET['getId']);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

if($_GET['del']){
    $con = Db::query('UPDATE tb_member SET member_status = 1 WHERE member_id=?',$_GET['del']);
}




?>

