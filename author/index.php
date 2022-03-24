<?php
session_start();
include './../conn.php';
include './inc/functions.php';
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

check_author_auth();

if (isset($_POST['submit_course'])) {
    $course_name = $_POST['course_name'];
    $course_cat = $_POST['course_cat'];
    $course_desc = $_POST['course_desc'];
    $course_fee = $_POST['course_fee'];
    $offer_fees = $_POST['offer_fees'];
    $prime_fees = $_POST['prime_fees'];
    $date = date('Y-m-d h:i:s');
    $same_course = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM course Where course_name = '$course_name' AND author_id='" . $_SESSION['USER_LOGIN_ID'] . "' "));
    if ($same_course == 0) {
        // mysqli_query($conn,"INSERT INTO course (course_name,course_category,reg_course_fee,prm_course_fee,discount_course_fee,date,author_id,)
        // VALUES('$course_name','$course_cat','$course_fee','$prime_fees','$offer_fees','$date','".$_SESSION['USER_LOGIN_ID']."'");

        mysqli_query($conn, "INSERT INTO `course` (`course_name`, `course_category`,`description`, `reg_course_fee`, `prm_course_fee`, `discount_course_fee`, `date`, `author_id`)
         VALUES ('$course_name','$course_cat','$course_desc','$course_fee','$prime_fees','$offer_fees','$date','" . $_SESSION['USER_LOGIN_ID'] . "')");
        alert("Course is added");
        redirect('./index.php');
    } else {
        alert("Course is exist");
        redirect('./index.php');
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
                                    <strong>Add Course</strong>
                                    <small>let's create</small>
                                </div>
                                <form action="" method="post">
                                    <div class="card-body card-block">

                                        <div class="row form-group">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="course_name" class=" form-control-label">Course Name</label>
                                                    <input type="text" id="course_name" name="course_name" required placeholder="Course Name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="course_desc" class=" form-control-label">Course Description</label>
                                                    <textarea id="course_desc" name="course_desc" required placeholder="Course Description" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="course_cat" class=" form-control-label">Category</label>
                                                    <select name="course_cat" required id="course_cat" class="form-control">
                                                        <option>Please select course category</option>
                                                        <option>Computer</option>
                                                        <option>Skill</option>
                                                        <option>Home services</option>
                                                        <option>General Knowledge</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="course_fee" class=" form-control-label">Course Fees</label>
                                                    <input type="number" id="course_fee" name="course_fee" required placeholder="Course Fees" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="offer_fees" class=" form-control-label">Offer Fees</label>
                                                    <input type="number" id="offer_fees" name="offer_fees" placeholder="Offer Fees" class="form-control">
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="prime_fees" class=" form-control-label">Prime Fees</label>
                                                    <input type="number" id="prime_fees" name="prime_fees" placeholder="Prime Fees" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit_course">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="card">
                                <div class="card-header card_header_add">
                                    <strong>Courses</strong>
                                    <small> by Shubh</small>
                                </div>
                                <div class="card-body card-block">

                                    <div class="table-responsive table-responsive-data2">
                                        <table class="table table-data2 table_stock">
                                            <?php
                                            $res_crs = mysqli_query($conn, "SELECT * FROM course where author_id='" . $_SESSION['USER_LOGIN_ID'] . "'");
                                            if (mysqli_num_rows($res_crs) > 0) {
                                            ?>
                                                <thead>
                                                    <tr class="bg-danger table_stock_header">

                                                        <th>Sr. No</th>
                                                        <th>Course Name</th>
                                                        <th>Course Category</th>
                                                        <th>Regular Fee</th>
                                                        <th>Prime Fee</th>
                                                        <th>Offer Fee</th>
                                                        <th>Edit/Add Videos</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($res_crs)) {
                                                        # code...


                                                    ?>
                                                        <tr class="tr-shadow">
                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo $row['course_name'] ?></td>
                                                            <td><?php echo $row['course_category'] ?></td>
                                                            <td><?php echo $row['reg_course_fee'] ?></td>
                                                            <td><?php echo $row['prm_course_fee'] ?></td>
                                                            <td><?php echo $row['discount_course_fee'] ?></td>

                                                            <td>
                                                                <a href="edit_course.php?course_id='<?php echo $row['course_id']; ?>'">
                                                                    <button class="item btn btn-primary" id="edit_btn" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        <i class="zmdi zmdi-edit"></i>
                                                                    </button>
                                                                </a>

                                                                <a href="add_videos.php?course_id='<?php echo $row['course_id']; ?>'">
                                                                    <button class="item btn btn-success" id="add_video" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        <i class="zmdi zmdi-plus"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <button class="item btn btn-danger" id="delete" data-toggle="tooltip" onclick="deleteCourse('<?php echo $row['course_id'] ?>')" data-placement="top" title="delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </td>


                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                <?php
                                                        $i++;
                                                    }
                                                } else {
                                                    echo "<h4>No Courses Added</h4>";
                                                } ?>
                                                </tbody>
                                        </table>
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
    <!-- END MAIN CONTENT-->


    <!-- END PAGE CONTAINER-->
    </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function deleteCourse(course) {
            let perm = confirm("Are you sure you want to delete this course");
            if (perm) {

                $.ajax({
                    url: './api_author/delete_course.php',
                    type: 'post',
                    data: {
                        course: course,
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
    <?php include("./inc/scripts.php"); ?>
</body>

</html>
<!-- end document-->