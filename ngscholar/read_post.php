<?php
require_once "assets/modules/sessions.php";
require_once "assets/app/db_con.php";

if (!isset($_GET['q'])) {
    header("Location: index.php");
} else {
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

        <?php

        echo successMsg();
        echo errorMsg();

        $post = $_GET['q'];
        $sql = "SELECT * FROM user_posts WHERE post_id = '$post'";
        $query = mysqli_query($connectDB, $sql);
        if (mysqli_num_rows($query) < 1) {
            echo "<h1 class=\"text-center py-5 fw-bold text-danger\">Post Not Found</h1>";
        } else {
            $row = mysqli_fetch_assoc($query);

        ?>
            <section>
                <div class="container my-5">
                    <div class="card bg-transparent">
                        <div class="card-img-top" style="background-image: url(assets/images/postImages/<?php echo $row['main_img']; ?>); background-size: cover; background-position: 50% 50%; background-repeat:no-repeat; height:600px;">
                            <div class="col-12 p-5" style="background: linear-gradient(to top, rgba(0,0,0,0.85),transparent);height:600px;">
                                <h3 class="display-5 text-white fst-italic px-3 pb-5" style="margin-top: 350px;"><?php echo ucwords($row['title']); ?></h3>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between px-5 text-center bg-light">
                            <h6>By: <span class="fw-lighter">
                                    <?php
                                    $uid = $row['userid'];

                                    $user = getValue($connectDB, "*", "users", "id", $uid);
                                    echo ucwords($user['first_name']), '.', ucwords($user['last_name']);
                                    ?>
                                </span>
                            </h6>
                            <h6><i class="far fa-clock"></i> <span class="fw-lighter text-center">
                                    <?php
                                    $date = date_create($row['date_created']);
                                    echo date_format($date, " d M. Y")
                                    ?>
                                </span>
                            </h6>
                        </div>
                        <div class="card-body cards fs-5">
                            <?php echo $row['post_article']; ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="my-3">
                    <div class="container my-3 d-flex gap-2">
                        <button class="share-btn">
                            <i class="fas fa-share-alt"></i>
                        </button>
                        <div class="share-options">
                            <div class="social-media d-flex gap-1 bg-transparent">
                                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"><button class="social-media-btn" style="background:#1DA1F2 ;"><i class="fab fa-twitter"></i></button></a>

                                <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"><button class="social-media-btn" style="background: #0A66C2 ;"><i class="fab fa-facebook-f"></i></button></a>

                                <button class="social-media-btn copyy" style="background: black ;" onclick="navigator.clipboard.writeText(window.location.href)"><i class="far fa-copy"></i></button>

                                <p class="link-copied text-dark pt-3" style="display:none;">Link copied!</p>
                            </div>
                        </div>
                    </div>

                    <div class="container my-3">
                        <div class="card p-3 cards shadow shadow-lg w-100 ms-0" style="border-radius:50px;">
                            <h3 class="fw-bold">About the Author</h3>
                            <div style="height: 150px; width:150px;">
                                <img src="assets/images/avatars/<?php echo $user['prof_pic']; ?>" alt="profile pic" class="img-fluid h-100" style="clip-path:circle();">
                            </div>
                            <div class="fw-lighter fs-5" style="color: #19382c;">
                                <div><?php echo strtoupper($user['first_name']), '.', strtoupper($user['last_name']); ?></div>
                                <div class="fw-bold"><?php echo $user['email']; ?></div>
                                <div class="fst-italic">"<?php echo $user['bio']; ?>"</div>
                            </div>
                        </div>
                    </div>
            </section>

            <section class="container my-5">
                <h3 class="fw-bold fst-italic my-3 text-center">Read More...</h3>
                <div class="row d-flex">
                    <?Php
                    $except = $row['post_id'];
                    $sql = "SELECT * FROM user_posts WHERE post_status = '1' AND post_id != '$except' ORDER BY date_created DESC LIMIT 0,4";
                    $query = mysqli_query($connectDB, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <div class="col-md-3 mb-3">

                            <div class="card cards shadow shadow-lg card-hover" style="cursor:pointer; height: 450px ;" onclick="window.location.href='read_post.php?q=<?php echo $row['post_id']; ?>'">
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
                                    <a href="read_post.php?q=<?php echo $row['post_id']; ?>" class="btn fw-bold" style="background-color: #8bcffc ;position:absolute; bottom:10px;">Continue reading</a>

                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>

            </section>

        <?php } ?>

    <?php } ?>




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
    <script>
        const shareBtn = document.querySelector('.share-btn');
        const shareOptions = document.querySelector('.share-options');

        shareBtn.addEventListener('click', () => {
            shareOptions.classList.toggle('active');
            const copyLink = document.querySelector('.copyy');

            copyLink.addEventListener('click', () => {
                const linkCopied = document.querySelector('.link-copied');
                if (linkCopied.style.display === 'none') {
                    linkCopied.style.display = 'block';
                } else {
                    linkCopied.style.display = 'none';
                }
            })
        })
    </script>

    </html>