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

<div class="container px-4">
                    <?php echo successMsg();
                    echo errorMsg(); ?>
                    <h2 class="mt-4">New Post</h2>

                    <form action="../assets/app/post_process.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Title:</label>
                                <input type="text" name="title" class="form-control rounded-0" required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>Post Image:</label>
                                <input type="file" name="image" class="form-control rounded-0" required>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Category:</label>
                                <select name="category" class="form-select rounded-0" required>
                                <option selected disabled>Pick a category</option>
                                    <option>Global</option>
                                    <option>Clinical</option>
                                    <option>Political</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Category (OTHERS):</label>
                                <select name="ocategory" class="form-select rounded-0">
                                <option selected disabled>Pick a category</option>
                                    <option>Medical Results</option>
                                    <option>Faculty News</option>
                                    <option>General</option>
                                </select>
                            </div>

                            <div class="col-12 my-3">
                                <textarea name="article" id="editor1" style="height: 300px;" required></textarea>
                            </div>


                            <div class="text-start" >
                                <button type="submit" name="addNewPost" class="btn rounded-0" style="background-color: #8bcffc ;">
                                    Submit Post
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

<section>
    <div class="container">
                    <?php
                        $sql = "SELECT * FROM users WHERE id = '$currUser'";
                        $query = mysqli_query($connectDB,$sql);

                        $row = mysqli_fetch_assoc($query);
                    ?>

                    <div class="card mx-auto shadow shadow-sm my-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class=" mx-auto my-3">Pending Posts</h2>
                            </div>
                            <?php
                                if (isset($_GET['q'])) {
                                    $filter = $_GET['q'];
                                    $sql = "SELECT * FROM user_posts WHERE post_status = '$filter'";
                                }else{
                                    $name = "Unverified";
                                    $sql = "SELECT * FROM user_posts WHERE post_status = '0'";
                                }
                                $query = mysqli_query($connectDB, $sql);
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>

                                <div class="col-md-6 mb-2 px-3">
                                    <div class="card">
                                            <div class="card-header">TITLE: <?php echo substr($row['title'], 0, 40); ?></div>

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                AUTHOR: <?php
                                                        $user = $row['userid'];
                                                        $uql = "SELECT * FROM users WHERE id = '$user'";
                                                        $getName = mysqli_query($connectDB, $uql);
                                                        $user = mysqli_fetch_assoc($getName);
                                                        echo ucwords($user['first_name']), '.' , ucwords($user['last_name']);
                                                        ?>
                                                </li>
                                                <li class="list-group-item">
                                                    POST ID: <?php echo $row['post_id']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    DATE: <?php echo $row['date_created']; ?>
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
                                <h2 class=" mx-auto my-3">Cancelled Posts</h2>
                            </div>
                            <?php
                                if (isset($_GET['q'])) {
                                    $filter = $_GET['q'];
                                    $sql = "SELECT * FROM user_posts WHERE post_status = '$filter'";
                                }else{
                                    $name = "Unverified";
                                    $sql = "SELECT * FROM user_posts WHERE post_status = '3'";
                                }
                                $query = mysqli_query($connectDB, $sql);
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>

                                <div class="col-md-6 mb-2 px-3">
                                    <div class="card">
                                            <div class="card-header">TITLE: <?php echo substr($row['title'], 0, 40); ?></div>

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                AUTHOR: <?php
                                                        $user = $row['userid'];
                                                        $uql = "SELECT * FROM users WHERE id = '$user'";
                                                        $getName = mysqli_query($connectDB, $uql);
                                                        $user = mysqli_fetch_assoc($getName);
                                                        echo ucwords($user['first_name']), '.' , ucwords($user['last_name']);
                                                        ?>
                                                </li>
                                                <li class="list-group-item">
                                                    POST ID: <?php echo $row['post_id']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    DATE: <?php echo $row['date_created']; ?>
                                                </li>
                                            </ul>   
                                            
                                    </div>                                
                                </div>

                                <?php } ?>

                            
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