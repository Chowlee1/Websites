<?php
require "db_con.php";
require "../modules/sessions.php";


$currUser = $_SESSION['id'];

// Sets the timezone on your application
date_default_timezone_set("Africa/Lagos");

if (isset($_POST['createItem'])) {
    // Collect Data
    $itemId = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $itemId = str_shuffle($itemId);
    $itemId = substr($itemId, 1, 9);
    $itemName = $_POST['itemTitle'];
    $authors = $_POST['authors'];
    $price = $_POST['price'];
    $icategory = $_POST['category'];
    $date = date("Y-m-d");
    $status = "0";
    


    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    $file2 = $_FILES['upload'];
    $fileName2 = $file2['name'];
    $fileTempName2 = $file2['tmp_name'];
    $fileError2 = $file2['error'];
    $fileSize2 = $file2['size'];




    // Allowed Files
    $allowed = array("jpg", "png", "jpeg", "gif");
    $allowed2 = array("pdf");

    $location = "../images/itemImages/";
    $location2 = "../files/";

    // Generate the file type
    $fileName = explode(".", $fileName);
    $fileName2 = explode(".", $fileName2);
    
    $fileName = end($fileName);
    $fileName2 = end($fileName2);

    $fileName = strtolower($fileName);
    $fileName2 = strtolower($fileName2);
    

    if (in_array($fileName, $allowed) and in_array($fileName2, $allowed2)) {
        if ($fileError == 0 and ($fileError2 == 0)) {
            if ($fileSize < 20000000 and $fileSize2 < 20000000) {
                // Generate a new Name for your file
                $fileNewName = "post" . $currUser . $itemId . "." . $fileName;
                move_uploaded_file($fileTempName,$location.$fileNewName);

                $fileNewName2 = "item" . $currUser . $itemId . "." . $fileName2;
                move_uploaded_file($fileTempName2,$location2.$fileNewName2);

                $sql = "INSERT INTO user_items(item_id, userid, item_name, item_img, item_authors, item_price, item_category, item_upload, item_status, date_created) VALUES(?,?,?,?,?,?,?,?,?,?)";

                $stmt = mysqli_stmt_init($connectDB);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"ssssssssss",$itemId, $currUser, $itemName, $fileNewName, $authors, $price, $icategory, $fileNewName2, $status, $date);
                $execute = mysqli_stmt_execute($stmt);
            if ($execute) {
                $_SESSION['success_msg'] = "Item added successfully, Pending verification!";
                     if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminitem_dashboard.php");
                        }else{
                    header("Location: ../../users/item_dashboard.php");}
            } else {
                $_SESSION['error_msg'] = "Item upload failed";
                      if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminitem_dashboard.php");
                        }else{
                    header("Location: ../../users/item_dashboard.php");}
                } 

            } else {
                $_SESSION['error_msg'] = "File Size too large, max: 20mb";
                     if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminitem_dashboard.php");
                        }else{
                    header("Location: ../../users/item_dashboard.php");}
            }
        } else {
            $_SESSION['error_msg'] = "This file is corrupted";
                     if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminitem_dashboard.php");
                        }else{
                    header("Location: ../../users/item_dashboard.php");}
        }
             } else {
                $_SESSION['error_msg'] = "Please upload pdf file type only";
                     if ($_SESSION['role'] === "admin"){
                                header("Location: ../../admin/adminitem_dashboard.php");
                        }else{
                            header("Location: ../../users/item_dashboard.php");}
                        }
            }
// Main Else
else {
    header("Location: ../../index.php");
}

?>