<?php
session_start();

include_once("../functions/montage.php");

$uid = $_SESSION['id'];
$src = $_POST['src'];

$val = remove_montage($uid, $src);

if ($val == 0) {
  echo "Montage has been removed";
  unlink("../montage/" . $src);
} else {
  echo "Something wrong happened";
}

?>
