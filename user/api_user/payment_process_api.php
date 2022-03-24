<?php
session_start();
include('../../conn.php');
include('../inc/functions.php');

// if we get payment_id
$course_id = $_POST['course_id'];
if (isset($_POST['payment_id']) && isset($_SESSION['oid'])) {
    $payment_id = $_POST['payment_id'];
    //   mysqli_query($con,"insert into payment(name,amount,payment_status,payment_id,added_on) values('$name',$amount,$payment_status',$payment_id','$added_on')");
    $payment_query = mysqli_query($conn, "UPDATE `subscriptions` SET payment_status='complete',payment_id='$payment_id' where subscription_id ='" . $_SESSION['oid'] . "'");
    if ($payment_query) {
        $prd_query = mysqli_query($conn, "SELECT * FROM products WHERE course_prod_id=$course_id");
        if (mysqli_num_rows($prd_query) > 0) {
            $prd_row = mysqli_fetch_assoc($prd_query);
            $product_id=$prd_query['product_id'];
            mysqli_query($conn, "INSERT INTO `product_track`(product_id_for_track,user_prod_track_id,track_status) VALUES ('$product_id', '" . $_SESSION['USER_LOGIN_ID'] . "','ordered')");
        }
    }
}

// if we get only name and amt
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['amount']) && isset($_POST['course_id'])) {
    $amount = $_POST['amount'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course_id = $_POST['course_id'];
    $payment_status = "pending";
    $added_on = date("Y-m-d h:i:s");
    mysqli_query($conn, "INSERT INTO `subscriptions` (`user_sub_id`,`course_sub_id`,`name`,`email`, `amount`, `payment_status`, `added_on`) VALUES ('" . $_SESSION['USER_LOGIN_ID'] . "','$course_id','$name','$email', '$amount', '$payment_status','$added_on')");

    $_SESSION['oid'] = mysqli_insert_id($conn);
}
