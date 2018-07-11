<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"]."/functions/like.php";

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$path = $_POST['path'];
$liked = $_POST['liked'];
$_SESSION['uid'] = $uid;
$_SESSION['path'] = $path;
$_SESSION['liked'] = $_POST['liked'];
if ($uid == null
  || $path == null || $path == ""
  || $liked == null || $liked == "" || ($liked != "-1" && $liked != "1")) {
  return;
}

$ret = get_like($uid, $path);
$_SESSION['ret'] = $ret;
if ($ret != null && array_key_exists('liked', $ret)) {
  if ($ret['liked'] == $liked) {
    echo "KO";
    $_SESSION['test'] = "KO";
  } else {
    $val = update_like($uid, $path, $liked);
    if ($val == 0) {
    echo "CHANGE";
    $_SESSION['test'] = "CHANGE";
    } else {
      echo $val;
    }
  }
} else {
  $val = add_like($uid, $path, $liked);
  if ($val == 0) {
    echo "ADD";
    $_SESSION['test'] = "ADD";
  } else {
    echo $val;
  }
}

?>
