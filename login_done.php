<?php
session_start();
$is_logged = $_SESSION['is_logged'];
if ($is_logged == 'YES') {
	$user_id = $_SESSION['user_id'];
	
echo "<meta http-equiv='refresh' content='0; url=sharefolio.php'>"; 
echo "<script>alert('login suceess!!');</script>";

	
	
} else {
	echo "<script>alert('login fail!!');</script>";
	echo "<meta http-equiv='refresh' content='0; url=login.php'>"; 
}


?>

