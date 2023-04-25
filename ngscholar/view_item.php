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

        $item = $_GET['q'];
        $sql = "SELECT * FROM user_items WHERE item_id = '$item'";
        $query = mysqli_query($connectDB, $sql);
        if (mysqli_num_rows($query) < 1) {
            echo "<h1 class=\"text-center py-5 fw-bold text-danger\">Post Not Found</h1>";
        } else {
            $row = mysqli_fetch_assoc($query);

        ?>
            <section>
                <div class="container my-5">
                    <div class="card cards">
                        <div class="card-body my-1">
                            <div>
                                    <h3 class="mb-2"><?php echo (ucwords($row['item_name']));?></h3>
                                    <h4 class="mb-2 fw-lighter"><span class="fw-bolder">Author(s): </span><?php echo (ucwords($row['item_authors'])); ?></h4>
                                    <h4 class="mb-2 fw-bold"><span class="fw-bold">Price: $</span><?php echo ($row['item_price']); ?></h4>
                                    <h4 class="mb-2 fw-lighter"><span class="fw-bolder">Category: </span><?php echo ucwords($row['item_category']); ?></h4>
                                    <h5>Date: <span class="fw-lighter">
                                    <?php
                                    $date = date_create($row['date_created']);
                                    echo date_format($date, " M. Y")
                                        ?>
                                    </span>
                                     </h5>
                                     <?php
                                        if ($row['item_price'] === 'FREE') { ?>
                                     <a href="assets/files/<?php echo $row['item_upload']; ?>" class="d-flex btn gap-3 fs-5 justify-content-center align-items-center" style="width:fit-content; background-color: #8bcffc ;" download>Download <i class="fas fa-download"></i></a>
                                     <?php } ?>
                            </div>

                         </div>
                        <div class="container p-3">
                            <?php
                                if ($row['item_price'] === 'FREE') { ?>
                                    <embed src="assets/files/<?php echo $row['item_upload']; ?>" type="application/pdf" height="400px" class="w-100  d-md-block d-none ">
                                <?php }elseif ($row['item_price'] > 0){ ?>
                                    <a href="https://www.flutterwave.com" class="d-flex gap-5 btn fs-5 mb-3" style="width:fit-content; background-color: #8bcffc ;">PROCEED TO PAY $<?php echo $row['item_price']?> FOR ACCESS TO ARTICLE </a>
                                    <h5 class="fw-bold">NOTE: Article will be sent directly to your email address</h5>
                            <?php }   ?>
                        </div>

                    </div>
                </div>

                
                <div class="container d-flex gap-2">
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
            </section>

            <section>
        <div class="row mb-2 container-fluid mx-auto">
            <h1 class="text-center ps-5 py-2 fs-2">View More</h1>
            <?Php
            $not = $row['item_id'];
            $sql = "SELECT * FROM user_items WHERE item_status = '1' AND item_id != '$not' ORDER BY date_created DESC LIMIT 0,3";
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