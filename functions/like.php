<?php
function add_like($uid, $path, $liked) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("INSERT INTO `like`(`user_id`, `image_id`, liked) SELECT :user_id, :image_id, :liked FROM `image` WHERE path=:path");
      $query->execute(array(':user_id' => $uid, ':path' => $path, ':liked' => $liked));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function update_like($uid, $path, $liked) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("UPDATE `like`, `image` SET `nb_like`.liked=:liked WHERE 'image.path'=':path' AND `image.user_id`=:user_id AND `like`.image_id=`image.image_id`");
      $query->execute(array(':userid' => $uid, ':path' => $path, ':liked' => $liked));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_like($uid, $path) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT liked FROM `like`, `image` WHERE `like`.user_id=:user_id AND `like`.image_id=like.image_id AND image.path=:path");
      $query->execute(array(':userid' => $uid, ':path' => $path));
      $val = $query->fetch();
      $query->closeCursor();
      return ($val);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_nb_likes($path) {
  include './setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT liked FROM `like`, `image` WHERE `like`.image_id=like.image_id AND 'image.path'=':path' AND `like`.liked='1'");
      $query->execute(array(':path' => $path));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_nb_likes2($path) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT liked FROM `like`, `image` WHERE `like`.image_id=like.image_id AND 'image.path'=':path' AND `like`.liked='1'");
      $query->execute(array(':path' => $path));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_nb_dislikes($path) {
  include './setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT liked FROM `like`, `image` WHERE `like`.image_id=like.image_id AND 'image.path'=':path' AND `like`.liked='0'");
      $query->execute(array(':path' => $path));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_nb_dislikes2($path) {
  include '../setup/database.php';
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT liked FROM `like`, `image` WHERE `like`.image_id=like.image_id AND 'image.path'=':path' AND `like`.liked='0'");
      $query->execute(array(':path' => $path));

      $count = 0;
      while ($val = $query->fetch()) {
        $count++;
      }
      $query->closeCursor();
      return ($count);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

?>
