<?php
session_start();
include './../conn.php';
include './inc/functions.php';

if (!isset($_SESSION['USER_LOGIN_DONE'])) {
    alert('Please Login as Influencer');
    redirect('login.php');

} else {
    if ($_SESSION['USER_LOGIN_ROLE'] != 1) {
        alert('Please Login as Influencer to continue');
        redirect('login.php');
    }
}

$usr_detai_query = mysqli_query($conn, "SELECT * FROM influencer WHERE influ_id ='" . $_SESSION['USER_LOGIN_ID'] . "'");
if (mysqli_num_rows($usr_detai_query) > 0) {
    $row_data = mysqli_fetch_assoc($usr_detai_query);
} else {
    alert('User not found');
    redirect("login.php");
}

if (isset($_POST["usr_update"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $pass = $_POST["pass"];
    $query = mysqli_query($conn, "SELECT * FROM influencer WHERE  influ_id ='" . $_SESSION['USER_LOGIN_ID'] . "' AND influ_password='$pass' ");
    if (mysqli_num_rows($query) > 0) {
        $updt_query = mysqli_query($conn, "UPDATE influencer SET influ_email='$email',gender='$gender',age='$age',influ_firstname='$fname',influ_lastname='$lname' WHERE  influ_id ='" . $_SESSION['USER_LOGIN_ID'] . "' AND influ_password='$pass'");
        if ($updt_query) {
            alert("User is updated,Please login again with new cred");
            unset($_SESSION["USER_LOGIN_DONE"]);
            unset($_SESSION["USER_LOGIN_ID"]);
            unset($_SESSION["USER_LOGIN_FNAME"]);
            unset($_SESSION["USER_LOGIN_LNAME"]);
            unset($_SESSION["USER_LOGIN_EMAIL"]);
            unset($_SESSION["USER_LOGIN_ROLE"]);
            redirect("login.php");
        }
    } else {
        alert("Please enter correct password to proceed");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <?php include("./inc/styles.php") ?>

</head>

<body class="animsition">

    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include("./inc/mobile_nav.php") ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php include("./inc/sidebar.php") ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include("./inc/header_desk.php") ?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header card_header_add">
                                    <strong>Update your Info</strong>
                                    <small></small>
                                </div>
                                <form action="" method="post">
                                    <div class="card-body card-block">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name <sup style="color:red">*</sup></label>
                                                    <input class="au-input au-input--full" id="fname" type="name" value="<?php echo $row_data['influ_firstname'] ?>" Required name="fname" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name <sup style="color:red">*</sup></label>
                                                    <input class="au-input au-input--full" id="lname" type="name" value="<?php echo $row_data['influ_lastname'] ?>" Required name=" lname" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email Address <sup style="color:red">*</sup></label>
                                                    <input class="au-input au-input--full" id="email" value="<?php echo $row_data['influ_email'] ?>" onkeyup="emailuser(this.value)" type="email" Required name="email" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gender<sup style="color:red">*</sup></label>
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" id="radio1" required name="gender" value="male" class="form-check-input">Male
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" required name="gender" value="female" class="form-check-input">Female
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Age<sup style="color:red">*</sup></label>
                                                    <input class="au-input au-input--full" id="age" value="<?php echo $row_data['age'] ?>"Required type="text" name="age" placeholder="Age">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email"></div>
                                        <div id="message_usr"></div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Please enter password to update info <sup style="color:red">*</sup></label>
                                                <input class="au-input au-input--full" id="pass" Required type="text" name="pass" placeholder="Password">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are You Sure to Update ,Please Check info once again')" id="usr_update" name="usr_update">
                                            Update Info &nbsp; <i class="fa fa-video-camera"></i>
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <?php include './inc/footer.php' ?>
        </div>
    </div>
    </div>
    <script>
        function emailuser(email) {
            if (email != <?php echo $row_data['email_id'] ?>) {
                $.ajax({
                    url: './api_influ/influchk.php',
                    type: 'post',
                    data: {
                        email: email,
                    },
                    success: function(response) {
                        if (response == 0) {
                            $('.email').html('Email Already Exist');
                            $("#usr_update").attr("disabled", 'true');
                        } else {
                            $('.email').html('');
                            $("#usr_update").removeAttr('disabled');
                        }
                    }
                });
            }
        }
    </script>
    <!-- END MAIN CONTENT-->


    <!-- END PAGE CONTAINER-->
    </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <?php include("./inc/scripts.php"); ?>
</body>

</html>
<!-- end document-->