
<?php

include_once ('config.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

extract($_POST);

echo $user_id. '<br />';
echo $user_email. '<br />';
echo $user_pass.  '<br />';



$q = "INSERT INTO member ( id, email, pw ) VALUES ( '$user_id', '$user_email' ,'$user_pass' )";


$mysqli->query( $q);

$mysqli->close();

echo "<meta http-equiv='refresh' content='0; url=login.php'>"; 
echo "<script>alert('join suceess!! 확인을 누르면 로그인창으로 이동합니다');</script>";

?>


 