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

<!-- body -->
        <div class="container" style="max-width: 800px ;">
            
        
                <div class="my-2">
                    <h2>CREATE ITEM</h2>
                </div>

                <form action="../assets/app/item_control.php" method="post" enctype="multipart/form-data" class="row card-body">
                    <div class="col-12 mb-2">
                        <label>Title: </label>
                        <input type="text" name="itemTitle" class="form-control rounded-0 shadow-sm" required>
                    </div>

                    <div class="col-12 mb-2">
                        <label>Post Image:</label>
                        <input type="file" name="image" class="form-control rounded-0" required>
                    </div>

                    <div class="col-12 mb-2">
                        <label>Authors: </label>
                        <input type="text" name="authors" class="form-control rounded-0 shadow-sm" required>
                    </div>

                    <div class="col-12 mb-2">
                        <label>Price in $: </label>
                        <input type="text" name='price' class="form-control rounded-0 shadow-sm" placeholder="For free items, type 'FREE'" required>
                    </div>

                    <div class="col-12 mb-2">
                        <label>Category:</label>
                        <select name="category" class="form-select rounded-0" required>
                            <option selected disabled>Pick a category</option>
                            <option>Global</option>
                            <option>Local</option>
                        </select>
                    </div>

                    <div class="col-12 mb-2">
                        <label>Upload Item:</label>
                        <input type="file" name="upload" class="form-control rounded-0" required>
                    </div>

                    <div class="text-center my-3">
                        <button type="submit" name="createItem" style="background-color: #8bcffc ;" class="btn rounded-0 px-5 py-2">Submit</button>
                    </div>
                </form>
        </div>
<?php require_once "../assets/modules/footer.php";?>
</body>
<script src="../assets/lib/ckeditor/ckeditor.js"></script>

<script> CKEDITOR.replace( 'editor1' );</script>

<script src="../assets/js/bootstrap.bundle.min.js">
    
</script>
</html>

<?php }?>