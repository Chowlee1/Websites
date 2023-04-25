<?php
require "../modules/sessions.php";
require "db_con.php";

$currUser = $_SESSION['id'];


if (!isset($_POST['updatePic'])) {
    header('Location:../../index.php');
}else{
    // collect Data
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    // Allowed Files
    $allowed = array("jpg","png","jpeg","gif","avif");

    $location = "../images/avatars/";
    // Generate the file type
    $fileName = explode(".",$fileName);
    
    $fileName = end($fileName);
    
    $fileName = strtolower($fileName);
    
    if (in_array($fileName,$allowed)) {
        if ($fileError == 0) {
            if ($fileSize < 5000000) {
                // Generate a new Name for your file
                $fileNewName = "user".$currUser.".".$fileName;
                //Check if file exists
               if (file_exists($location.$fileNewName)) {
                   //if it exists, replace
                    unlink($location.$fileNewName);

                    $move = move_uploaded_file($fileTempName, $location.$fileNewName);
                    if ($move) {
                        $sql = "UPDATE users SET prof_pic = '$fileNewName' WHERE id = '$currUser'";
                        $query = mysqli_query($connectDB,$sql);
                        if ($query) {
                            $_SESSION['success_msg'] = "File upload successful";
                                if ($_SESSION['role'] === "admin"){
                                header("Location: ../../admin/adminprofile_dashboard.php");
                                    }else{
                                        header("Location: ../../users/profile_dashboard.php");} 
                                 }else{
                                        $_SESSION['error_msg'] = "File upload failed";
                                        if ($_SESSION['role'] === "admin"){
                                        header("Location: ../../admin/adminprofile_dashboard.php");
                                        }else{
                                        header("Location: ../../users/profile_dashboard.php");} 
                                        }
                                    }else{
                                    $_SESSION['error_msg'] = "File upload failed";
                            if ($_SESSION['role'] === "admin"){
                                 header("Location: ../../admin/adminprofile_dashboard.php");
                            }else{
                                header("Location: ../../users/profile_dashboard.php");} 
                             }
                            }else{
                                $move = move_uploaded_file($fileTempName, $location.$fileNewName);
                                if ($move) {
                                    $sql = "UPDATE users SET prof_pic = '$fileNewName' WHERE id = '$currUser'";
                                    $query = mysqli_query($connectDB,$sql);
                                    if ($query) {
                                        $_SESSION['success_msg'] = "File upload successful";
                                        if ($_SESSION['role'] === "admin"){
                                            header("Location: ../../admin/adminprofile_dashboard.php");
                                        }else{
                                            header("Location: ../../users/profile_dashboard.php");} 
                                        }else{
                                            $_SESSION['error_msg'] = "File upload failed";
                                            if ($_SESSION['role'] === "admin"){
                                                header("Location: ../../admin/adminprofile_dashboard.php");
                                            }else{
                                                header("Location: ../../users/profile_dashboard.php");} 
                                            }
                                        }else{
                                            $_SESSION['error_msg'] = "File upload failed";
                                            if ($_SESSION['role'] === "admin"){
                                                header("Location: ../../admin/adminprofile_dashboard.php");
                                            }else{
                                                header("Location: ../../users/profile_dashboard.php");} 
                                            }
                                        }
                                    }else{
                                        $_SESSION['error_msg'] = "File Size too large, max: 5mb";
                                        if ($_SESSION['role'] === "admin"){
                                            header("Location: ../../admin/adminprofile_dashboard.php");
                                        }else{
                                            header("Location: ../../users/profile_dashboard.php");} 
                                        }
                                    }else{
                                        $_SESSION['error_msg'] = "This file is corrupted";
                                        if ($_SESSION['role'] === "admin"){
                                            header("Location: ../../admin/adminprofile_dashboard.php");
                                        }else{
                                            header("Location: ../../users/profile_dashboard.php");} 
                                        }
                                    }else{
                                        $_SESSION['error_msg'] = "Please upload either a jpg,png,jpeg or gif file only";
                                        if ($_SESSION['role'] === "admin"){
                                            header("Location: ../../admin/adminprofile_dashboard.php");
                                        }else{
                                            header("Location: ../../users/profile_dashboard.php");}
                                        }
                                    }
?>