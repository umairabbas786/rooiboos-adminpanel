<?php include "include/header.php";?>
<?php
unset($_SESSION['user']);
$_SESSION['message'] = "Logged Out Successfully !";
header("Location:login.php");
?>