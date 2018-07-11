<?php

function reset_password($userEmail) {
  include '../setup/database.php';
  include '../functions/mail.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT user_id, username FROM user WHERE email=:email AND verified='Y'");
      $userEmail = strtolower($userEmail);
      $query->execute(array(':email' => $userEmail));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      $pass = uniqid('');
      $passEncrypt = hash("whirlpool", $pass);

      $query= $dbh->prepare("UPDATE user SET password=:password WHERE email=:email");
      $query->execute(array(':password' => $passEncrypt, ':email' => $userEmail));
      $query->closeCursor();

      send_forget_mail($userEmail, $val['username'], $pass);
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

?>
