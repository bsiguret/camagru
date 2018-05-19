<?php

function log_user($email, $password) {
  include_once '../setup/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT user_id, username FROM user WHERE email=:email AND password=:password AND verified='Y'");
      $email = strtolower($email);
      $password = hash("whirlpool", $password);
      $query->execute(array(':email' => $email, ':password' => $password, ':first_name' => $fname, ':last_name' => $lname));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      return ($val);
    } catch (PDOException $e) {
      $v['error'] = $e->getMessage();
      return ($v);
    }
}

?>
