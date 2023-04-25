<?php

require "db_con.php";
require "../modules/sessions.php";

if (!isset($_SESSION['id'])) {
    $_SESSION["error_msg"] = 'Please login to continue';
    header("Location: ../../login.php");
}else{
    switch ($_SESSION['role']) {
        case 'admin':
            header("Location:../../admin/adminpost_dashboard.php");
            break;
        case 'user':
            $_SESSION['success_msg'] = "Good day ".strtoupper($_SESSION['first_name']);
            header("Location:../../users/profile_dashboard.php");
            break;
        
        default:
        header("Location:../../index.php");
            break;
    }
}
?>