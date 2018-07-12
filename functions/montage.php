<?php

function add_montage($user_id, $pathPath) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("INSERT INTO `image` (user_id, path) VALUES (:user_id, :path)");
      $query->execute(array(':user_id' => $user_id, ':path' => $pathPath));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_all_montage($uid) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT `user_id`, `path` FROM `image` WHERE `image`.user_id=:user_id");
      $query->execute(array(':user_id' => $uid));

      $i = 0;
      $tab = null;
      while ($val = $query->fetch()) {
        $tab[$i] = $val;
        $i++;
      }
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function remove_montage($uid, $path) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT * FROM image WHERE path=:path AND user_id=:user_id");
      $query->execute(array(':path' => $path, ':user_id' => $uid));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      $query= $dbh->prepare("DELETE FROM `like` WHERE image_id=:image_id");
      $query->execute(array(':image_id' => $val['image_id']));
      $query->closeCursor();

      $query= $dbh->prepare("DELETE FROM `comment` WHERE image_id=:image_id");
      $query->execute(array(':image_id' => $val['image_id']));
      $query->closeCursor();

      $query= $dbh->prepare("DELETE FROM `image` WHERE `path`=:path AND user_id=:user_id");
      $query->execute(array(':path' => $path, ':user_id' => $uid));
      $query->closeCursor();
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_montages($start, $nb) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      if ($start < 0) {
        $start = 0;
      }
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT user_id, path, image_id FROM image WHERE image_id > :image_id ORDER BY image_id ASC LIMIT :lim");
      $query->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
      $query->bindValue(':image_id', $start, PDO::PARAM_INT);
      $query->execute();

      $i = 0;
      $tab = null;
      while (($val = $query->fetch())) {
        if ($i >= $nb) {
          $tab['more'] = true;
        } else {
          $tab[$i] = $val;
        }
        $i++;
      }
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      $s;
      $s['error'] = $e->getMessage();
      return ($s);
    }
}

function get_montages2($start, $nb) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      if ($start < 0) {
        $start = 0;
      }
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT user_id, path, image_id FROM image WHERE image_id > :image_id ORDER BY image_id ASC LIMIT :lim");
      $query->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
      $query->bindValue(':image_id', $start, PDO::PARAM_INT);
      $query->execute();

      $i = 0;
      $tab = null;
      while (($val = $query->fetch())) {
        if ($i >= $nb) {
          $tab['more'] = true;
        } else {
          $tab[$i] = $val;
        }
        $i++;
      }
      $query->closeCursor();

      return ($tab);
    } catch (PDOException $e) {
      $s;
      $s['error'] = $e->getMessage();
      return ($s);
    }
}

function comment($uid, $pathSrc, $comment) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("INSERT INTO comment(user_id, image_id, `text`) SELECT :user_id, image_id, :text FROM `image` WHERE `path`=:path");
      $query->execute(array(':user_id' => $uid, ':text' => $comment, ':path' => $pathSrc));
      return (0);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }
}

function get_comments($pathSrc) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT c.text, u.username FROM comment AS c, user AS u, `image` AS i WHERE i.path=:path AND i.image_id=c.image_id AND c.user_id=u.user_id");
      $query->execute(array(':path' => $pathSrc));

      $i = 0;
      $tab = null;
      while ($val = $query->fetch()) {
        $tab[$i] = $val;
        $i++;
      }
      $query->closeCursor();
      return ($tab);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
}

function get_comments2($pathSrc) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT c.text, u.username FROM comment AS c, user AS u, `image` AS i WHERE i.path=:path AND i.image_id=c.image_id AND c.user_id=u.user_id");
      $query->execute(array(':path' => $pathSrc));

      $i = 0;
      $tab = null;
      while ($val = $query->fetch()) {
        $tab[$i] = $val;
        $i++;
      }
      $query->closeCursor();
      return ($tab);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
}

function get_userinfo_from_montage($pathSrc) {
  require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT email, username FROM user, `image` WHERE `image`.`path`=:path AND `user`.`user_id`=`image`.`user_id`");
      $query->execute(array(':path' => $pathSrc));

      $val = $query->fetch();
      $query->closeCursor();

      return ($val);
    } catch (PDOException $e) {
      $ret = "";
      $ret['error'] = $e->getMessage();
      return ($ret);
    }
}

?>
