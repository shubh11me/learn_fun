<?php
session_start();
include '../../conn.php';

$course = $_POST['course'];
$video = $_POST['video'];
$res_crs = mysqli_query($conn, "SELECT * FROM course where course_id=$course AND author_id='" . $_SESSION['USER_LOGIN_ID'] . "'");
if (mysqli_num_rows($res_crs) == 0) {
    alert("Wrong Request");
    redirect('./index.php');
} else {
    $res = mysqli_query($conn, "DELETE FROM `videos_course` WHERE `videos_course`.`video_id` = '$video'");
    if ($res) {
        echo "Video is deleted successfully";
    } else {
        echo "You are not eligible to delete the Video";
    }
};
