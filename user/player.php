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

// check subscription


if (isset($_GET['course_id'])) {

    $course_id = $_GET['course_id'];
    $subscription = mysqli_query($conn, "SELECT * FROM subscriptions WHERE course_sub_id=$course_id AND payment_status='complete' AND user_sub_id='" . $_SESSION['USER_LOGIN_ID'] . "'");
    if (mysqli_num_rows($subscription) > 0) {
        $res_vid = mysqli_query($conn, "SELECT * FROM videos_course WHERE course_id_vid=$course_id");
        if (mysqli_num_rows($res_vid) > 0) {
            $intro_vid = mysqli_query($conn, "SELECT * FROM videos_course WHERE course_id_vid=$course_id AND vid_tag='info'");
            if (mysqli_num_rows($intro_vid) > 0) {
                $row_intro_vid = mysqli_fetch_assoc($intro_vid);
            } else {
                $row_intro_vid = "";
            }
        } else {
            alert("Videos are not available");
            redirect("../index.php");
        }
    } else {
        alert("Please Buy this course first");
        redirect("course_details.php?course_id=$course_id");
    }
} else {
    redirect("../index.php");
}
?>

<!DOCTYPE html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------custom css link-->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-transform: capitalize;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: normal;
        }

        body {
            background-color: #eee;
        }

        .heading {
            color: #444;
            font-size: 40px;
            text-align: center;
            padding: 10px;

        }

        .container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 15px;
            align-items: flex-start;
            padding: 5px 5%;
        }

        .container .main-video {
            background: #fff;
            border-radius: 5px;
            padding: 10px;

        }

        .container .main-video video {
            width: 100%;
            border-radius: 5px;
        }

        .container .main-video .title {
            color: #333;
            font-size: 23px;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .container .video-list {
            background: #fff;
            border-radius: 5px;
            height: 520px;
            overflow-y: scroll;
        }

        .container .video-list::-webkit-scrollbar {
            width: 7px;
        }

        .container .video-list::-webkit-scrollbar-track {
            background: #ccc;
            border-radius: 50px;
        }

        .container .video-list::-webkit-scrollbar-thumb {
            background: #666;
            border-radius: 50px;
        }

        .container .video-list .vid video {
            width: 100px;
            border-radius: 5px;
        }

        .container .video-list .vid {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #f7f7f7;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            border: 1px solid rgba(0, 0, 0, .1);
            cursor: pointer;
        }

        .container .video-list .vid:hover {
            background: #eee;

        }

        .container .video-list .vid.active {
            background: #2980b9;

        }

        .container .video-list .vid.active .title {
            color: #fff;
        }

        .container .video-list .vid .title {
            color: #333;
            font-size: 17px;

        }

        @media (max-width:768px) {
            .container {
                grid-template-columns: 1fr;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <h3 class="heading">video gallery</h3>
    <div class="container">
        <div class="main-video">
            <div class="video">
                <?php
                if (mysqli_num_rows($intro_vid) > 0) {

                ?>
                    <video src="<?php echo $row_intro_vid['video_src'] ?>" controls></video>
                    <h3 class="title"> <?php echo $row_intro_vid['video_name'] ?></h3>

                <?php
                } else {
                    $row_res_vid = mysqli_fetch_assoc($res_vid);

                ?>
                    <video src="<?php echo $row_res_vid['video_src'] ?>" controls></video>
                    <h3 class="title"> <?php echo $row_res_vid['video_name'] ?></h3>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="video-list">
            <?php

            $i = 1;
            while ($video_list = mysqli_fetch_assoc($res_vid)) {

            ?>
                <div class="vid active">
                    <video src="<?php echo $video_list['video_src'] ?>" muted></video>
                    <h3 class="title"><?php echo $i . " " . $video_list['video_name'] ?></h3>

                </div>
            <?php
                $i++;
            }
            ?>
        </div>
    </div>
    <script>
        let listvideo = document.querySelectorAll('.video-list .vid');
        let mainVideo = document.querySelector('.main-video video');
        let title = document.querySelector('.main-video .title');

        listvideo.forEach(video => {
            video.onclick = () => {
                listvideo.forEach(vid => vid.classList.remove('active'));
                video.classList.add('active');
                if (video.classList.contains('active')) {
                    let src = video.children[0].getAttribute('src');
                    mainVideo.src = src;
                    let text = video.children[1].innerHTML;
                    title.innerHTML = text;

                };
            };
        });
    </script>

</body>

</html>