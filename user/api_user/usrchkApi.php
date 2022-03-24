<?php
include '../../conn.php';
if (isset($_POST['username'])) {

$username=$_POST['username'];
$userChk="";
if (mysqli_num_rows(mysqli_query($conn, "select * from users where username='$username' AND payment_status=1")) > 0) {
    $userChk=0; 
}
else{
    $userChk=1;
}
echo $userChk;
}

if (isset($_POST['email'])) {

$email=$_POST['email'];
$userChk="";
if (mysqli_num_rows(mysqli_query($conn, "select * from users where email_id='$email' AND payment_status=1")) > 0) {
    $userChk=0; 
}
else{
    $userChk=1;
}
echo $userChk;
}
?>