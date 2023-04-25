<?php
require_once "../assets/app/db_con.php";
require_once "../assets/modules/sessions.php";
adminAuth();

if (!isset($_SESSION['id'])) {
    $_SESSION['error_msg'] = 'Login to continue';
    header("Location:../login.php");
}else{
    $currUser = $_SESSION['id'];

    // Change name
if (isset($_GET['q'])) {
    $filter = $_GET['q'];
    switch ($filter) {
        case '0':
            $name = "Unverified";
            break;
        case '1':
            $name = "Verified";
            break;
        case '2':
            $name = "Canceled";
            break;
        
        default:
            $name = "No";
            break;
    }
}else{
    $name = "Unverified";
}

    // Change name(items)
    if (isset($_GET['p'])) {
        $filtr = $_GET['p'];
        switch ($filtr) {
            case '0':
                $nam = "Unverified";
                break;
            case '1':
                $nam = "Verified";
                break;
            case '2':
                $nam = "Canceled";
                break;
            
            default:
                $nam = "No";
                break;
        }
    }else{
        $nam = "Unverified";
    }
    
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

<!-- HERO -->

<section>
<div class="container px-4">
                    <?php echo successMsg();
                    echo errorMsg(); ?>

                    <?php
                        $sql = "SELECT * FROM users WHERE id = '$currUser'";
                        $query = mysqli_query($connectDB,$sql);

                        $row = mysqli_fetch_assoc($query);
                    ?>

                    <div class="card mx-auto shadow shadow-sm">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class=" mx-auto my-3">Unverified Posts</h2>
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

                                            <a href="adminread.php?q=<?php echo $row['post_id']; ?>&author=<?php echo ucwords($user['first_name']), '.' , ucwords($user['last_name']); ?>&date=<?php echo $row['date_created']; ?>" class="btn w-50 mx-auto my-2" style="background-color: #8bcffc ;">Go to <i class="fa fa-sign-out-alt ms-3"></i> </a>
                                    </div>                                
                                </div>

                                <?php } ?>

                            
                        </div>
                    </div>


                    <div class="card mx-auto shadow shadow-sm mt-5">
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
                                        <div class="d-flex">

                                            <a href="adminread.php?q=<?php echo $row['post_id']; ?>&author=<?php echo ucwords($user['first_name']), '.' , ucwords($user['last_name']); ?>&date=<?php echo $row['date_created']; ?>" class="btn w-50 mx-auto my-2" style="background-color: #8bcffc ;">Go to <i class="fa fa-sign-out-alt ms-3"></i> </a>

                                            <a href="../assets/app/post_process.php?delPost=<?php echo $row['post_id']; ?>" class="btn w-25 mx-auto my-2" style=" color:white; background-color: red ;">Delete</a>
                                        </div>
                                            
                                    </div>                                
                                </div>

                                <?php } ?>

                            
                        </div>
                    </div>

            

                    <div class="card mx-auto shadow shadow-sm mt-5">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class=" mx-auto my-3">Unverified Items</h2>
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

                                            <a href="adminitem_confirm.php?q=<?php echo $roww['item_id']; ?>&author=<?php echo ucwords($user['first_name']), '.' , ucwords($user['last_name']); ?>&date=<?php echo $roww['date_created']; ?>" class="btn w-50 mx-auto my-2" style="background-color: #8bcffc ;">Go to <i class="fa fa-sign-out-alt ms-3"></i> </a>
                                    </div>                                
                                </div>

                                <?php } ?>

                            
                        </div>
                    </div>


                    <div class="card mx-auto shadow shadow-sm mt-5">
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

                                            <div class="d-flex">
                                                <a href="adminitem_confirm.php?q=<?php echo $roww['item_id']; ?>&author=<?php echo ucwords($user['first_name']), '.' , ucwords($user['last_name']); ?>&date=<?php echo $roww['date_created']; ?>" class="btn w-25 mx-auto my-2" style="background-color: #8bcffc ;">
                                                    Go to <i class="fa fa-sign-out-alt ms-3"></i> 
                                                </a>

                                                <a href="../assets/app/post_process.php?delItem=<?php echo $roww['item_id']; ?>" class="btn w-25 mx-auto my-2" style=" color:white; background-color: red ;">DELETE</a>
                                            </div>

                                            
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

<script src="../assets/js/bootstrap.bundle.min.js">
    
</script>
</html>

<?php }?>