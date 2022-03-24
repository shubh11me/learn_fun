<?php
if (isset($_POST['email'])) {

    $email=$_POST['email'];
    $userChk="";
    if (mysqli_num_rows(mysqli_query($conn, "select * from influencer  where influ_email='$email'")) > 0) {
        $userChk=0; 
    }
    else{
        $userChk=1;
    }
    echo $userChk;
    }
    ?>
