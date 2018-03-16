<?php
session_start();
session_destroy();
echo "<meta http-equiv='refresh' content='0; url=sharefolio.php'>"; 
echo "<script>alert('logout ok!  byebye~');</script>";
?>