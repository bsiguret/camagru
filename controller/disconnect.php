<?php
session_start();

$_SESSION['error'] = null;
$_SESSION['id'] = null;
$_SESSION['username'] = null;
$_SESSION['fname'] = null;
$_SESSION['lname'] = null;

header("Location: ../index.php");

?>
