<?php
session_start();
include '../../conn.php';
include '../inc/functions.php';
$msg_email = "";
$error = false;

// if we get payment_id
if (isset($_POST['payment_id']) && isset($_SESSION['oid_reg'])) {
    $payment_id = $_POST['payment_id'];
    mysqli_query($conn, "UPDATE `users` SET payment_status=1,payment_id='$payment_id' where user_id='" . $_SESSION['oid_reg'] . "'");
}

// if we get only name and amt
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['uname']) && isset($_POST['cpassword']) && isset($_POST['email'])) {
    $fname = get_safe_value($_POST['fname']);
    $lname = get_safe_value($_POST['lname']);
    $uname = get_safe_value($_POST['uname']);
    $password = get_safe_value($_POST['cpassword']);
    $email = get_safe_value($_POST['email']);
    $joined_date = date('Y-m-d h:i:s');

    if (mysqli_num_rows(mysqli_query($conn, "select * from users where email_id='$email' AND payment_status=1 ")) > 0) {
        $msg_email = "EMAIL ID ALREADY USED";
        $error = "Email";
    } else {
        if (mysqli_num_rows(mysqli_query($conn, "select * from users where username='$uname' AND payment_status=1")) > 0) {
            $msg_email = "Username is already registered";
            $error = "Uname";
        } else {
            mysqli_query($conn, "INSERT INTO `users` (`firstname`, `lastname`, `username`, `email_id`, `password`,`role`,`payment_status`,`joined_by_role`,`joined_by_id`, `joined_date`) VALUES ('$fname','$lname','$uname','$email','$password',2,0,1,'" . $_SESSION["USER_LOGIN_ID"] . "','$joined_date')");
            $error = false;
            
        }
    }
    $_SESSION['oid_reg'] = mysqli_insert_id($conn);
    echo json_encode($error);
}
