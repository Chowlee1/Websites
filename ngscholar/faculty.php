<?php
require_once "assets/modules/sessions.php";
require_once "assets/app/db_con.php";
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
    <link rel="stylesheet" href="assets/CSS/pattern.min.css">

</head>

<body class="pattern-cross-dots-sm" style="background-color: #B3E6B5 ;">

    <!-- NAVBAR -->
    <?php require_once "assets/modules/navbar.php" ?>

    <?php echo errorMsg();
    echo successMsg();  ?>


    <div class="container my-5">
        <div class="card mx-auto shadow" style="background: transparent ;">
            <div class="card-body">
                <?php
                if (!isset($_GET['q'])) {
                    $name = "LATEST FACULTY NEWS";
                } else {
                    $name = "Showing Results For " . $_GET['q'];
                }

                ?>
                <h2 class="text-center my-4"><?php echo $name; ?></h2>

                <div class="row">
                    <?php
                    if (isset($_GET['q'])) {
                        // When users search for a post
                        $search = $_GET['q'];
                        $sql = "SELECT * FROM user_posts WHERE title LIKE '%$search%' OR post_article LIKE '%$search%' OR category LIKE '%$search%' OR others_category LIKE '%$search%' AND post_status = '1'";
                        $query = mysqli_query($connectDB, $sql);
                        if (mysqli_num_rows($query) < 1) {
                            $sql = "SELECT * FROM users WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR date_created LIKE '%$search%'";
                            $query = mysqli_query($connectDB, $sql);
                        }
                    } else {
                        // When users don't search for a post
                        if (!isset($_GET['s']) && !isset($_GET['e'])) {
                            $start = 0;
                            $end = 6;
                            $pageNum = 1;

                            $sql = "SELECT * FROM user_posts WHERE others_category = 'Faculty News' AND post_status = '1' ORDER BY date_created DESC LIMIT $start,$end";
                            $query = mysqli_query($connectDB, $sql);
                        } else {
                            $start = $_GET['s'];
                            $end = $_GET['e'];
                            $pageNum = $_GET['p'];


                            $sql = "SELECT * FROM user_posts WHERE others_category = 'Faculty News' AND post_status = '1' ORDER BY date_created DESC LIMIT $start,$end";
                            $query = mysqli_query($connectDB, $sql);
                        }
                    }

                    while ($row = mysqli_fetch_assoc($query)) {

                    ?>
                        <div class="card mb-3 cards post d-none p-3 mx-auto" style="width: 300px ;">
                            <img src="assets/images/postImages/<?php echo $row['main_img']; ?>" alt="post-image" class="img-fluid card-img-top" style="height: 200px ;">
                            <div class="card-body">
                            <h4 class="my-3 fs-5"><?php echo ucwords($row['title'])?></h4>
                            <h6  style="position: absolute ; bottom:0px; right:10px ;" class="fw-lighter"><i class="far fa-clock"></i> <?php
                                        $date = date_create($row['date_created']);
                                        echo date_format($date, "d M. Y");
                                    ?>
                            </h6>
                            </div>
                        </div>
                        <div class="col-12 mb-3 bg-transparent poster">
                            <div onclick="window.location = 'read_post.php?q=<?php echo $row['post_id']; ?>'" class="card bg-transparent" style="cursor: pointer;" style="height: 400px ;">
                                <div class="card-body container" style="background-color:  rgb(255, 255, 255, .5) ;">

                                    <div class="row bg-transparent">
                                        <div class="col-4 bg-transparent" style="width: max-content ;">
                                            <div>
                                                <img src="assets/images/postImages/<?php echo $row['main_img']; ?>" alt="post-image" class="img-fluid" style="height: 100px ;">
                                            </div>
                                        </div>
                                        <div class="col-8 bg-transparent">
                                            <h4 class="my-3 fs-5"><?php echo ucwords($row['title'])?></h4>
                                            <h6  style="position: absolute ; bottom:0px; right:10px ;" class="fw-lighter"><i class="far fa-clock"></i> <?php
                                                        $date = date_create($row['date_created']);
                                                        echo date_format($date, "d M. Y");
                                                    ?>
                                            </h6>
                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if (mysqli_num_rows($query) <= 0) {
                    ?>
                        <h1 class="text-center text-danger fw-lighter my-5">No More posts</h1>

                    <?php }  ?>
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center fs-5 gap-2">
                        <li class="page-item <?php if ($start < 1) {
                                                    echo "disabled";
                                                } ?>">
                            <a onmouseover="this.style.backgroundColor='#8bcffc'" onmouseout="this.style.backgroundColor='white'" style="color:#19382c;" class="page-link" href="all_posts.php?s=<?php echo $start - 6; ?>&e=<?php echo $end - 6 ?>&p=<?php echo $pageNum - 1; ?>">Previous</a>
                        </li>

                        <li class="page-item"><a style="background-color:#8bcffc; color:black;" class="page-link"><?php if (!isset($pageNum)) {
                            echo '1';}else{ echo $pageNum; }?></a></li>

                        <li class="page-item <?php if (mysqli_num_rows($query) <= 0) {
                                                    echo 'disabled';
                                                } ?>">
                            <a onmouseover="this.style.backgroundColor='#8bcffc'" onmouseout="this.style.backgroundColor='white'" style="color:#19382c;" class="page-link" href="all_posts.php?s=<?php echo $start + 6; ?>&e=<?php echo $end + 6 ?>&p=<?php echo $pageNum + 1; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>

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


    <?php require_once "assets/modules/footer.php"; ?>
    
</body>

<script src="assets/js/bootstrap.bundle.min.js"></script>

</html>