<?php
require_once "../assets/app/db_con.php";
require_once "../assets/modules/sessions.php";

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

<?php require_once '../assets/modules/user_dashboardnav.php' ?>

<!-- body -->
        <div class="container" style="max-width: 800px ;">
            
        
                <div class="my-2" style="color: black;">
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
                            <option>Regional</option>
                            <option>Nigerian</option>
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

<section>
    <div class="container" style="max-width: 800px ;">

            <div class="card mx-auto shadow shadow-sm my-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class=" mx-auto my-3">Items Pending Verification</h2>
                            </div>
                            <?php
                                if (isset($_GET['p'])) {
                                    $filter = $_GET['p'];
                                    $sqll = "SELECT * FROM user_items WHERE item_status = '$filtr'";
                                }else{
                                    $nam = "Unverified";
                                    $sqll = "SELECT * FROM user_items WHERE item_status = '0'";
                                }
                                $queryy = mysqli_query($connectDB, $sqll);
                                while ($roww = mysqli_fetch_assoc($queryy)) {
                                ?>

                                <div class="col-md-6 mb-2 px-3">
                                    <div class="card">
                                            <div class="card-header">TITLE: <?php echo substr($roww['item_name'], 0, 40); ?></div>

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                AUTHOR: <?php
                                                        $user = $roww['userid'];
                                                        $uql = "SELECT * FROM users WHERE id = '$user'";
                                                        $getName = mysqli_query($connectDB, $uql);
                                                        $user = mysqli_fetch_assoc($getName);
                                                        echo ucwords($user['first_name']), '.' , ucwords($user['last_name']);
                                                        ?>
                                                </li>
                                                <li class="list-group-item">
                                                    POST ID: <?php echo $roww['item_id']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    DATE: <?php echo $roww['date_created']; ?>
                                                </li>
                                            </ul>
                                    </div>                                
                                </div>

                                <?php } ?>

                            
                        </div>
                    </div>


                    <div class="card mx-auto shadow shadow-sm my-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class=" mx-auto my-3">Cancelled Items</h2>
                            </div>
                            <?php
                                if (isset($_GET['p'])) {
                                    $filter = $_GET['p'];
                                    $sqll = "SELECT * FROM user_items WHERE item_status = '$filtr'";
                                }else{
                                    $nam = "Unverified";
                                    $sqll = "SELECT * FROM user_items WHERE item_status = '3'";
                                }
                                $queryy = mysqli_query($connectDB, $sqll);
                                while ($roww = mysqli_fetch_assoc($queryy)) {
                                ?>

                                <div class="col-md-6 mb-2 px-3">
                                    <div class="card">
                                            <div class="card-header">TITLE: <?php echo substr($roww['item_name'], 0, 40); ?></div>

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                AUTHOR: <?php
                                                        $user = $roww['userid'];
                                                        $uql = "SELECT * FROM users WHERE id = '$user'";
                                                        $getName = mysqli_query($connectDB, $uql);
                                                        $user = mysqli_fetch_assoc($getName);
                                                        echo ucwords($user['first_name']), '.' , ucwords($user['last_name']);
                                                        ?>
                                                </li>
                                                <li class="list-group-item">
                                                    POST ID: <?php echo $roww['item_id']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    DATE: <?php echo $roww['date_created']; ?>
                                                </li>
                                            </ul>
                                    </div>                                
                                </div>
                               
                         <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
</section>

<button class="back-to-top hidden"><i class="fas fa-chevron-up"></i></button>
<script>
    const showOnPx = 100;
    const TopBtn = document.querySelector(".back-to-top");

    const scrollContainer = () =>{
        return document.documentElement || document.body;
    };

    document.addEventListener("scroll",() =>{
        if (scrollContainer().scrollTop > showOnPx){
            TopBtn.classList.remove("hidden");
        }else{
            TopBtn.classList.add("hidden");
        }
    })

    const goTop = () => {
        document.body.scrollIntoView({
            behavior: "smooth",
        });
    };

    TopBtn.addEventListener("click",goTop);
</script>


<?php require_once "../assets/modules/footer.php";?>
</body>
<script src="../assets/lib/ckeditor/ckeditor.js"></script>

<script> CKEDITOR.replace( 'editor1' );</script>

<script src="../assets/js/bootstrap.bundle.min.js">
    
</script>
</html>

<?php }?>