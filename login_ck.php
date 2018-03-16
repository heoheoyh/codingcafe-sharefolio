<?php

include_once ('config.php');
session_start();
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

extract($_POST); 
$q = "SELECT * FROM member WHERE id='$user_id'";
$result = $mysqli->query( $q);

if($result->num_rows==1) {
    //해당 ID 의 회원이 존재할 경우
    // 암호가 맞는지를 확인

    
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if( $row['pw'] == $user_pass ) {
        $_SESSION['is_logged'] = 'YES';
        $_SESSION['user_id'] = $user_id;
        header("Location: login_done.php");
        exit();
    }
    else {
        $_SESSION['is_logged'] = 'NO';
        $_SESSION['user_id'] = '';
        echo "<script>alert('nononono!');history.back();</script>";
        exit();
    } 
}
    ?>