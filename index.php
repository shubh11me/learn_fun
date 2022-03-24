<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="home2.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <!-----nav start-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mb-2" href="#">PRACHANDE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link btn btn-light mx-2" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-light mx-2" href="#">COURSES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-light mx-2" href="#">ABOUT</a>
        </li>
        <?php
        if (isset($_SESSION['USER_LOGIN_DONE'])) {

          if ($_SESSION['USER_LOGIN_ROLE'] == 2) {
        ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo "<b>" . $_SESSION['USER_LOGIN_FNAME'] . " " . $_SESSION['USER_LOGIN_LNAME'] . "</b>" ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="user/my_account.php">My Account</a>
                <a class="dropdown-item" href="user/my_courses.php">My Courses</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="user/logout_user.php" onclick="return confirm('Are you sure you want to log out ?')">Logout</a>
              </div>
            </li>
          <?php
          } elseif ($_SESSION['USER_LOGIN_ROLE'] == 0) {
          ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['USER_LOGIN_FNAME'] . " " . $_SESSION['USER_LOGIN_LNAME'] ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          <?php
          } else if ($_SESSION['USER_LOGIN_ROLE'] == 1) {
          ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['USER_LOGIN_FNAME'] . " " . $_SESSION['USER_LOGIN_LNAME'] ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./influencer/my_students.php">My Students</a>
                <a class="dropdown-item" href="./influencer/sign_up_user.php">Add Student</a>
                <a class="dropdown-item" href="./influencer/my_account_influ.php">My Account</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          <?php
          }
        } else {
          ?>
          <li class="nav-item">
            <a class="nav-link btn btn-light  " href="user/login.php">LOGIN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-danger mx-2 text-light" href="user/signup.php">SIGN UP</a>
          </li>
        <?php
        }
        ?>




      </ul>

    </div>
  </nav>
  <!-----nav end-->

  <!----home section start-->
  <div class="jumbotron big-banner text-light " style="padding: 50px; ">
    <h1 class="display-4 display-10 " data-aos="fade-up" data-aos-offset="500" data-aos-easing="ease-in-sine">Women Skill<br>
      Development & <br>
      Buisness<br>
      Development Program</h1>
    <p class="lead" data-aos="zoom-in" data-aos-offset="150">Fashion Designing, Accessories<br>
      Manufacturing & Sales Marketing<br>
      Course</p>


    <p class="lead">
      <a class="btn btn-primary btn-lg" href="#" role="button">Register Now</a>
    </p>
  </div>
  <!----home section end-->

  <!---- 2nd div-->
  <div>
    <div class="container-1 py-2 text-light  ">
      <div class="row">
        <div class="col">
          <div class="media  ml-2 " data-aos="fade-right" data-aos-offset="70">

            <i class="far fa-play-circle display-4 "> </i>
            <div class="media-body">
              <h5 class="mt-0">Fresh Content</h5>

              <p> Learn the most updated technology & knowledge in Sewing Indusrty </p>

            </div>
          </div>
        </div>


        <div class="col">
          <div class="media " data-aos="zoom-in" data-aos-offset="70">

            <i class="far fa-ribbon display-4 "> </i>
            <div class="media-body">
              <h5 class="mt-0">Trusted Instructors</h5>

              <p> Learn courses taught by industry experts around the world</p>

            </div>
          </div>
        </div>


        <div class="col">



          <div class="media" data-aos="fade-left" data-aos-offset="70">

            <i class="far fa-spinner display-4 "> </i>
            <div class="media-body">
              <h5 class="mt-0">Flexible Learning</h5>

              <p> Learn on your term with lifetime course </p>


            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <!---- 2nd div end-->


  <!----  learning  section start-->
  <section class="main_heading my-5 ">
    <div class="text-center">
      <h1 class="display-4" data-aos="fade-up" data-aos-offset="200"> Learning At Prachande</h1>
      <hr class="w-25  mx-auto ">
      <div class="container">
        <div class="row">
          <div class=" extra-div col-lg-4 col-md-4 col-12">
            <a href="#"><i class="fa-3x fas fa-question-square"></i>-</i></a>
            <h2 data-aos="zoom-in" data-aos-offset="50">Why to join <br>

              Prachande
            </h2>
            <p>Low fees & 100% Quality, Ample Time
              for practice with Latest perpherals,
              Experienced & Trained Faculty,
              Network all over India.</p>
          </div>

          <div class=" extra-div col-lg-4 col-md-4 col-12">
            <a href="#"><i class="fa-3x far fa-desktop"></i></a>
            <h2 data-aos="zoom-in" data-aos-offset="100">E-Learning</h2>
            <p>Prachande developed e-learning platform for Prachande Students.
              That’s changing the way the world learns.
              More than 2000+ students are
              learning from e-learning platform of Prachande.

            </p>
          </div>
          <div class=" extra-div col-lg-4 col-md-4 col-12">
            <a href="#"><i class=" fa-3x fas fa-chalkboard-teacher"></i></a>
            <h2 data-aos="zoom-in" data-aos-offset="50">Corporate Training</h2>
            <p>Our foray in Corporate Training is based on our sharp
              understanding about the needs of the industry.
              Companies in public and private sector have benefited from
              our professional expertise.
              Our alliances with leading institutions keep's us aware of
              the industry.</p>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!----  learning section start-->



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>