<?php
session_start();
unset($_SESSION['auth']); 
unset($_SESSION['alert_shown']);
unset($_SESSION["userId"]);
session_destroy();
header("Location: login/login.php");
?>
