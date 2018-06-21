<?php
session_start();

include '../functions/login.php';

// retreive values
$email = $_POST['email'];
$password = $_POST['password'];

if (($val = log_user($email, $password)) == -1) {
  $_SESSION['error'] = "user not found";
} else if (isset($val['err'])) {
  $_SESSION['error'] = $val['err'];
} else {
  $_SESSION['id'] = $val['user_id'];
  $_SESSION['username'] = $val['username'];
  $_SESSION['fname'] = $val['fname'];
  $_SESSION['lname'] = $val['lname'];
}

header("Location: ../index.php");

?>
