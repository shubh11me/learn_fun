<?php
include '../conn.php';
include './inc/functions.php';
$msg_email = "";
if (isset($_POST['reg_submit'])) {
    $fname = get_safe_value($_POST['fname']);
    $lname = get_safe_value($_POST['lname']);
    $password = get_safe_value($_POST['cpassword']);
    $email = get_safe_value($_POST['email']);
    $age = get_safe_value($_POST['age']);
    $gender = get_safe_value($_POST['gender']);

    if (mysqli_num_rows(mysqli_query($conn, "select * from influencer where influ_email='$email'")) > 0) {
        $msg_email = "EMAIL ID ALREADY USED";
    } else {
        mysqli_query($conn, "INSERT INTO `influencer` (`influ_firstname`, `influ_lastname`, `influ_email`, `influ_password`, `role`, `gender`, `age`) 
            VALUES ('$fname','$lname','$email','$password',1,'$gender','$age')");
        alert("Registered Successful,Please Login");
        redirect("login.php");
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
    <title>Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <?php include('./inc/styles.php') ?>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form method="post" action="">
                                <h3 class="text-center">Register As Influencer</h3> <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name <sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" id="fname" type="name" Required name="fname" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name <sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" id="lname" type="name" Required name="lname" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email Address <sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" id="email" onkeyup="emailuser(this.value)" type="email" Required name="email" placeholder="Email">
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
                                                        <input type="radio" id="radio1" name="gender" value="male" class="form-check-input">Male
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label for="radio2" class="form-check-label ">
                                                        <input type="radio" id="radio2" name="gender" value="female" class="form-check-input">Female
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Age<sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" id="age" Required type="text" name="age" placeholder="Age">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password <sup style="color:red">*</sup></label>
                                    <input class="au-input au-input--full" type="password" name="password" Required id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password <sup style="color:red">*</sup></label>
                                    <input class="au-input au-input--full" type="password" name="cpassword" Required id="cpassword" placeholder="Confirm Password">
                                </div>

                                <div class="notif_sign_up">
                                    <p id="message"></p>

                                    <?php
                                    if ($msg_email != "") { ?>
                                        <p class="email">Email Id Already Exist</p>
                                    <?php
                                    }
                                    ?>
                                    <p class="match" id="message_usr"></p>
                                </div>


                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="reg_submit" id="reg_submit" type="submit">Register Now</button>

                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="./login.php">Sign In Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script>
        $('#password, #cpassword').on('keyup', function() {
            if ($('#password').val() !== '' && $('#cpassword').val() !== '') {


                if ($('#password').val() == $('#cpassword').val()) {
                    $('#message').html('Matching').addClass('match');
                    $('#message').removeClass('no_match');
                    $("#reg_submit").removeAttr("disabled", 'true');
                } else {
                    $('#message').html('Not Matching').addClass('no_match');
                    $('#message').removeClass('match');
                    $("#reg_submit").attr("disabled", 'true');
                }
            } else {
                $('#message').html(' ').css('color', 'red');
            }
        });

        function emailuser(email) {
            $.ajax({
                url: './usrchkApi.php',
                type: 'post',
                data: {
                    email: email,
                },
                success: function(response) {
                    if (response == 0) {
                        $('.email').html('Email Already Exist');
                        $("#reg_submit").attr("disabled", 'true');
                    } else {
                        $('.email').html('');
                        $("#reg_submit").removeAttr('disabled');
                    }
                }
            });
        }
    </script>

    <!-- Scripts JS-->
    <?php include('./inc/scripts.php') ?>

</body>

</html>
<!-- end document-->