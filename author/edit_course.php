<?php
session_start();
include './../conn.php';
include './inc/functions.php';
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

check_author_auth();
if (!isset($_GET['course_id'])) {
    redirect('./index.php');
} else {
    $course_id = $_GET['course_id'];

    // echo "SELECT * FROM course where course_id=$course_id AND author_id='" . $_SESSION['USER_LOGIN_ID'] . "'";
    if (isset($_POST['update_course'])) {
        $course_name = $_POST['course_name'];
        $course_cat = $_POST['course_cat'];
        $course_desc = $_POST['course_desc'];
        $course_fee = $_POST['course_fee'];
        $offer_fees = $_POST['offer_fees'];
        $prime_fees = $_POST['prime_fees'];

        $sql_upt = "UPDATE `course` SET `course_name` = '$course_name',`description` = '$course_desc', `course_category` = '$course_cat',`reg_course_fee` = '$course_fee',`discount_course_fee` = '$offer_fees', 
               `prm_course_fee` = '$prime_fees' WHERE course_id=$course_id AND author_id='" . $_SESSION['USER_LOGIN_ID'] . "'";

        $res = mysqli_query($conn, $sql_upt);
        if ($res) {
            alert("Course is Updated");
            redirect('./index.php');
        } else {
            alert("Course is not Updated");
        }
    }
    $res_crs = mysqli_query($conn, "SELECT * FROM course where course_id=$course_id AND author_id='" . $_SESSION['USER_LOGIN_ID'] . "'");
    if (mysqli_num_rows($res_crs) == 0) {
        redirect('./index.php');
    }
    $row_crs = mysqli_fetch_assoc($res_crs);
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
                                    <strong>Update Course</strong>
                                    <small>let's create</small>
                                </div>
                                <form action="" method="post">
                                    <div class="card-body card-block">

                                        <div class="row form-group">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="course_name" class=" form-control-label">Course Name</label>
                                                    <input type="text" id="course_name" value="<?php echo $row_crs["course_name"] ?>" name="course_name" required placeholder="Course Name" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row form-group">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="course_desc" class=" form-control-label">Course Description</label>
                                                    <textarea id="course_desc" value="<?php echo $row_crs["description"] ?>" name="course_desc" required placeholder="Course Description" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="course_cat" class=" form-control-label">Category</label>
                                                    <select name="course_cat" required id="course_cat" class="form-control">
                                                        <option <?php if ($row_crs['course_category'] == "def") {
                                                                    echo "selected";
                                                                } ?> value="def">Please select course category</option>
                                                        <option <?php if ($row_crs['course_category'] == "Computer") {
                                                                    echo "selected";
                                                                } ?> value="Computer">Computer</option>
                                                        <option <?php if ($row_crs['course_category'] == "Skill") {
                                                                    echo "selected";
                                                                } ?> value="Skill">Skill</option>
                                                        <option <?php if ($row_crs['course_category'] == "Home services") {
                                                                    echo "selected";
                                                                } ?> value="Home services">Home services</option>
                                                        <option <?php if ($row_crs['course_category'] == "General Knowledge") {
                                                                    echo "selected";
                                                                } ?> value="General Knowledge">General Knowledge</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="course_fee" class=" form-control-label">Course Fees</label>
                                                    <input type="number" value="<?php echo $row_crs["reg_course_fee"] ?>" id="course_fee" name="course_fee" required placeholder="Course Fees" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="offer_fees" class=" form-control-label">Offer Fees</label>
                                                    <input type="number" value="<?php echo $row_crs["discount_course_fee"] ?>" id="offer_fees" name="offer_fees" placeholder="Offer Fees" class="form-control">
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="prime_fees" class=" form-control-label">Prime Fees</label>
                                                    <input type="number" value="<?php echo $row_crs["prm_course_fee"] ?>" id="prime_fees" name="prime_fees" placeholder="Prime Fees" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" name="update_course">
                                            <i class="fa fa-dot-circle-o"></i> Update Course
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
                <?php include './inc/footer.php' ?>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->


    <!-- END PAGE CONTAINER-->
    </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    >
    <?php include("./inc/scripts.php"); ?>
</body>

</html>
<!-- end document-->