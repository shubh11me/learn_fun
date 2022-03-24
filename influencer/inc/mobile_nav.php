<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.php">
                    <img src="images/icon/logo.png" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <?php
    $usr_mob_nav_query = mysqli_query($conn, "SELECT * FROM users WHERE user_id='" . $_SESSION['USER_LOGIN_ID'] . "'");
    $row_mob_query = mysqli_fetch_assoc($usr_mob_nav_query);
    ?>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">


                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i><?php echo $row_mob_query['firstname'] . " " . $row_mob_query['lastname'] ?></a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="./my_students.php">
                                <i class="zmdi zmdi-account"></i>My Students</a>
                        </li>
                        <li>
                            <a href="./my_account_influ.php">
                                <i class="zmdi zmdi-account"></i>My Account
                            </a>
                        </li>
                        <li>
                            <a href="./logout_influ.php">
                                Logout
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>