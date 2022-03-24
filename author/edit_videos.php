<?php
session_start();
include './../conn.php';
include './inc/functions.php';
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
$msg_upload = "";
check_author_auth();
if (!isset($_GET['course_id']) && !isset($_GET['video_id'])) {
    redirect('./index.php');
} else {
    $course_id = $_GET['course_id'];
    $video_id = $_GET['video_id'];
    $res_crs = mysqli_query($conn, "SELECT * FROM course where course_id=$course_id AND author_id='" . $_SESSION['USER_LOGIN_ID'] . "'");
    if (mysqli_num_rows($res_crs) == 0) {
        redirect('./index.php');
    }
    $row_crs = mysqli_fetch_assoc($res_crs);

    if (isset($_POST['update_video'])) {
        $vid_name = $_POST['video_name'];
        $vid_tag = $_POST['info_switch'];
        // alert($vid_tag)
        if ($vid_tag == "info") {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM videos_course WHERE course_id_vid=$course_id AND vid_tag='info'")) == 0) {
                mysqli_query($conn, "UPDATE videos_course SET video_name='$vid_name',vid_tag='$vid_tag' WHERE course_id_vid=$course_id AND video_id=$video_id");
                $msg_upload = "Video Info Updated";
                redirect("add_videos.php?course_id=$course_id");
            } else {
                $msg_upload = "Only one info video is allowed.Please Change info of other video";
            }
        } else {
            mysqli_query($conn, "UPDATE videos_course SET video_name='$vid_name',vid_tag='$vid_tag' WHERE course_id_vid=$course_id AND video_id=$video_id");
            $msg_upload = "Video Info Updated";
        }
        $link = "add_videos.php?course_id=$course_id";
        alert($msg_upload);

        redirect($link);
    }
    $res_vid = mysqli_query($conn, "SELECT * FROM videos_course WHERE course_id_vid=$course_id AND video_id=$video_id");
    $row_vid = mysqli_fetch_array($res_vid);
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
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <?php include("./inc/styles.php") ?>

</head>

<body class="animsition">

    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include("./inc/mobile_nav.php") ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php include("./inc/sidebar.php") ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include("./inc/header_desk.php") ?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header card_header_add">
                                    <strong>Update Video</strong>
                                    <small>For <?php echo $row_vid['video_name'] ?></small>
                                </div>
                                <form action="" method="post" enctype='multipart/form-data'>
                                    <div class="card-body card-block">
                                        <h3>Video Name:- <?php echo $row_vid['video_name'] ?></h3> <br>
                                        <div class="row form-group">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="video_name" class=" form-control-label">Video Name</label>
                                                    <input type="text" Required id="video_name" value="<?php echo $row_vid['video_name'] ?>" name="video_name" placeholder="Video Name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Info Video ?<sup style="color:red">*</sup></label>
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input Required type="radio" id="radio1" name="info_switch" value="info" class="form-check-input">Yes
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input Required type="radio" checked id="radio2" name="info_switch" value="default" class="form-check-input">No
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" name="update_video">
                                            Update Video &nbsp; <i class="fa fa-video-camera"></i>
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php include './inc/footer.php' ?>
        </div>
    </div>
    </div>
    <script>
        function deleteVideos(course, video) {
            let perm = confirm("Are you sure you want to delete this course");
            if (perm) {

                $.ajax({
                    url: './api_author/delete_video_api.php',
                    type: 'post',
                    data: {
                        course: course,
                        video: video,
                    },
                    success: function(response) {
                        alert(response);
                        window.location.reload();
                    }
                });
            } else {
                alert("Course is not deleted");
            }
        }
    </script>
    <!-- END MAIN CONTENT-->


    <!-- END PAGE CONTAINER-->
    </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <?php include("./inc/scripts.php"); ?>
</body>

</html>
<!-- end document-->