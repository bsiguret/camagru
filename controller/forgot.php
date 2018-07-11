<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"]."/functions/password.php";

// retreive values
$email = $_POST['email'];

$_SESSION['error'] = null;

if (($res = reset_password($email)) !== 0) {
  if ($res == -1) {
    $_SESSION['error'] = "user not found";
  } else {
    $_SESSION['error'] = "internal error";
  }
} else {
  $_SESSION['forgot_success'] = true;
}

header("Location: ../forgot.php");

?>
