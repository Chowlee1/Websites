<?php
require_once "assets/modules/sessions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nigerian Health Blog">
    <meta name="keywords" content="health, nigeria, naija, hospital, clinic, medicine, health center, doctor, nurse, midwives, professor, lecturer, scholar, articles, university, PH.D, Masters, Citation, pharmacy, health staff, pharmacist, laboratory scientist, medical center">
    <title>NG Scholar</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/CSS/pattern.min.css">

</head>

<body class="pattern-cross-dots-sm" style="background-color: #B3E6B5 ;">

<!-- NAVBAR -->
<?php require_once "assets/modules/navbar.php";?>

<?php if (!isset($_SESSION['id'])) { ?>

<section>
    <div class="container my-5">
    <?php echo errorMsg(); echo successMsg(); ?>
        <div class="card mx-auto cue" style="max-width: 600px">
            <div class="card-body">
                <h2 class="text-center">Register with us</h2>
                <form action="assets/app/reg_control.php" method="post" class="row">
                <div class="col-md-6 mb-2">
                    <label>First Name: </label>
                    <input type="text" name="fname" class="form-control rounded-0 shadow-sm" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Last Name: </label>
                    <input type="text" name="lname" class="form-control rounded-0 shadow-sm" required>
                </div>
                <div class="col-12 mb-2">
                    <label>Email: </label>
                    <input type="email" name="email" class="form-control rounded-0 shadow-sm" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Phone: </label>
                    <input type="tel" name="phone" class="form-control rounded-0 shadow-sm" placeholder="+1234567890" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Gender: </label>
                    <select name="gender" class="form-select rounded-0" required>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Password: </label>
                    <input type="password" name="pass" class="form-control rounded-0 shadow-sm" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Confirm Password: </label>
                    <input type="password" name="conPass" class="form-control rounded-0 shadow-sm" required>
                </div>
                <div class="col-12 mb-2">
                    <label>Bio: </label>
                    <textarea type="text" name="bio" class="form-control rounded-0 shadow-sm" style="height: 80px ;" required></textarea>
                </div>

                <div class="text-center my-3">
                    <button type="submit" name="register" class="btn rounded-0 px-5 py-2" style="background-color: #8bcffc ;">Submit</button>
                </div>
                </form>
            </div>
            <div class="text-center py-3">
            <small>Already have an account? <a href="login.php" class="nav-link p-1 d-inline" style="color:black; background-color: #8bcffc ;">Log in</a></small>
            </div>
        </div>
    </div>
</section>
<?php }else{ ?>
    <div class="container my-5">
        <div class="card mx-auto cue" style="max-width: 600px">
            <div class="card-body text-center">
                <h2>LOGOUT FIRST BEFORE YOU REGISTER</h2>
                <div class="text-center my-3">
                    <button type="submit" onclick="location.href='assets/app/logout_control.php'" class="btn rounded-0 px-5 py-2" style="background-color: #8bcffc ;">Logout</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</html>