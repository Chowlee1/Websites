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

    <section class="workk first">
        <div class="container-fluid">
            <div class="row justify-content-evenly">
                <div class="col-md-4 my-3 py-5 px-5" style="height: 500px ;">
                    <h3 class="fw-bold mx-auto my-3" style="font-size: 50px ; color: #19382c;">The <br> Pan-African <br> Health Information <br> Hub</h3>
                    <blockquote class=" text-center fs-4 fst-italic mx-auto my-3" style="color:#19382c;">"Africa's largest repository of Health Information and Records"</blockquote>
                </div>
                <div class="col-md-6 my-3 border-0 bg-transparent">
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators gap-5">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="height: 20px ;"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" style="height: 20px ;"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3" style="height: 20px ;"></button>
                        </div>
                        <div class="carousel-inner border-0 bg-transparent" style="height: 500px ;">
                            <div class="carousel-item active">
                                     <?php
                                    $sql = "SELECT * FROM user_posts WHERE post_status = '1' AND category = 'Global' ORDER BY date_created DESC";
                                    $query = mysqli_query($connectDB, $sql);
                                    $row = mysqli_fetch_assoc($query);
                                    ?>
                                <div class="card" onclick="window.location.href='read_post.php?q=<?php echo $row['post_id']; ?>'" style="cursor: pointer ;">
                                    <div class="mb-4 rounded text-white" style="background-image: url(assets/images/postImages/<?php echo $row['main_img']; ?>); background-size: cover; background-position:center; background-repeat:no-repeat; height:100vh;">
                                        <div class="col-12 p-3" style="background: linear-gradient(to right, rgba(0,0,0,0.9),transparent); height:500px;">
                                            <h1 class="display-4 fst-italic"><?php echo substr(ucwords($row['title']),0,50); ?></h1>
                                            <h6 class="fst-italic"><?php $dateee = date_create($row['date_created']); echo date_format($dateee, "D, d M. Y"); ?></h6>
                                            <p class="mt-5 lead btn bg-success"><a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="text-white text-decoration-none fw-bold">View</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <?php
                                    $sqll = "SELECT * FROM user_posts WHERE post_status = '1' AND category = 'Clinical' ORDER BY date_created DESC";
                                    $queryy = mysqli_query($connectDBB, $sqll);
                                    $roww = mysqli_fetch_assoc($queryy);
                                    ?>
                                <div class="card" onclick="window.location.href='read_post.php?q=<?php echo $roww['post_id']; ?>'" style="cursor: pointer ;">
                                    
                                    <div class="mb-4 rounded text-white" style="background-image: url(assets/images/postImages/<?php echo $roww['main_img']; ?>); background-size: cover; background-position:center; background-repeat:no-repeat; height:100vh;">
                                        <div class="col-12 p-3" style="background: linear-gradient(to right, rgba(0,0,0,0.85),transparent); height:500px;">
                                            <h1 class="display-4 fst-italic"><?php echo substr(ucwords($roww['title']),0,50); ?></h1>
                                            <h6 class="fst-italic"><?php $dateeee = date_create($roww['date_created']); echo date_format($dateeee, "D, d M. Y"); ?></h6>
                                            <p class="mt-5 lead btn bg-success"><a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="text-white text-decoration-none fw-bold">View</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="card" onclick="window.location.href='read_post.php?q=<?php echo $roww['post_id']; ?>'" style="cursor: pointer ;">
                                    <?php
                                    $sqll = "SELECT * FROM user_posts WHERE post_status = '1' AND category = 'Political' ORDER BY date_created DESC";
                                    $queryy = mysqli_query($connectDBB, $sqll);
                                    $roww = mysqli_fetch_assoc($queryy);
                                    ?>
                                    <div class="mb-4 rounded text-white" style="background-image: url(assets/images/postImages/<?php echo $roww['main_img']; ?>); background-size: cover; background-position:center; background-repeat:no-repeat; height:100vh;">
                                        <div class="col-12 p-3" style="background: linear-gradient(to right, rgba(0,0,0,0.85),transparent); height:500px;">
                                            <h1 class="display-4 fst-italic"><?php echo substr(ucwords($roww['title']),0,50); ?></h1>
                                            <h6 class="fst-italic"><?php $dateeeee = date_create($roww['date_created']); echo date_format($dateeeee, "D, d M. Y"); ?></h6>
                                            <p class="mt-5 lead btn bg-success"><a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="text-white text-decoration-none fw-bold">View</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button> -->
                </div>
            </div>
        </div>

    </section>

    <?php
    $sql = "SELECT * FROM user_posts WHERE post_status = '1' ORDER BY date_created ASC";
    $query = mysqli_query($connectDB, $sql);
    $row = mysqli_fetch_assoc($query);
    ?>

    <section class="mb-4 text-white" style="background-image: url(assets/images/postImages/<?php echo $row['main_img']; ?>); background-size: cover; background-attachment: fixed; background-position: 50% 50%; background-repeat:no-repeat; height:500px; cursor: pointer ;" onclick="window.location.href='read_post.php?q=<?php echo $row['post_id']; ?>'">

        <div class="mx-0 p-5 w-75" style="background: linear-gradient(to right, rgba(0,0,0,0.85),transparent);height:500px;">
            <h3>Featured Story</h3>
            <h1 class="display-4 fst-italic"><?php echo substr(ucwords($row['title']),0,50); ?></h1>
            <h6 class="fst-italic"><?php $dat = date_create($row['date_created']); echo date_format($dat, "D, d M. Y"); ?></h6>
            <p class="mb-0"><a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="text-white fw-lighter text-decoration-none">Continue reading</a></p>
        </div>
    </section>

    <section>
            <h1 class="text-start ps-5 py-2 fs-2 gap-5">Latest Stories </h1>
            <div class="ps-5 py-2 bg-transparent">
                <a href="all_posts.php" class="text-center text-decoration-none gap-5 d-flex"><h4 class="text-center fst-italic text-dark">View more <i class="far fa-arrow-alt-circle-right"></i></h4></a>
            </div>
        <div class="row mb-2 container mx-auto">
            <?Php
            $sql = "SELECT * FROM user_posts WHERE post_status = '1' ORDER BY date_created DESC LIMIT 0,4";
            $query = mysqli_query($connectDB, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-3 mb-3">

                    <div class="card cards card-hover shadow shadow-lg" style="height: 450px ; cursor:pointer;" onclick="window.location.href='read_post.php?q=<?php echo $row['post_id']; ?>'">
                        <img src="assets/images/postImages/<?php echo $row['main_img']; ?>" alt="image" class="card-img-top" style="height:200px;">
                        <div class="card-body">
                            <h3 class="card-title mb-1"><?php echo substr(ucwords($row['title']), 0, 30) . '...'; ?></h3>
                            <?php if (isset($row['others_category'])) { ?>
                                <p class="p-1" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['category'] ?>, <?php echo $row['others_category'] ?></p>
                            <?php } else { ?>
                                <p class="p-1 d-block" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['category'] ?></p>
                            <?php } ?>
                            <div class="mb-1 text-muted"><i class="far fa-clock"></i>
                                <?php
                                $date = date_create($row['date_created']);
                                echo date_format($date, "D, d M. Y h:i a");
                                ?>
                            </div>
                            <a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="btn fw-bold" style="background-color: #8bcffc;  position:absolute; bottom:10px;">Continue reading</a>

                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </section>

    <section>
        <div class="row mb-2 container-fluid mx-auto">
            <h1 class="text-start ps-5 py-2 fs-2">Latest Articles</h1>
            <div class=" container py-2 bg-transparent">
                <a href="all_articles.php" class="text-center text-decoration-none gap-5 d-flex"><h4 class="text-center fst-italic  text-dark">View more <i class="far fa-arrow-alt-circle-right"></i></h4></a>
            </div>
            <?Php
            $sql = "SELECT * FROM user_items WHERE item_status = '1' ORDER BY date_created DESC LIMIT 0,3";
            $query = mysqli_query($connectDB, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-4">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative cards shadow shadow-lg card-hover" style="cursor:pointer;" onclick="window.location.href='view_item.php?q=<?php echo $row['item_id']; ?>'">
                        <div class="col-md-8 p-4 d-flex flex-column position-static">
                            <p class="p-1 d-block" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['item_category'] ?></p>
                            <h5 class="mb-1"><?php echo substr(ucwords($row['item_name']), 0, 30) . '...'; ?></h5>
                            <h4 class="mb-1 fw-bold">$<?php echo (ucwords($row['item_price'])); ?></h4>

                                <div class="mb-1 text-muted"><i class="far fa-clock"></i>
                                    <?php
                                    $date = date_create($row['date_created']);
                                    echo date_format($date, " M. Y");
                                    ?>
                                </div>
                                <a href="view_item.php?q=<?php echo $row['item_id']; ?>" class="btn fw-bold" style="background-color: #8bcffc ;position:absolute; bottom:10px;">View Article</a>
                        </div>

                        <div class="col-md-4 d-none d-lg-block justify-content-center align-items-center p-3">
                            <img src="assets/images/itemImages/<?php echo $row['item_img']; ?>" alt="image" class="img-fluid h-100">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <section>
            <h1 class="text-start ps-5 py-2 fs-2 gap-5">Global Stories </h1>
            <div class="ps-5 py-2 bg-transparent">
            <?php 
                $sql = "SELECT * FROM user_posts WHERE category = 'Global' AND post_status = '1'";
                $query = mysqli_query($connectDB, $sql);
                $row = mysqli_fetch_assoc($query)
                    
                ?>
                <a href="all_posts.php?q=<?php echo $row['category']; ?>" class="text-center text-decoration-none gap-5 d-flex"><h4 class="text-center fst-italic text-dark">View more <i class="far fa-arrow-alt-circle-right"></i></h4></a>
            </div>
        <div class="row mb-2 container mx-auto">
            <?Php
            $sql = "SELECT * FROM user_posts WHERE category = 'Global' AND post_status = '1' ORDER BY date_created DESC LIMIT 0,4";
            $query = mysqli_query($connectDB, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-3 mb-3">

                    <div class="card cards card-hover shadow shadow-lg" style="height: 450px ; cursor:pointer;" onclick="window.location.href='read_post.php?q=<?php echo $row['post_id']; ?>'">
                        <img src="assets/images/postImages/<?php echo $row['main_img']; ?>" alt="image" class="card-img-top" style="height: 200px ;">
                        <div class="card-body justify-content-center align-items-center">
                            <h3 class="card-title mb-1"><?php echo substr(ucwords($row['title']), 0, 30) . '...'; ?></h3>
                            <?php if (isset($row['others_category'])) { ?>
                                <p class="p-1" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['category'] ?>, <?php echo $row['others_category'] ?></p>
                            <?php } else { ?>
                                <p class="p-1 d-block" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['category'] ?></p>
                            <?php } ?>
                            <div class="mb-1 text-muted"><i class="far fa-clock"></i>
                                <?php
                                $date = date_create($row['date_created']);
                                echo date_format($date, "D, d M. Y h:i a");
                                ?>
                            </div>
                            <a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="btn fw-bold" style="background-color: #8bcffc ; position:absolute; bottom:10px;">Continue reading</a>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <section>
        <h1 class="text-start ps-5 py-2 fs-2 gap-5">Clinical Stories </h1>
            <div class="ps-5 py-2 bg-transparent">
            <?php 
                $sql = "SELECT * FROM user_posts WHERE category = 'Clinical' AND post_status = '1'";
                $query = mysqli_query($connectDB, $sql);
                $row = mysqli_fetch_assoc($query)
                    
                ?>
                <a href="all_posts.php?q=<?php echo $row['category']; ?>" class="text-center text-decoration-none gap-5 d-flex"><h4 class="text-center fst-italic text-dark">View more <i class="far fa-arrow-alt-circle-right"></i></h4></a>
            </div>
        <div class="row mb-2 container mx-auto">
            <?Php
            $sql = "SELECT * FROM user_posts WHERE category = 'Clinical' AND post_status = '1' ORDER BY date_created DESC LIMIT 0,4";
            $query = mysqli_query($connectDB, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-3 mb-3">

                <div class="card cards card-hover shadow shadow-lg" style="height: 450px ; cursor:pointer;" onclick="window.location.href='read_post.php?q=<?php echo $row['post_id']; ?>'">
                        <img src="assets/images/postImages/<?php echo $row['main_img']; ?>" alt="image" class="card-img-top" style="height: 200px ;">
                        <div class="card-body justify-content-center align-items-center">
                            <h3 class="card-title mb-1"><?php echo substr(ucwords($row['title']), 0, 30) . '...'; ?></h3>
                            <?php if (isset($row['others_category'])) { ?>
                                <p class="p-1" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['category'] ?>, <?php echo $row['others_category'] ?></p>
                            <?php } else { ?>
                                <p class="p-1 d-block" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['category'] ?></p>
                            <?php } ?>
                            <div class="mb-1 text-muted"><i class="far fa-clock"></i>
                                <?php
                                $date = date_create($row['date_created']);
                                echo date_format($date, "D, d M. Y h:i a");
                                ?>
                            </div>
                            <a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="btn fw-bold" style="background-color: #8bcffc ; position:absolute; bottom:10px;">Continue reading</a>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <section>
        <div class="row mb-2 container-fluid mx-auto">
            <h1 class="text-start ps-5 py-2 fs-2">Free Articles</h1>
            <div class=" container py-2 bg-transparent">
                <a href="all_articles.php" class="text-center text-decoration-none gap-5 d-flex"><h4 class="text-center fst-italic  text-dark">View more <i class="far fa-arrow-alt-circle-right"></i></h4></a>
            </div>
            <?Php
            $sql = "SELECT * FROM user_items WHERE item_price = 'FREE' AND item_status = '1' ORDER BY date_created ASC LIMIT 0,3";
            $query = mysqli_query($connectDB, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-4">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative cards shadow shadow-lg card-hover" style="cursor:pointer;" onclick="window.location.href='view_item.php?q=<?php echo $row['item_id']; ?>'">
                        <div class="col-md-8 p-4 d-flex flex-column position-static">
                            <p class="p-1 d-block" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['item_category'] ?></p>
                            <h5 class="mb-1"><?php echo substr(ucwords($row['item_name']), 0, 30) . '...'; ?></h5>
                            <h4 class="mb-1 fw-bold">$<?php echo (ucwords($row['item_price'])); ?></h4>

                                <div class="mb-1 text-muted"><i class="far fa-clock"></i>
                                    <?php
                                    $date = date_create($row['date_created']);
                                    echo date_format($date, " M. Y");
                                    ?>
                                </div>
                                <a href="view_item.php?q=<?php echo $row['item_id']; ?>" class="btn fw-bold" style="background-color: #8bcffc ;position:absolute; bottom:10px;">View Article</a>
                        </div>

                        <div class="col-md-4 d-none d-lg-block justify-content-center align-items-center p-3">
                            <img src="assets/images/itemImages/<?php echo $row['item_img']; ?>" alt="image" class="img-fluid h-100">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <section>
        <h1 class="text-start ps-5 py-2 fs-2 gap-5">Politics </h1>
            <div class="ps-5 py-2 bg-transparent">
            <?php 
                $sql = "SELECT * FROM user_posts WHERE category = 'Political' AND post_status = '1'";
                $query = mysqli_query($connectDB, $sql);
                $row = mysqli_fetch_assoc($query)
                    
                ?>
                <a href="all_posts.php?q=<?php echo $row['category']; ?>" class="text-center text-decoration-none gap-5 d-flex"><h4 class="text-center fst-italic text-dark">View more <i class="far fa-arrow-alt-circle-right"></i></h4></a>
            </div>
        <div class="row mb-2 container mx-auto">
            <?Php
            $sql = "SELECT * FROM user_posts WHERE category = 'Political' AND post_status = '1' ORDER BY date_created DESC LIMIT 0,4";
            $query = mysqli_query($connectDB, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-3 mb-3">

                <div class="card cards card-hover shadow shadow-lg" style="height: 450px ; cursor:pointer;" onclick="window.location.href='read_post.php?q=<?php echo $row['post_id']; ?>'">
                        <img src="assets/images/postImages/<?php echo $row['main_img']; ?>" alt="image" class="card-img-top" style="height: 200px ;">
                        <div class="card-body justify-content-center align-items-center">
                            <h3 class="card-title mb-1"><?php echo substr(ucwords($row['title']), 0, 30) . '...'; ?></h3>
                            <?php if (isset($row['others_category'])) { ?>
                                <p class="p-1" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['category'] ?>, <?php echo $row['others_category'] ?></p>
                            <?php } else { ?>
                                <p class="p-1 d-block" style="color:white; background-color:#19382c; width:max-content;"><?php echo $row['category'] ?></p>
                            <?php } ?>
                            <div class="mb-1 text-muted"><i class="far fa-clock"></i>
                                <?php
                                $date = date_create($row['date_created']);
                                echo date_format($date, "D, d M. Y h:i a");
                                ?>
                            </div>
                            <a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="btn fw-bold" style="background-color: #8bcffc ; position:absolute; bottom:10px;">Continue reading</a>

                        </div>
                    </div>
                </div>
            <?php } ?>
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

    <?php require_once "assets/modules/footer.php"; ?>
</body>

<script src="assets/js/bootstrap.bundle.min.js"></script>

</html>