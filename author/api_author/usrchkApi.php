<?php
include '../../conn.php';
$email_id=$_POST['email_id'];
$userChk="";
if (mysqli_num_rows(mysqli_query($conn, "select * from author where email_id='$email_id'")) > 0) {
    $userChk=0; 
}
else{
    $userChk=1;
}
echo $userChk;
?>