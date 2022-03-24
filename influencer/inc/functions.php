<?php

function pr($arr)
{
    echo "<pre>";
    print_r($arr);
}
function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}
function get_safe_value($str)
{
    global $conn;
    if ($str != '') {
        return mysqli_real_escape_string($conn, $str);
    }
}

function redirect($link)
{
?>
    <script>
        window.location.href = '<?php echo $link ?>';
    </script>
<?php
}

function check_auth()
{

    if (!isset($_SESSION['USER_LOGIN_DONE'])) {
        redirect('../index.php');
    }
}

function check_author_auth()
{
    if (!isset($_SESSION['USER_LOGIN_DONE'])) {
        redirect('../author/login.php');
    } else {
        if ($_SESSION['USER_LOGIN_ROLE'] != 0) {
            redirect('../author/login.php');
        }
    }
}
function check_influ_auth()
{

    if ($_SESSION['USER_LOGIN_ROLE'] != 1) {
        redirect('profile.php');
    }
}
function check_stud_auth()
{
    if (!isset($_SESSION['USER_LOGIN_DONE'])) {
        redirect('../author/login.php');
    } else {
        if ($_SESSION['USER_LOGIN_ROLE'] != 2) {
            redirect('../user/login.php');
        }
    }
}

function alert($str)
{
    echo "<script>alert('$str')</script>";
    return true;
}

function getCustomDate($date)
{
    if ($date != "") {
        $date = strtotime($date);
        return date('d-M Y', $date);
    }
}


function getUserInfo($uid)
{
    global $conn;
    $row = mysqli_fetch_assoc(mysqli_query($conn, "select * from users where id='$uid'"));

    return $row;
}
function getUserTotalQr($uid)
{
    global $conn;
    $row = mysqli_fetch_assoc(mysqli_query($conn, "select count(*) as total_qr from qr_code where added_by='$uid'"));

    return $row;
}
function getUserTotalQrHit($uid)
{
    global $conn;
    $row = mysqli_fetch_assoc(mysqli_query($conn, "select count(*) from qr_traffic,qr_code,users where qr_traffic.qr_code_id=qr_code_id and qr_code.added_by=users.id and users.id=" . $uid . ""));

    return $row;
}
?>