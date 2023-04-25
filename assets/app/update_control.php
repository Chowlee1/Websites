<?php
require "../modules/sessions.php";
require "db_con.php";

$currUser = $_SESSION['id'];

if (!isset($_POST['updateDetails'])) {
    header('Location:../../index.php');
}else{

    //collect information
    $fname = $_POST['fname'];
    $lname = $_POST['lname']; 
    $phone = $_POST['phone']; 
    $bio = $_POST['bio'];

    //first name update
    if (!empty($fname)) {
        $sql = "UPDATE users SET first_name = '$fname' WHERE id = '$currUser'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Update Successful";
                        if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminprofile_dashboard.php");
                        }else{
                         header("Location: ../../users/profile_dashboard.php");}
                 }
                    }else{
                        if ($_SESSION['role'] === "admin"){
                            header("Location: ../../admin/adminprofile_dashboard.php");
                        }else{
                        header("Location: ../../users/profile_dashboard.php");}
                    }
    //last name update

    if (!empty($lname)) {
        $sql = "UPDATE users SET last_name = '$lname' WHERE id = '$currUser'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Update Successful";
                        if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminprofile_dashboard.php");
                    }else{
                    header("Location: ../../users/profile_dashboard.php");}
                }
                    }else{
                        if ($_SESSION['role'] === "admin"){
                            header("Location: ../../admin/adminprofile_dashboard.php");
                        }else{
                        header("Location: ../../users/profile_dashboard.php");}
                    }

    //phone update
    if (!empty($phone)) {
        $sql = "UPDATE users SET phone = '$phone' WHERE id = '$currUser'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Update Successful";
                        if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminprofile_dashboard.php");
                    }else{
                    header("Location: ../../users/profile_dashboard.php");}
                 }
                    }else{
                        if ($_SESSION['role'] === "admin"){
                            header("Location: ../../admin/adminprofile_dashboard.php");
                        }else{
                        header("Location: ../../users/profile_dashboard.php");}
        }

//bio update
if (!empty($bio)) {
    $sql = "UPDATE users SET bio = '$bio' WHERE id = '$currUser'";
    $query = mysqli_query($connectDB,$sql);
    if ($query) {
        $_SESSION['success_msg'] = "Update Successful";
                    if ($_SESSION['role'] === "admin"){
                    header("Location: ../../admin/adminprofile_dashboard.php");
                }else{
                header("Location: ../../users/profile_dashboard.php");}
            }
                }else{
                    if ($_SESSION['role'] === "admin"){
                        header("Location: ../../admin/adminprofile_dashboard.php");
                    }else{
                    header("Location: ../../users/profile_dashboard.php");}
                }

}
?>