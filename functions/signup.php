<?php

function signup($email, $username, $password, $fname, $lname, $host) {
  include_once '../setup/database.php';
  include_once '../functions/email.php';

  $email = strtolower($email);

  try {
          $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query= $dbh->prepare("SELECT `user_id` FROM `user` WHERE username=:username OR email=:email");
          $query->execute(array(':username' => $username, ':email' => $email));

          if ($val = $query->fetch()) {
            $_SESSION['error'] = "user already exist";
            $query->closeCursor();
            return(-1);
          }
          $query->closeCursor();

          // encrypt password
          $password = hash("whirlpool", $password);

          $query= $dbh->prepare("INSERT INTO `user` (username, password, email, first_name, last_name, token) VALUES (:username, :password, :email, :fname, :lname, :token)");
          $token = uniqid(rand(), true);
          $query->execute(array(':username' => $username, ':password' => $password, ':email' => $email, ':fname' => $fname, ':lname' => $lname, ':token' => $token));
          send_verification_email($email, $username, $token, $host);

          $_SESSION['signup_success'] = true;
          return (0);
      } catch (PDOException $e) {
          $_SESSION['error'] = "ERROR: ".$e->getMessage();
      }
}

?>
