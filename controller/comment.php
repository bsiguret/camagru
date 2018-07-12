<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"]."/functions/montage.php";
require $_SERVER["DOCUMENT_ROOT"]."/functions/mail.php";

$uid = $_SESSION['id'];
$username = $_SESSION['username'];
$img = $_POST['img'];
$comment = $_POST['comment'];

if ($uid == null || $comment == null || $comment == "" || $img == null || $img == "" || strlen($comment) > 255) {
	return;
}

$val = comment($uid, $img, $comment);
$userInfos = get_userinfo_from_montage($img);
$url = $_SERVER['HTTP_HOST'];
if ($val == 0) {
	if ($userInfos['username'] && $userInfos['notif'] == 'Y') {
		send_comment_mail($userInfos['email'], $userInfos['username'], $comment, $username, $img, $url);
	}
	echo htmlspecialchars($username);
}
?>
