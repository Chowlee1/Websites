<?php
require_once "../assets/app/db_con.php";
require_once "../assets/modules/sessions.php";
adminAuth();

if (!isset($_SESSION['id'])) {
    $_SESSION['error_msg'] = 'Login to continue';
    header("Location:../login.php");
}else{
    $currUser = $_SESSION['id'];



if(!isset($_GET['q'])){
        header("Location: adminitem_dashboard.php");
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

<?php require_once '../assets/modules/dashboard_nav.php' ?>

<section>
    <div class="container-fluid px-4">
        <?php echo successMsg();
        echo errorMsg(); 
        $post = $_GET['q'];
        $sql= "SELECT * FROM user_items WHERE item_id = '$post'";
        $query = mysqli_query($connectDB,$sql);
        $row = mysqli_fetch_assoc($query);
        
        ?>
        <div class="card mx-auto shadow-sm mt-4" style="max-width: 990px;">
            <div class="card-header">
                <h2 class="fw-bold"><?php echo ucwords($row['item_name']); ?></h2>
                <h5>Posted by: <?php
                                    $uid = $row['userid'];

                                    $user = getValue($connectDB, "*", "users", "id", $uid);
                                    echo ucwords($user['first_name']), '.', ucwords($user['last_name']);
                                    ?>
                <h5>Author: <span class="fw-lighter"><?php echo $row['item_authors'] ?></span></h5>
                <h6><i class="far fa-clock"></i> <span class="fw-lighter"><?php 
                    $date = date_create($_GET['date']);
                    echo date_format($date,"D, d M. Y g:i A")
                    ?></span></h6>
            </div>
            <img src="../assets/images/itemImages/<?php echo $row['item_img'] ?>" alt="image" class="card-img-top">
            <div class="card-body">
                <embed src="../assets/files/<?php echo $row['item_upload'] ?>" type="application/pdf" height="500" class="w-100">
            </div>
        <div class="d-flex my-2">
        <a href="../assets/app/post_process.php?confirmItem=<?php echo $row['item_id']; ?>" class="btn w-25 mx-auto" style="background-color: #8bcffc ;">VERIFY</a>

        <a href="../assets/app/post_process.php?cancelItem=<?php echo $row['item_id']; ?>" class="btn w-25 mx-auto" style="background-color: #8bcffc ;">CANCEL</a>
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