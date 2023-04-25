<?php
require "db_con.php";
require "../modules/sessions.php";


$currUser = $_SESSION['id'];

// Sets the timezone on your application
date_default_timezone_set("Africa/Lagos");

if (isset($_POST['addNewPost'])) {
    // Collect Data
    $postId = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $postId = str_shuffle($postId);
    $postId = substr($postId, 1, 9);
    $title = $_POST['title'];
    $article = $_POST['article'];
    $category = $_POST['category'];
    $ocategory = $_POST['ocategory'];
    $date = date("Y-m-d");
    


    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];
    $status = "0";

    // Allowed Files
    $allowed = array("jpg", "png", "jpeg", "gif");

    $location = "../images/postImages/";
    // Generate the file type
    $fileName = explode(".", $fileName);
    // print_r($fileName);
    $fileName = end($fileName);
    $fileName = strtolower($fileName);
    

    if (in_array($fileName, $allowed)) {
        if ($fileError == 0) {
            if ($fileSize < 5000000) {
                // Generate a new Name for your file
                $fileNewName = "post" . $currUser . $postId . "." . $fileName;
                move_uploaded_file($fileTempName,$location.$fileNewName);
                $sql = "INSERT INTO user_posts(post_id, userid, title, main_img, post_article, post_status, category, others_category, date_created) VALUES(?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($connectDB);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"sssssssss",$postId, $currUser, $title, $fileNewName, $article, $status, $category, $ocategory, $date);
                $execute = mysqli_stmt_execute($stmt);
                if ($execute) {
                    $_SESSION['success_msg'] = "Post added successfully, Pending verification!";
                    if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminpost_dashboard.php");
                    }else{
                        header("Location: ../../users/post_dashboard.php");}
                } else {
                    $_SESSION['error_msg'] = "Post upload failed";
                    if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminpost_dashboard.php");
                    }else{
                        header("Location: ../../users/post_dashboard.php");}
                }
            } else {
                $_SESSION['error_msg'] = "File Size too large, max: 5mb";
                if ($_SESSION['role'] === "admin"){
                    header("Location: ../../admin/adminpost_dashboard.php");
                }else{
                    header("Location: ../../users/post_dashboard.php");}
            }
        } else {
            $_SESSION['error_msg'] = "This file is corrupted";
            if ($_SESSION['role'] === "admin"){
                header("Location: ../../admin/adminpost_dashboard.php");
            }else{
                header("Location: ../../users/post_dashboard.php");}
        }
    } else {
        $_SESSION['error_msg'] = "Please upload either a jpg,png,jpeg or gif file only";
        if ($_SESSION['role'] === "admin"){
            header("Location: ../../admin/adminpost_dashboard.php");
        }else{
            header("Location: ../../users/post_dashboard.php");}
    }
}


elseif(isset($_GET['confirmPost'])){
    $id = $_GET['confirmPost'];
    $sql = "UPDATE user_posts SET post_status = '1' WHERE post_id = '$id'";
    $query = mysqli_query($connectDB,$sql);
    if ($query) {
        $_SESSION['success_msg'] = "Post has been verified successfully!";
        header("Location: ../../admin/adminpost_confirm.php");
    }else{
        $_SESSION['error_msg'] = "Post verification failed!";
        header("Location: ../../admin/adminpost_confirm.php");
    }
}

elseif(isset($_GET['confirmItem'])){
    $id = $_GET['confirmItem'];
    $sql = "UPDATE user_items SET item_status = '1' WHERE item_id = '$id'";
    $query = mysqli_query($connectDB,$sql);
    if ($query) {
        $_SESSION['success_msg'] = "Item has been verified successfully!";
        header("Location: ../../admin/adminpost_confirm.php");
    }else{
        $_SESSION['error_msg'] = "Item verification failed!";
        header("Location: ../../admin/adminpost_confirm.php");
    }
}

elseif(isset($_GET['cancelPost'])){
    $id = $_GET['cancelPost'];
    $sql = "UPDATE user_posts SET post_status = '3' WHERE post_id = '$id'";
    $query = mysqli_query($connectDB,$sql);
    if ($query) {
        $_SESSION['success_msg'] = "Post has been cancelled!";
        header("Location: ../../admin/adminpost_confirm.php");
    }else{
        $_SESSION['error_msg'] = "Post cancelling failed!";
        header("Location: ../../admin/adminpost_confirm.php");
    }
}

elseif(isset($_GET['cancelItem'])){
    $id = $_GET['cancelItem'];
    $sql = "UPDATE user_items SET item_status = '3' WHERE item_id = '$id'";
    $query = mysqli_query($connectDB,$sql);
    if ($query) {
        $_SESSION['success_msg'] = "Item has been cancelled!";
        header("Location: ../../admin/adminpost_confirm.php");
    }else{
        $_SESSION['error_msg'] = "Item cancelling failed!";
        header("Location: ../../admin/adminpost_confirm.php");
    }
}

elseif (isset($_GET['delPost'])) {
    $del = $_GET['delPost'];
    $sql = "DELETE FROM user_posts WHERE post_id = '$del'";
    $query = mysqli_query($connectDB,$sql);

    if ($query) {
        $_SESSION['success_msg'] = "Post deleted!";
        header("Location: ".$_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['error_msg'] = "Delete failed";
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
}

elseif (isset($_GET['delItem'])) {
    $del = $_GET['delItem'];
    $sql = "DELETE FROM user_items WHERE item_id = '$del'";
    $query = mysqli_query($connectDB,$sql);

    if ($query) {
        $_SESSION['success_msg'] = "Item deleted!";
        header("Location: ".$_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['error_msg'] = "Item failed";
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
}
// Main Else
else {
    header("Location: ../../users/post_dashboard.php");
}

?>