<?php
session_start();

include_once '../functions/signup.php';

// retreive values
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];

$_SESSION['error'] = null;

if ($email == "" || $email == null || $username == "" || $username == null || $password == "" || $password == null ||
    $fname == null || $fname == "" || $lname == null || $lname == "") {
  $_SESSION['error'] = "You need to fill all fields";
  header("Location: ../signup.php");
  return;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = "You need to enter a valid email";
  header("Location: ../signup.php");
  return;
}

if (strlen($username) > 50 || strlen($username) < 3) {
  $_SESSION['error'] = "Username should be beetween 3 and 50 characters";
  header("Location: ../signup.php");
  return;
}

if (strlen($fname) < 1 || $fname > 255) {
  $_SESSION['error'] = "First name should be beetween 1 and 255 characters";
  header("Location: ../signup.php");
  return;
}

if (strlen($lname) < 1 || $lname > 255) {
  $_SESSION['error'] = "Last name should be beetween 1 and 255 characters";
  header("Location: ../signup.php");
  return;
}

if (strlen($password) < 3) {
  $_SESSION['error'] = "Password should be beetween 3 and 255 characters";
  header("Location: ../signup.php");
  return;
}

$host = $_SERVER['HTTP_HOST'] . str_replace("/controller/signup.php", "", $_SERVER['REQUEST_URI']);

signup($email, $username, $lname, $fname, $password, $host);

header("Location: ../signup.php");
?>
