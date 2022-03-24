<?php
session_start();
include '../conn.php';
include './inc/functions.php';
$msg_info = "";

if (isset($_POST['login_submit'])) {
    $email = get_safe_value($_POST['email']);
    $password = get_safe_value($_POST['password']);

    $res = mysqli_query($conn, "select * from author where email_id='$email'");

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($password===$row['password']) {
            $_SESSION['USER_LOGIN_DONE'] = true;
            $_SESSION['USER_LOGIN_ID'] = $row['auhor_id'];
            $_SESSION['USER_LOGIN_FNAME'] = $row['firstname'];
            $_SESSION['USER_LOGIN_LNAME'] = $row['lastname'];
            $_SESSION['USER_LOGIN_gender'] = $row['gender'];
            $_SESSION['USER_LOGIN_ROLE'] = $row['role'];
         
            // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
            $msg_info = "login done";
            redirect("./index.php");
        } else {
            $msg_info = "Please Enter Correct Password";
        }
    } else {
        $msg_info = "Please Enter Valid Login Details";
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
                                <h2>Author Login</h2>
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">


                                <div class="form-group">
                                    <label>Email Address <sup style="color:red">*</sup></label>
                                    <input class="au-input au-input--full" type="email" Required name="email" placeholder="Email">
                                </div>




                                <div class="form-group">
                                    <label>Password <sup style="color:red">*</sup></label>
                                    <input class="au-input au-input--full" type="password" name="password" Required id="password" placeholder="Password">
                                </div>


                                <div class="notif_sign_up">
                                    <p class="msg_info" style="color:red"><?php echo $msg_info; ?></p>
                                </div>

                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="login_submit" id="log_submit" type="submit">Login</button>

                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="./signup.php">Register Here !!!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- Scripts JS-->
    <?php include('./inc/scripts.php') ?>

</body>

</html>
<!-- end document-->