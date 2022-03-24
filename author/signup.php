<?php
include '../conn.php';
include './inc/functions.php';
$msg_email = "";
if (isset($_POST['submit_usr'])) {
    $fname = get_safe_value($_POST['fname']);
    $lname = get_safe_value($_POST['lname']);
    $gender = get_safe_value($_POST['gender']);
    $age = get_safe_value($_POST['age']);
    $password = get_safe_value($_POST['cpassword']);
    $email = get_safe_value($_POST['email']);
    $joined_date = date('Y-m-d h:i:s');

    if (mysqli_num_rows(mysqli_query($conn, "select * from author where email_id='$email'")) > 0) {
        $msg_email = "EMAIL ID ALREADY USED";
    } else {
        mysqli_query($conn, "INSERT INTO `author` (`firstname`, `lastname`, `gender`, `age`, `email_id`, `password`, `role`, `joined_date`) 
            VALUES ('$fname','$lname','$gender', '$age','$email','$password',0,'$joined_date')");
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

    <?php include('./inc/styles.php') ?>
    <style>
        .login-content {
            background: #fff;
            padding: 0px 30px 20px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
        }
    </style>

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
                            <h2>Author Registration</h2>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name <sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" type="name" Required name="fname" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name <sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" type="name" Required name="lname" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email Address <sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" type="email" onkeyup="chkuser(this.value)" Required name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Age<sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" type="text" Required name="age" placeholder="Age">
                                        </div>
                                    </div>
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

                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="submit_usr" id="reg_submit" type="submit">Register Now</button>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

        function chkuser(usr) {
            $.ajax({
                url: './api_user/usrchkApi.php',
                type: 'post',
                data: {
                    email_id: usr,
                },
                success: function(response) {
                    if (response == 0) {
                        $('#message_usr').html('Email Id Already Exist').css('color', 'red');
                        $("#reg_submit").attr("disabled", 'true');
                    } else {
                        $('#message_usr').html('');
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