<?php
session_start();
include './../conn.php';
include './inc/functions.php';

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $res_crs_auth = mysqli_query($conn, "SELECT * FROM course,author WHERE course.course_id=$course_id AND course.author_id=author.auhor_id");
    if (mysqli_num_rows($res_crs_auth) > 0) {
        $row_res_crs_auth = mysqli_fetch_assoc($res_crs_auth);
        $res_vid = mysqli_query($conn, "SELECT * FROM videos_course WHERE course_id_vid=$course_id");
        if (mysqli_num_rows($res_vid) > 0) {
            $intro_vid = mysqli_query($conn, "SELECT * FROM videos_course WHERE course_id_vid=$course_id AND vid_tag='info'");
            if (mysqli_num_rows($intro_vid) > 0) {
                $row_intro_vid = mysqli_fetch_assoc($intro_vid);
            } else {
                $row_intro_vid = "";
            }
        } else {
            alert("Course is not available");
            redirect("../index.php");
        }
    } else {
        alert("Unable to reach data source");
        redirect("../index.php");
    }
} else {
    redirect("../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>


    <!-- Favicons -->
    <link href="course_detail_assets/assets/img/favicon.png" rel="icon">
    <link href="course_detail_assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="course_detail_assets/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="course_detail_assets/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="course_detail_assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="course_detail_assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="course_detail_assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="course_detail_assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="course_detail_assets/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="course_detail_assets/assets/css/style.css" rel="stylesheet">


</head>

<body>
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>Course Details</h2>
                <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Cource Details Section ======= -->
        <section id="course-details" class="course-details">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-8">
                        <!-- <img src="course_detail_assets/assets/img/course-details.jpg" class="img-fluid" alt=""> -->
                        <h3>Introduction Video</h3>
                        <?php
                        if (mysqli_num_rows($intro_vid) > 0) {
                        ?>
                            <video controls>
                                <source src="<?php echo $row_intro_vid['video_src']; ?>">
                                Your browser does not support HTML5 video.
                            </video>
                        <?php
                        } else {
                            echo '<img src="course_detail_assets/assets/img/course-details.jpg" class="img-fluid" alt="">';
                        }
                        ?>

                        <h3><?php echo $row_res_crs_auth['course_name']  ?></h3>
                        <p>
                            <?php echo $row_res_crs_auth['description']  ?>
                        </p>
                    </div>
                    <div class="col-lg-4">

                        <div class="course-info d-flex justify-content-between align-items-center">
                            <h5>Author</h5>
                            <p><a href="#"> <?php echo $row_res_crs_auth['firstname'] . " " . $row_res_crs_auth['lastname']  ?></a></p>
                        </div>
                        <div class="course-info d-flex justify-content-between align-items-center">
                            <h5>Course Category</h5>
                            <p><a href="#"> <?php echo $row_res_crs_auth['course_category'] ?></a></p>
                        </div>

                        <div class="course-info d-flex justify-content-between align-items-center">
                            <h5>Course Fee</h5>
                            <p style="color:green"><b> &#x20B9; <?php echo $row_res_crs_auth['discount_course_fee']  ?> </b> <del style="color:red"><?php echo $row_res_crs_auth['reg_course_fee']  ?></del> <b> including product </b> </p>
                        </div>
                        <div class=" d-flex justify-content-between align-items-center">
                            <?php
                            if (isset($_SESSION['USER_LOGIN_ID'])) {

                                $subscription = mysqli_query($conn, "SELECT * FROM subscriptions WHERE course_sub_id=$course_id AND payment_status='complete' AND user_sub_id='" . $_SESSION['USER_LOGIN_ID'] . "'");
                                if (mysqli_num_rows($subscription) !== 0) {
                            ?>
                                    <a style="width:100%;border:2px solid white" href="player.php?course_id=<?php echo $course_id ?>"><button style="width:100%;background-color:#5fcf80;color:white" class="btn">Start Learning</button></a>

                                <?php
                                }
                                else {
                                    echo '<a style="width:100%;border:2px solid white" href="checkout_course.php?course_id=<?php echo $course_id ?>"><button style="width:100%;background-color:#5fcf80;color:white" class="btn">Enroll Now</button></a>';
                                }
                            } else {

                                ?>
                                <a style="width:100%;border:2px solid white" href="login.php"><button style="width:100%;background-color:#5fcf80;color:white" class="btn">Enroll Now</button></a>
                            <?php
                            }
                            ?>
                        </div>

                        <hr>
                        <hr>
                        <div class="course-info d-flex justify-content-between align-items-center">
                            <h2>Syllabus</h2>
                        </div>
                        <?php
                        $i = 1;
                        while ($row_vid = mysqli_fetch_assoc($res_vid)) {

                        ?>
                            <div class="course-info d-flex justify-content-between align-items-center">
                                <h5><?php echo $i . ". " . $row_vid['video_name'] ?></h5>
                            </div>
                        <?php
                            $i++;
                        }


                        ?>


                    </div>
                </div>

            </div>
        </section><!-- End Cource Details Section -->

        <!-- ======= Cource Details Tabs Section ======= -->
        <section id="cource-details-tabs" class="cource-details-tabs">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#tab-1">Product Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-2"></a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-lg-9 mt-4 mt-lg-0">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <div class="row">
                                    <?php
                                    $prd_row = "";
                                    $prd_query = mysqli_query($conn, "SELECT * FROM products WHERE course_prod_id=$course_id");
                                    if (mysqli_num_rows($prd_query) > 0) {
                                        $prd_row = mysqli_fetch_assoc($prd_query);

                                    ?>
                                        <div class="col-lg-8 details order-2 order-lg-1">

                                            <h3>Product Details</h3>
                                            <p class="fst-italic"><?php echo $prd_row['product_name']; ?></p>
                                        </div>
                                        <div class="col-lg-4 text-center order-1 order-lg-2">
                                            <img src="<?php echo $prd_row['product_img_src']; ?>" alt="" class="img-fluid">
                                        </div>
                                    <?php } else {
                                        echo "<h3>No Product available for this course</h3>";
                                    } ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Cource Details Tabs Section -->

    </main>

    <script src="course_detail_assets/assets/vendor/aos/aos.js"></script>
    <script src="course_detail_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="course_detail_assets/assets/vendor/php-email-form/validate.js"></script>
    <script src="course_detail_assets/assets/vendor/purecounter/purecounter.js"></script>
    <script src="course_detail_assets/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="course_detail_assets/assets/js/main.js"></script>
</body>

</html>