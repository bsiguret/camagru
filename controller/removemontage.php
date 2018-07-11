<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"]."/functions/montage.php";

$uid = $_SESSION['id'];
$src = $_POST['src'];
$val = remove_montage($uid, $src);

if ($val == 0) {
  echo "Montage has been removed";
  unlink("../montage/" . $src);
  header("Refresh:1");
} else {
  echo "Something wrong happened";
}
?>
