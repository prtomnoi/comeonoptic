<?php
session_start();
include "inc/common.initial.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if(@$_POST['mode'] == 'add'){
    $price = $_POST['price'];
    $price = str_replace(',', '', $price);
    $price = str_replace('$', '', $price);
    $decimalPrice = number_format((float) $price, 2, '.', '');

    $cost = $_POST['cost'];
    $cost = str_replace(',', '', $cost);
    $cost = str_replace('$', '', $cost);
    $decimalCost = number_format((float) $cost, 2, '.', '');


    if ($_FILES['fileToUpload']['name'] != "") {
        $file = $_FILES['fileToUpload'];
    
      
        $originalFileName = $file['name'];
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '.' . $extension;
    
        $uploadDir = 'uploads/';
    
        $uploadPath = $uploadDir . $uniqueName;
        move_uploaded_file($file['tmp_name'], $uploadPath);
    
        $maxWidth = 800;
        $maxHeight = 600;
    
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

        $con3 = Db::query('INSERT INTO tb_products SET product_category=? , product_type=?  , product_kind=? 
        , product_barcode=? , product_number=?, product_model=?, product_cost=?
        , product_price=?, product_amount=?, product_lot=?, product_file=?, product_branch=?',$_POST['category'],$_POST['type'],$_POST['kind'],$_POST['code']
        ,$_POST['number'],$_POST['name'],$decimalCost,$decimalPrice,$_POST['amount'],$_POST['date_lot'],$resizedImagePath,$_POST['branchGlobal']);
    }else{
    
    $con3 = Db::query('INSERT INTO tb_products SET product_category=? , product_type=?  , product_kind=? 
    , product_barcode=? , product_number=?, product_model=?, product_cost=?
    , product_price=?, product_amount=?, product_lot=?, product_branch=?',$_POST['category'],$_POST['type'],$_POST['kind'],$_POST['code']
    ,$_POST['number'],$_POST['name'],$decimalCost,$decimalPrice,$_POST['amount'],$_POST['date_lot'],$_POST['branchGlobal']);
    }
    header("Location: products");
}



if(@$_POST['mode'] == 'mo'){

    
    
    $price = $_POST['price'];
    $price = str_replace(',', '', $price);
    $price = str_replace('$', '', $price);
    $decimalPrice = number_format((float) $price, 2, '.', '');

    $cost = $_POST['cost'];
    $cost = str_replace(',', '', $cost);
    $cost = str_replace('$', '', $cost);
    $decimalCost = number_format((float) $cost, 2, '.', '');
    
    if ($_FILES['fileToUpload']['name'] != "") {
        $file = $_FILES['fileToUpload'];
    
      
        $originalFileName = $file['name'];
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '.' . $extension;
    
        $uploadDir = 'uploads/';
    
        $uploadPath = $uploadDir . $uniqueName;
        move_uploaded_file($file['tmp_name'], $uploadPath);
    
        $maxWidth = 800;
        $maxHeight = 600;
    
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
        unlink($_POST['oldPath']);
        $con3 = Db::query('UPDATE tb_products SET product_category=? , product_type=? , product_kind=?
        , product_barcode=? , product_number=?, product_model=?, product_cost=?
        , product_price=?, product_amount=?, product_lot=? , product_file=?, product_branch=? WHERE product_id=?',$_POST['category'],$_POST['type'],$_POST['kind'],$_POST['code']
        ,$_POST['number'],$_POST['name'],$decimalCost,$decimalPrice,$_POST['amount'],$_POST['date_lot'],$resizedImagePath,$_POST['branchGlobal'],$_POST['id']);

    }else{
        $con3 = Db::query('UPDATE tb_products SET product_category=? , product_type=?   , product_kind=?
        , product_barcode=? , product_number=?, product_model=?, product_cost=?
        , product_price=?, product_amount=?, product_lot=?, product_branch=? WHERE product_id=?',$_POST['category'],$_POST['type'],$_POST['kind'],$_POST['code']
        ,$_POST['number'],$_POST['name'],$decimalCost,$decimalPrice,$_POST['amount'],$_POST['date_lot'],$_POST['branchGlobal'],$_POST['id']);
    }


   

    header("Location: products");
}

if(@$_POST['barcode']){
   
    $con = Db::queryOne('SELECT * FROM tb_products WHERE product_barcode=?',$_POST['barcode']);

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

}else{



if(@$_GET['sale']){
   
    $con = Db::queryAll('SELECT * FROM tb_products WHERE deleted_at IS NULL');

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($con);

}

if(@$_GET['del']){
    $con = Db::query('UPDATE tb_products SET deleted_at = NOW() WHERE product_id=?',$_GET['del']);
}


}

?>

