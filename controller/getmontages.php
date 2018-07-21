<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"]."/functions/montage.php";
require $_SERVER["DOCUMENT_ROOT"]."/functions/like.php";

$id = $_POST['id'];
$nb = $_POST['nb'];

if ($id == null || $id == "" || $nb == null || $nb == "") {
  echo "KO";
  return;
}
$montages = [];
$montages = get_montages2($id, $nb);
if (count($montages > 1)) {
  for ($i = 0; $i < count($montages) && $i < 5; $i++) {
    $montages[$i]['dislikes'] = get_nb_dislikes2($montages[$i]['path']);
    $montages[$i]['likes'] = get_nb_likes2($montages[$i]['path']);
    $comments = get_comments2($montages[$i]['path']);
    if ($comments[0] != null) {
      $montages[$i]['text'] = $comments;
    } else {
      $montages[$i]['text'] = null;
    }
  }
}
if (count($montages) == 1) {
  $montages[0]['dislikes'] = get_nb_dislikes2($montages[0]['path']);
  $montages[0]['likes'] = get_nb_likes2($montages[0]['path']);
  $comments = get_comments2($montages[0]['path']);
  if ($comments[0] != null) {
    $montages[0]['text'] = $comments;
  } else {
    $montages[0]['text'] = null;
  }
}
if (count($montages) <= 0) {
  echo "KO";
  return;
}
print_r(json_encode($montages));
?>
