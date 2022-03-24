<?php
session_start();
include './../conn.php';
include './inc/functions.php';

if (!isset($_SESSION['USER_LOGIN_DONE'])) {
    alert('Please Login as Student');
    redirect('login.php');
    
} else {
    if ($_SESSION['USER_LOGIN_ROLE'] != 2) {
        alert('Please Login as Student to continue');
        redirect('login.php');
    }
}
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

    <!-- Template Main CSS File -->
    <style>
        .bg {
            width: 100%;
            height: auto;
            min-height: 100vh;
            background-color: #f5f9ff;
            background-size: 100% 100%;
            background-position: top center;
            margin: auto
        }

        .mainRow {
            margin-left: 10%;
            margin-right: 10%
        }

        p {
            margin: 0px
        }

        .desc {
            background-color: #e8ffef;
            margin-top: 5%;
            margin-left: 0;
            margin-right: 50px;
            margin-bottom: 4%
        }

        .card-body {
            padding: 0;
            margin: 0;
            margin-top: 10%
        }

        div.card.main {
            margin: 0px !important
        }

        .card {
            padding: 0 !important;
            margin-top: 40px
        }

        .quantity,
        .shipping,
        .promocode,
        .subtotal,
        .cardAndExpire,
        .nameAndcvc {
            margin: 5%;
            color: #6c757d !important
        }

        .heading1 {
            margin: 5%;
            font-size: 25px
        }

        .heading2 {
            margin: 5%;
            margin-top: 15%;
            font-size: 20px
        }

        .payment {
            background-color: #e8ffef;
            padding: 3px;
            margin-top: 15%
        }

        .text1 {
            color: black;
            font-weight: 700
        }

        .card-footer {
            background-color: black;
            color: white
        }

        .purchaseLink {
            text-decoration: none
        }

        .row1 {
            font-size: 12px
        }

        .row2 {
            font-weight: 600
        }

        .subRow {
            margin-left: 10%;
            margin-bottom: 2%;
            margin-top: 5%
        }

        p.cardAndExpireValue,
        p.nameAndcvcValue {
            margin: 5%;
            margin-bottom: 10%;
            font-weight: 600
        }

        p.nameAndcvc,
        p.cardAndExpire {
            margin-bottom: -10px
        }

        .total {
            margin: 5%
        }

        .totalText {
            font-weight: 700
        }

        .totalText2 {
            font-weight: 700;
            font-size: 30px
        }

        .card-img-top {
            width: 100%;
            border-top-left-radius: calc(.25rem - 1px);
            border-top-right-radius: calc(.25rem - 1px);
            height: 430px
        }
    </style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <!--For Page-->
    <div class="bg">
        <!--For Row containing all card-->
        <div class="row mainRow">
            <!--Card 1-->
            <div class="col-sm-8">
                <div class="card card-cascade wider shadow p-3 mb-5 ">
                    <!--Card image-->
                    <div class="view view-cascade overlay text-center">
                        <?php
                        if (mysqli_num_rows($intro_vid) > 0) {
                        ?>
                            <video controls style="width:100%">
                                <source src="<?php echo $row_intro_vid['video_src']; ?>">
                                Your browser does not support HTML5 video.
                            </video>
                        <?php
                        } else {
                            echo '<img src="course_detail_assets/assets/img/course-details.jpg" class="img-fluid" alt="">';
                        }
                        ?>
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    <!--Product Description-->
                    <div class="desc">
                        <!-- 1st Row for title-->
                        <div class="row subRow">
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Course Name</p>
                                <p class="row2"><?php echo $row_res_crs_auth['course_name'] ?></p>
                            </div>
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Author</p>
                                <p class="row2"><?php echo $row_res_crs_auth['firstname'] . " " . $row_res_crs_auth['lastname'] ?></p>
                            </div>
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Category</p>
                                <p class="row2"><?php echo $row_res_crs_auth['course_category'] ?></p>
                            </div>
                        </div> <!-- 2nd Row for title-->
                        <div class="row subRow">
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Regular Fee</p>
                                <p class="row2"><del>&#x20B9;<?php echo $row_res_crs_auth['reg_course_fee'] ?></del></p>
                            </div>
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Offer Fee</p>
                                <p class="row2">&#x20B9;<?php echo $row_res_crs_auth['discount_course_fee'] ?></p>
                            </div>
                            <!--Column for Data-->

                        </div>
                    </div>
                </div>
            </div>
            <!--Card 2-->
            <div class="col-sm-4">
                <div class="card card-cascade card-ecommerce wider shadow p-3 mb-5 ">
                    <!--Card Body-->
                    <div class="card-body card-body-cascade">
                        <!--Card Description-->
                        <div class="card2decs">
                            <p class="heading1"><strong><?php echo $row_res_crs_auth['course_name'] ?></strong></p>
                            <p class="quantity">Total Videos <span class="float-right text1"><?php echo mysqli_num_rows($res_vid); ?></span></p>
                            <p class="subtotal">Subtotal<span class="float-right text1">&#x20B9;<?php echo $row_res_crs_auth['discount_course_fee'] ?>
                                    <del>&#x20B9;<?php echo $row_res_crs_auth['reg_course_fee'] ?></del>
                                </span></p>
                            <p class="shipping">Delivery Mode<span class="float-right text1">Online</span></p>
                            <p class="promocode">You Saved<span class="float-right text1">&#x20B9;-<?php echo $row_res_crs_auth['reg_course_fee'] - $row_res_crs_auth['discount_course_fee'] ?></span></p>
                            <p class="total"><strong>Total</strong><span class="float-right totalText1">&#x20B9;<span class="totalText2"><?php echo $row_res_crs_auth['discount_course_fee'] ?></span></span></p>
                        </div>
                        <div class="payment" style="padding:30px 0;">
                            <div class="form-group">
                                <label>Name<sup style="color:red">*</sup></label>
                                <input class="form-control" id="name" type="text" Required name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label>Email Address <sup style="color:red">*</sup></label>
                                <input class="form-control" id="email" type="email" Required name="email" placeholder="Email">
                            </div>

                        </div>
                        <!--Card footer-->

                        <button style="padding:12px 5px;width: 100%" type="button" onclick="pay_now()" class="btn btn-success">PURCHASE &#8594;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

    <script>
        function pay_now() {
            var name = $("#name").val();
            var email = $("#email").val();
            if (name == "" && email == "") {
                alert("Please enter name and email address");
            } else {
                var amount = <?php echo $row_res_crs_auth['discount_course_fee'] ?>;
                $.ajax({
                    type: "POST",
                    url: "./api_user/payment_process_api.php",
                    data: "name=" + name + "&email=" + email + "&amount=" + amount+ "&course_id=" + <?php echo $course_id ;?>,
                    success: function(result) {
                        var options = {
                            "key": "rzp_test_Rk368EKyMsznoL", // Enter the Key ID generated from the Dashboard
                            "amount": amount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                            "currency": "INR",
                            "name": "Learn Fun",
                            "description": "Test Transaction",
                            "image": "https://www.pngfind.com/pngs/m/669-6692892_logo-sample-logo-designs-for-schools-hd-png.png",
                            "handler": function(response) {
                                $.ajax({
                                    type: "POST",
                                    url: "./api_user/payment_process_api.php",
                                    data: "payment_id=" + response.razorpay_payment_id,
                                    success: function(result) {
                                        window.location.href = `thanks.php?pay_id=${response.razorpay_payment_id}`;
                                    }
                                });

                            },
                            "theme": {
                                "color": "#3399cc"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    }
                });
            }
        }
    </script>

</body>

</html>