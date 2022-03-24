<?php
session_start();
include '../conn.php';
include './inc/functions.php';
$msg_email = "";
if (!isset($_SESSION['USER_LOGIN_DONE'])) {
    alert('Please Login as Influencer');
    redirect('login.php');
    
} else {
    if ($_SESSION['USER_LOGIN_ROLE'] != 1) {
        alert('Please Login as Influencer to continue');
        redirect('login.php');
    }
}
// if (isset($_POST['submit_usr'])) {
//     $fname = get_safe_value($_POST['fname']);
//     $lname = get_safe_value($_POST['lname']);
//     $uname = get_safe_value($_POST['uname']);
//     $password = get_safe_value($_POST['cpassword']);
//     $email = get_safe_value($_POST['email']);
//     $joined_date = date('Y-m-d h:i:s');

//     if (mysqli_num_rows(mysqli_query($conn, "select * from users where email_id='$email'")) > 0) {
//         $msg_email = "EMAIL ID ALREADY USED";
//     } else {
//         if (mysqli_num_rows(mysqli_query($conn, "select * from users where username='$uname'")) > 0) {
//             echo "<script> $('#message_usr').html('Username Already Exist');</script>";
//         } else {
//             mysqli_query($conn, "INSERT INTO `users` (`firstname`, `lastname`, `username`, `email_id`, `password`, `role`, `joined_date`) 
//             VALUES ('$fname','$lname','$uname','$email','$password',2,'$joined_date')");
//             echo "cool";
//         }
//     }
//     echo $fname;
// }
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
                            <form>
                                <h3 class="text-center">Add New User</h3>
                                <h5 class="text-center">Thanks for Spreading Knowledge </h5>
                                <br>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address <sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" id="email" onkeyup="emailuser(this.value)" type="email" Required name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username <sup style="color:red">*</sup></label>
                                            <input class="au-input au-input--full" id="uname" onkeyup="chkuser(this.value)" Required type="text" name="uname" placeholder="UserName">
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
                                    <div class="email"></div>
                                    <?php
                                    if ($msg_email != "") { ?>
                                        <p class="email">Email Id Already Exist</p>
                                    <?php
                                    }
                                    ?>
                                    <p class="match" id="message_usr"></p>
                                </div>


                                <button class="au-btn au-btn--block au-btn--green m-b-20" onclick="reg_now()" id="reg_submit" type="button">Register Now</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function reg_now() {
            // alert('Please wait');
            var fname = $("#fname").val().trim();
            var lname = $("#lname").val().trim();
            var email = $("#email").val().trim();
            var uname = $("#uname").val().trim();
            var cpassword = $("#cpassword").val().trim();
            if (fname == "" && lname == "" && email == "" && uname == "" && cpassword == "" && $("#password").val() == "") {
                alert("Please FIll required Info")
            } else {
                alert("fname=" + fname + "&lname=" + lname + "&email=" + email + "&uname=" + uname + "&cpassword=" + cpassword );
                $.ajax({
                        type: "POST",
                        url: "api_influ/register_user_api.php",
                        data: "fname=" + fname + "&lname=" + lname + "&email=" + email + "&uname=" + uname + "&cpassword=" + cpassword,
                        success: function(result) {
                            if (result == "false") {
                                var options = {
                                    "key": "rzp_test_Rk368EKyMsznoL", // Enter the Key ID generated from the Dashboard
                                    "amount": 200 * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                                    "currency": "INR",
                                    "name": "Learn Fun",
                                    "description": "Test Transaction",
                                    "image": "https://www.pngfind.com/pngs/m/669-6692892_logo-sample-logo-designs-for-schools-hd-png.png",
                                    "handler": function(response) {
                                        $.ajax({
                                            type: "POST",
                                            url: "./api_influ/register_user_api.php",
                                            data: "payment_id=" + response.razorpay_payment_id,
                                            success: function(result) {
                                                alert("User registration successful");
                                                window.location.href = `../user/login.php`;
                                            }
                                        });

                                    },
                                    "theme": {
                                        "color": "#3399cc"
                                    }
                                };
                                var rzp1 = new Razorpay(options);
                                rzp1.open();
                            } else {
                                alert("Registration Failed");
                            }
                            // alert(result);
                        }
                    });
                }
            }
    </script>

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
                url: './api_influ/usrchkApi.php',
                type: 'post',
                data: {
                    username: usr,
                },
                success: function(response) {
                    if (response == 0) {
                        $('#message_usr').html('Username Already Exist');
                        $("#reg_submit").attr("disabled", 'true');
                    } else {
                        $('#message_usr').html('');
                        $("#reg_submit").removeAttr('disabled');
                    }
                }
            });
        }

        function emailuser(email) {
            $.ajax({
                url: './api_influ/usrchkApi.php',
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