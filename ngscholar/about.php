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
    <section class="container-fluid workk">
        <div class="container py-4">
            <h1 style="color: #19382c;">About The Nigerian Scholar</h1>
        </div>
    </section>

    <section class="container-fluid cards">
        <div class="container py-4">
            <h4 class="fw-lighter fs-5" style="color: #19382c;">
                NG Scholar began as a project in 2022 by Emeka Akams inorder to complete his Full-Stack Web development course at Early code institute. Over a 3 week period and a gruelling schedule, he spent about an hour a day to make this website his masterpiece. This is infact his very first fully functional website and if you ask me, he didn't do too badly at all.<br><br>

                The website is a something of a health and medical news blog to disseminate information on clinical and other medical studies, including scholarly articles <br><br>

                He hopes to use it one day as a template for other projects and as a means to get further tech jobs and make a name for himself.
            </h4>
        </div>
    </section>

    <section class="container-fluid bg-transparent">
        <div class="container py-4">
            <h2>Meet our Made up Authors</h2>
            <div>
                    <div class=" mb-5">
                            <div class="row">
                                <?php

                             $sql = "SELECT * FROM users ORDER BY date_created DESC";
                             $query = mysqli_query($connectDB, $sql);

                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <div class="col-12 my-3"> 
                                        <div class="card p-3 cards shadow shadow-lg" style="border-radius:50px;">
                                            <div style="height: 150px; width:150px;">
                                                <img src="assets/images/avatars/<?php echo $row['prof_pic'];?>" alt="profile pic" class="img-fluid h-100" style="clip-path:circle();">
                                            </div>
                                            <div class="fw-lighter fs-5" style="color: #19382c;">
                                                    <div><?php echo strtoupper($row['first_name']),'.',strtoupper($row['last_name']);?></div>
                                                    <div class="fw-bold"><?php echo $row['email'];?></div>
                                                    <div class="fst-italic">"<?php echo $row['bio'];?>"</div> 
                                            </div>
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


    <?php require_once "assets/modules/footer.php"; ?>
</body>

<script src="assets/js/bootstrap.bundle.min.js"></script>

</html>