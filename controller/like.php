<?php
session_start();

include_once("../functions/like.php");

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$path = $_POST['path'];
$liked = $_POST['liked'];

if ($uid == null
  || $path == null || $path == ""
  || $liked == null || $liked == "" || ($liked != "0" && $liked != "1")) {
  return;
}

$ret = get_like($uid, $path);
if ($ret != null && array_key_exists('liked', $ret)) {
  if ($ret['liked'] == $liked) {
    $_SESSION['test'] = "KO";
  } else {
    $val = update_like($uid, $path, $liked);
    if ($val == 0) {
    0$_SESSION['test'] ="CHANGE";
    } else {
      echo $val;
    }
  }
} else {
  $val = add_like($uid, $path, $liked);

  if ($val == 0) {
    $_SESSION['test'] = "ADD";
  } else {
    echo $val;
  }
}

?>
