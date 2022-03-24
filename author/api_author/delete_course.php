<?php
session_start();
include '../../conn.php';
$course= $_POST['course'];
$res=mysqli_query($conn,"DELETE FROM `course` WHERE `course`.`course_id` = '$course' AND `course`.`author_id`='".$_SESSION['USER_LOGIN_ID']."'");
if($res){
    echo "Course is deleted successfully";
}
else {
    echo "You are not eligible to delete the course";
}
?>