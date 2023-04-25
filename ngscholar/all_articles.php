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
    <link rel="stylesheet" href="assets/CSS/style.css">
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
                    $name = "LATEST ARTICLES";
                } else {
                    $name = "Showing Results For " . $_GET['q'];
                }

                ?>
                <h2 class="text-center my-4"><?php echo $name; ?></h2>


                <div class="row">
                    <?php
                    if (isset($_GET['q'])) {
                        // When users search for an article
                        $search = $_GET['q'];
                        $sql = "SELECT * FROM user_items WHERE item_name LIKE '%$search%' OR item_authors LIKE '%$search%' OR item_category LIKE '%$search%' OR item_id LIKE '%$search%' AND item_status = '1'";
                        $query = mysqli_query($connectDB, $sql);
                        if (mysqli_num_rows($query) < 1) {
                            echo '';
                        }
                    } else {
                        // When users don't search for a post
                        if (!isset($_GET['s']) && !isset($_GET['e'])) {
                            $start = 0;
                            $end = 6;
                            $pageNum = 1;

                            $sql = "SELECT * FROM user_items WHERE item_status = '1' ORDER BY date_created DESC LIMIT $start,$end";
                            $query = mysqli_query($connectDB, $sql);
                        } else {
                            $start = $_GET['s'];
                            $end = $_GET['e'];
                            $pageNum = $_GET['p'];


                            $sql = "SELECT * FROM user_items WHERE item_status = '1' ORDER BY date_created DESC LIMIT $start,$end";
                            $query = mysqli_query($connectDB, $sql);
                        }
                    }

                    while ($row = mysqli_fetch_assoc($query)) {

                    ?>
                        <div class="mb-4 cards shadow shadow-lg" onclick="window.location.href = 'view_item.php?q=<?php echo $row['item_id']; ?>'" style="cursor: pointer ;">
                            <div class="container p-4">
                                <p class="p-1 d-block" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['item_category'] ?></p>
                                <h3 class="my-2"><?php echo ucwords($row['item_name'])?></h3>
                                <h4 class="my-2 fw-lighter">Author(s): <?php echo ucwords($row['item_authors']); ?></h4>
                                <h4 class="my-2 fw-bold">Price: $<?php echo (ucwords($row['item_price'])); ?></h4>
                                <h6 class="mb-1 text-muted"><i class="far fa-clock"></i>
                                        <?php
                                        $date = date_create($row['date_created']);
                                        echo date_format($date, " M. Y");
                                        ?>
                                </h6>
                                <a href="view_item.php?q=<?php echo $row['item_id']; ?>" class="btn fw-bold mt-3" style="background-color: #8bcffc;">View Article</a>
                            </div>
                        </div>

                        <!-- <div class="col-md-6 mb-3" id="Items" style="height: 600px ;">
                            <div class="card cards">
                                <div class="card-header">
                                    <div>
                                        <img src="assets/images/itemImages/<?php echo $row['item_img']; ?>" alt="item-image" style="height: 300px ;" class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <h2><?php echo substr(ucwords($row['item_name']), 0, 50) . '...'; ?></h2>
                                        <h5 class="fst-italic fw-lighter">Authors:<?php echo substr(strtoupper($row['item_authors']),0,30);?></h5>
                                        <h6><i class="far fa-clock"></i><?php
                                                    $date = date_create($row['date_created']);
                                                    echo date_format($date, " M. Y");
                                                    ?>
                                        </h6>
                                        <a href="view_item.php?q=<?php echo ($row['item_id']); ?>" class="stretched-link btn w-100" style="background-color: #8bcffc ;">View Article</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
                            <a onmouseover="this.style.backgroundColor='#8bcffc'" onmouseout="this.style.backgroundColor='white'" style="color:#19382c;" class="page-link" href="all_articles.php?s=<?php echo $start - 6; ?>&e=<?php echo $end - 6 ?>&p=<?php echo $pageNum - 1; ?>">Previous</a>
                        </li>
                        <li class="page-item"><a style="background-color:#8bcffc; color:black;" class="page-link"><?php if (!isset($pageNum)) {
                            echo '1';}else{ echo $pageNum; }?></a></li>
                        <li class="page-item <?php if (mysqli_num_rows($query) <= 0) {
                                                    echo 'disabled';
                                                } ?>">
                            <a onmouseover="this.style.backgroundColor='#8bcffc'" onmouseout="this.style.backgroundColor='white'" style="color:#19382c;" class="page-link" href="all_articles.php?s=<?php echo $start + 6; ?>&e=<?php echo $end + 6 ?>&p=<?php echo $pageNum + 1; ?>">Next</a>
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