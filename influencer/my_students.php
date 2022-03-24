<?php
session_start();
include './../conn.php';
include './inc/functions.php';

if (!isset($_SESSION['USER_LOGIN_DONE'])) {
    alert('Please Login as influencer');
    redirect('login.php');

} else {
    if ($_SESSION['USER_LOGIN_ROLE'] != 1) {
        alert('Please Login as influencer to continue');
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
                                    <strong>My Students</strong>
                                    <small></small>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2 table_stock">
                                        <?php
                                        $res_usr = mysqli_query($conn, "SELECT * FROM `users` WHERE joined_by_id='" . $_SESSION["USER_LOGIN_ID"] . "' AND payment_status=1");
                                        if (mysqli_num_rows($res_usr) > 0) {
                                        ?>
                                            <thead>
                                                <tr class="bg-danger table_stock_header">

                                                    <th>Sr. No</th>
                                                    <th>Student Name</th>
                                                    <th>User Name</th>
                                                    <th>Email ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $i = 1;
                                                while ($row = mysqli_fetch_assoc($res_usr)) {
                                                ?>
                                                    <tr class="tr-shadow">
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['firstname']." ".$row['lastname'] ?></td>
                                                        <td><?php echo $row['username'] ?></td>
                                                        <td><?php echo $row['email_id'] ?></td>
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