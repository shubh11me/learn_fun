<?php
session_start();
if (!isset($_SESSION['USER_LOGIN_DONE'])) {
    redirect('../index.php');    
} else {
    if ($_SESSION['USER_LOGIN_ROLE'] != 2) {
        redirect('../index.php');
    }else{
        unset($_SESSION["USER_LOGIN_DONE"]);
        unset($_SESSION["USER_LOGIN_ID"]);
        unset($_SESSION["USER_LOGIN_FNAME"]);
        unset($_SESSION["USER_LOGIN_LNAME"]);
        unset($_SESSION["USER_LOGIN_UNAME"]);
        unset($_SESSION["USER_LOGIN_ROLE"]);
        header("Location:../index.php");
    }
}

?>