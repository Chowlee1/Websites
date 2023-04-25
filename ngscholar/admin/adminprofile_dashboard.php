<?php
require_once "../assets/app/db_con.php";
require_once "../assets/modules/sessions.php";
adminAuth();

if (!isset($_SESSION['id'])) {
    $_SESSION['error_msg'] = 'Login to continue';
    header("Location:../login.php");
}else{
    $currUser = $_SESSION['id'];
    
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
    <link rel="stylesheet" href="../assets/CSS/bootstrap.min.css">    
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/CSS/pattern.min.css">

</head>

<body class="pattern-cross-dots-sm" style="background-color: #B3E6B5 ;">

<!-- DASHBOARD NAVBAR -->

<?php require_once '../assets/modules/dashboard_nav.php' ?>

<section>
<div class="container-fluid px-4">
                    <?php echo successMsg();
                    echo errorMsg(); ?>

                    <?php
                        $sql = "SELECT * FROM users WHERE id = '$currUser'";
                        $query = mysqli_query($connectDB,$sql);

                        $row = mysqli_fetch_assoc($query);
                    ?>

<div class="card mx-auto" style="max-width: 600px;">
                            <form action="../assets/app/file_control.php" enctype="multipart/form-data" method="post" class="p-2">
                                <div class=" p-3 shadow-sm d-flex gap-5">
                                    <img src="../assets/images/avatars/<?php 
                                        $img = $row['prof_pic'];
                                        if (empty($img)) {
                                           echo "profilepic.png";
                                        }else{
                                            echo "$img?".mt_rand();
                                        }
                                    ?>" width="100" height="100" class="shadow d-block ms-4" alt="profile_pic">

                                    <div>
                                        <input type="file" name="file" class="form-control mb-3">
                                        <button type="submit" name="updatePic" class="btn btn-primary">
                                            Change Picture
                                        </button>
                                    </div>
                                </div>
                            </form>

                        <form action="../assets/app/update_control.php" method="post" class="row card-body">
                            <div class="col-12 mb-2">
                                <label>First Name: </label>
                                <input type="text" name="fname" placeholder="<?php echo $row['first_name']; ?>" class="form-control rounded-0 shadow-sm">
                            </div>

                            <div class="col-12 mb-2">
                                <label>Last Name: </label>
                                <input type="text" name="lname" placeholder="<?php echo $row['last_name']; ?>" class="form-control rounded-0 shadow-sm">
                            </div>

                            <div class="col-12 mb-2">
                                <label>Email: </label>
                                <input type="email" value="<?php echo $row['email']; ?>" class="form-control rounded-0 shadow-sm" disabled>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Phone: </label>
                                <input type="tel" name="phone" placeholder="<?php echo $row['phone']; ?>" class="form-control rounded-0 shadow-sm">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Gender: </label>
                                <select name="gender" class="form-select rounded-0">
                                    <option disabled selected><?php echo $row['gender']; ?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-12 mb-2">
                                <label>Bio: </label>
                                <textarea type="text" name="bio" placeholder="<?php echo $row['bio']; ?>" class="form-control rounded-0 shadow-sm"></textarea>
                            </div>
                            <div class="text-center my-3">
                                <button type="submit" name="updateDetails" style="background-color: #8bcffc ;" class="btn rounded-0 px-5 py-2">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
</section>
<?php require_once "../assets/modules/footer.php";?> 
</body>

<script src="../assets/js/bootstrap.bundle.min.js">
    
</script>
</html>

<?php }?>