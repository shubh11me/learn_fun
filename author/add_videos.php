<?php
session_start();
include './../conn.php';
include './inc/functions.php';
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
$msg_upload = "";
check_author_auth();
if (!isset($_GET['course_id'])) {
    redirect('./index.php');
} else {
    $course_id = $_GET['course_id'];
    $res_crs = mysqli_query($conn, "SELECT * FROM course,author where course_id=$course_id AND author_id='" . $_SESSION['USER_LOGIN_ID'] . "'");
    if (mysqli_num_rows($res_crs) == 0) {
        redirect('./index.php');
    }
    $row_crs = mysqli_fetch_assoc($res_crs);

    if (isset($_POST['upload_video'])) {
        $vid_name = $_POST['video_name'];
        $vid_tag = $_POST['info_switch'];
        if ($vid_tag == "info") {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM videos_course WHERE course_id_vid=$course_id AND vid_tag='info'")) == 0) {

                echo $vid_tag . "<br>";
                $maxsize = 52428800; // 50MB
                if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                    $name = $_FILES['file']['name'];
                    $target_dir = "../videos/";
                    $target_file = $target_dir . $_FILES["file"]["name"];
                    // Select file type
                    $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Valid file extensions
                    $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

                    // Check extension
                    if (in_array($extension, $extensions_arr)) {

                        // Check file size
                        if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                            $msg_upload = "File too large. File must be less than 50MB.";
                        } else {
                            // Upload
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                                // Insert record
                                $query = "INSERT INTO videos_course(course_id_vid,video_name,video_src,vid_tag) VALUES($course_id,'$name','$target_file','$vid_tag')";
                                echo $query;
                                $res = mysqli_query($conn, $query);
                                if ($res) {

                                    $msg_upload = "Upload successfully.";
                                    // echo "<br>" . "add_videos.php?course_id=$course_id";
                                    header('Location:add_videos.php?course_id=' . $course_id);
                                }
                            } else {
                                $msg_upload = "Upload tumb.";
                            }
                        }
                    } else {
                        $msg_upload = "Invalid file extension.";
                    }
                } else {
                    $msg_upload = "Please select a file.";
                }
                // echo '<script>window.location.href="add_videos.php?course_id='.$course_id.'</script>';

            } else {
                $msg_upload = "Only one info video is allowed.Please Change info of other video";
            }
        } else {
            $maxsize = 52428800; // 50MB
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                $name = $_FILES['file']['name'];
                $target_dir = "../videos/";
                $target_file = $target_dir . $_FILES["file"]["name"];
                // Select file type
                $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Valid file extensions
                $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

                // Check extension
                if (in_array($extension, $extensions_arr)) {

                    // Check file size
                    if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                        $msg_upload = "File too large. File must be less than 50MB.";
                    } else {
                        // Upload
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                            // Insert record
                            $query = "INSERT INTO videos_course(course_id_vid,video_name,video_src,vid_tag) VALUES($course_id,'$name','$target_file','$vid_tag')";
                            echo $query;
                            $res = mysqli_query($conn, $query);
                            if ($res) {

                                $msg_upload = "Upload successfully.";
                                // echo "<br>" . "add_videos.php?course_id=$course_id";
                                header('Location:add_videos.php?course_id=' . $course_id);
                            }
                        } else {
                            $msg_upload = "Upload tumb.";
                        }
                    }
                } else {
                    $msg_upload = "Invalid file extension.";
                }
            } else {
                $msg_upload = "Please select a file.";
            }
        }
        alert($msg_upload);
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
                                    <strong>Add Videos</strong>
                                    <small>For <?php echo $row_crs['course_name'] ?></small>
                                </div>
                                <form action="" method="post" enctype='multipart/form-data'>
                                    <div class="card-body card-block">
                                        <h3>Course Name:- <?php echo $row_crs['course_name'] ?></h3> <br>
                                        <div class="row form-group">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="video_name" class=" form-control-label">Video Name</label>
                                                    <input type="text" Required id="video_name" name="video_name" placeholder="Video Name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="video_name" class=" form-control-label">Upload Video :-</label>
                                                    <input type='file' Required name='file' />
                                                </div>
                                            </div>
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
                                        <button type="submit" class="btn btn-primary btn-sm" name="upload_video">
                                            Upload Video &nbsp; <i class="fa fa-video-camera"></i>
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="card">
                                <div class="card-header card_header_add">
                                    <strong>Video list</strong>
                                    <small> for <?php echo $row_crs['course_name'] ?></small>
                                </div>
                                <div class="card-body card-block">
                                    <div class="table-responsive table-responsive-data2">
                                        <?php
                                        $vid_ret_res = mysqli_query($conn, "SELECT * FROM videos_course WHERE course_id_vid=$course_id");
                                        if (mysqli_num_rows($vid_ret_res) > 0) {

                                        ?>
                                            <table class="table table-data2 table_stock">
                                                <thead>
                                                    <tr class="bg-danger table_stock_header">

                                                        <th>Sr. No</th>
                                                        <th>Video Name</th>
                                                        <th>Course Name</th>
                                                        <th>Video Tag</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    while ($row_vid_ret = mysqli_fetch_assoc($vid_ret_res)) {
                                                    ?>
                                                        <tr class="tr-shadow">

                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo $row_vid_ret['video_name'] ?></td>
                                                            <td><?php echo $row_crs['course_name'] ?></td>
                                                            <td><?php echo $row_vid_ret['vid_tag'] ?></td>
                                                            <td>
                                                                <a href="edit_videos.php?course_id=<?php echo $course_id ?>&video_id='<?php echo $row_vid_ret['video_id']; ?>'">
                                                                    <button class="item btn btn-primary" id="edit_btn" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        <i class="zmdi zmdi-edit"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <button class="item btn btn-danger" id="delete" data-toggle="tooltip" onclick="deleteVideos(<?php echo $course_id ?>,'<?php echo $row_vid_ret['video_id'] ?>')" data-placement="top" title="delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </td>

                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                    <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        } else {
                                            echo "No Videos added";
                                        } ?>
                                    </div>

                                </div>
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