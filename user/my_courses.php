<?php
session_start();
include './../conn.php';
include './inc/functions.php';

if (!isset($_SESSION['USER_LOGIN_DONE'])) {
    alert('Please Login as Student');
    redirect('login.php');
} else {
    if ($_SESSION['USER_LOGIN_ROLE'] != 2) {
        alert('Please Login as Student to continue');
        redirect('login.php');
    }
}

$usr_detai_query = mysqli_query($conn, "SELECT * FROM users WHERE user_id='" . $_SESSION['USER_LOGIN_ID'] . "'");

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
                                    <strong>My Courses</strong>
                                    <small></small>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2 table_stock">
                                        <thead>
                                            <tr class="bg-danger table_stock_header">

                                                <th>Sr. No</th>
                                                <th>Course Name</th>
                                                <th>Course Category</th>
                                                <th>Visit Course Page</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            echo "SELECT * FROM `subscriptions` WHERE user_sub_id='" . $_SESSION["USER_LOGIN_ID"] . "'";
                                            $res_sub = mysqli_query($conn, "SELECT * FROM `subscriptions` WHERE user_sub_id='" . $_SESSION["USER_LOGIN_ID"] . "'");
                                            if (mysqli_num_rows($res_sub) > 0) {


                                                $i = 1;
                                                while ($row_res_sub = mysqli_fetch_assoc($res_sub)) {
                                                    $res_crs = mysqli_query($conn, "SELECT * FROM course WHERE course_id='" . $row_res_sub['course_sub_id'] . "'");
                                            
                                                    $row = mysqli_fetch_assoc($res_crs)

                                            ?>
                                                    <tr class="tr-shadow">
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['course_name'] ?></td>
                                                        <td><?php echo $row['course_category'] ?></td>
                                                        <td><a href="course_details.php?course_id='<?php echo $row['course_id'] ?>'"><button class="btn btn-primary">Go to <?php echo $row['course_name'] ?> details </button></a></td>
                                                    </tr>
                                                    <tr class="spacer"></tr>
                                            <?php
                                                    $i++;
                                                }
                                            } else {
                                                echo "<h4>You didn't buy course yet</h4>";
                                            } ?>
                                        </tbody>
                                    </table>
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