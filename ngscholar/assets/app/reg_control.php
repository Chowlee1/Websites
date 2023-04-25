<?php
require "../app/db_con.php";
require "../modules/sessions.php";

// Sets the timezone on your application
date_default_timezone_set("Africa/Lagos");

//check if session is set

if (!isset($_POST["register"])) {
    //redirect the user
    $_SESSION["error_msg"] = "Please create an account to continue";
    header("Location: ../../register.php");
}else {
    //collect the data
    $fname = $_POST['fname']; 
    $lname = $_POST['lname']; 
    $email = $_POST['email']; 
    $phone = $_POST['phone']; 
    $gender = $_POST['gender']; 
    $password = $_POST['pass']; 
    $conPass = $_POST['conPass'];
    $bio = $_POST['bio'];
    $role = "visitor";
    $date = date("Y-m-d");

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($connectDB);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$email);
    $execute = mysqli_stmt_execute($stmt);

    $return = mysqli_stmt_get_result($stmt);

    $numRows = mysqli_num_rows($return);

    if ($numRows > 0) {
        $_SESSION['error_msg'] = 'This email is already taken';
        header('Location:../../register.php');
    } elseif (strlen($password) < 5) {
        $_SESSION['error_msg']= "Password must not be less than 8 characters!";
        header("Location: ../../register.php");
    }
    elseif($password != $conPass){
        $_SESSION['error_msg']= "Passwords do not match!";
            header("Location: ../../register.php");
    }else {
        //Encrypt Password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users(first_name,last_name,email,phone,gender,bio,user_password,user_role,date_created) VALUES(?,?,?,?,?,?,?,?,?)';
        $stmt = mysqli_stmt_init($connectDB);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"sssssssss",$fname,$lname,$email,$phone,$gender,$bio,$password,$role,$date);

        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            $_SESSION['success_msg']= "Registration Completed";
            header("Location: ../../login.php");
        } else {
            $_SESSION['error_msg']= "Something went wrong, Please try again";
            header("Location: ../../register.php");
        }
    }

}




?>